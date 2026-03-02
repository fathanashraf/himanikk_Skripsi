<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display settings index with groups
     */
    public function index(Request $request)
    {
        $groups = setting::select('group')
            ->whereNotNull('group')
            ->groupBy('group')
            ->orderBy('group')
            ->pluck('group');

        $currentGroup = $request->get('group', 'general');
        $settings = Setting::group($currentGroup)
            ->orderBy('sort_order')
            ->orderBy('key')
            ->paginate(20);

        return view('settings.index', compact('settings', 'groups', 'currentGroup'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store new setting
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'required',
            'type' => 'required|in:string,boolean,integer,json',
            'group' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'is_public' => 'boolean',
            'sort_order' => 'integer|min:0|max:999',
        ]);

        $setting = Settings::create($validated);
        
        // Clear cache
        Cache::forget("settings.{$settings->key}");

        return redirect()->route('settings.index')
            ->with('success', 'Setting "' . $setting->key . '" berhasil dibuat!');
    }

    /**
     * Show edit form
     */
    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('settings'));
    }

    /**
     * Update setting
     */
    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'value' => 'required',
            'type' => 'required|in:string,boolean,integer,json',
            'group' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'is_public' => 'boolean',
            'sort_order' => 'integer|min:0|max:999',
        ]);

        $oldKey = $setting->key;
        $setting->update($validated);
        
        // Clear cache untuk old dan new key
        Cache::forget("settings.{$oldKey}");
        if ($oldKey !== $validated['key'] ?? $oldKey) {
            Cache::forget("settings.{$setting->key}");
        }

        return redirect()->route('settings.index')
            ->with('success', 'Setting "' . $setting->key . '" berhasil diupdate!');
    }

    /**
     * Delete setting
     */
    public function destroy(Setting $setting)
    {
        $key = $setting->key;
        $setting->delete();
        
        Cache::forget("settings.{$key}");

        return redirect()->route('settings.index')
            ->with('success', 'Setting "' . $key . '" berhasil dihapus!');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:settings,id',
        ]);

        $count = 0;
        foreach ($request->ids as $id) {
            $setting = Setting::find($id);
            if ($setting) {
                Cache::forget("settings.{$setting->key}");
                $setting->delete();
                $count++;
            }
        }

        return redirect()->route('settings.index')
            ->with('success', "{$count} setting berhasil dihapus!");
    }

    /**
     * Quick edit (AJAX)
     */
    public function quickUpdate(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'required'
        ]);

        $oldValue = $setting->value;
        $setting->update(['value' => $request->value]);
        
        Cache::forget("settings.{$setting->key}");

        return response()->json([
            'success' => true,
            'value' => $setting->value,
            'message' => 'Setting updated!'
        ]);
    }
}
