<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcaraAdminController extends Controller
{
    public function index(Request $request)
{
    // ✅ AJAX request = JSON data
    if ($request->ajax() || $request->wantsJson()) {
        $acaras = Acara::select('id', 'name', 'description', 'status', 'image', 'link')
                      ->latest()
                      ->get()
                      ->map(function($acara) {
                          return [
                              'id' => $acara->id,
                              'name' => $acara->name,
                              'description' => $acara->description,
                              'status' => $acara->status,
                              'image' => $acara->image ? Storage::url($acara->image) : null,
                              'link' => $acara->link
                          ];
                      });
        
        return response()->json(['data' => $acaras]);
    }

    // Normal request = view
    $stats = [
        'total_acaras' => Acara::count(),
        'published_acaras' => Acara::where('status', Acara::STATUS_PUBLISHED)->count(),
        'draft_acaras' => Acara::where('status', Acara::STATUS_DRAFT)->count(),
        'archived_acaras' => Acara::where('status', Acara::STATUS_ARCHIVED)->count(),
    ];

    $acaras = Acara::latest()->get();
    return view('admin.acara.index', compact('stats', 'acaras'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'description', 'status', 'link']);
        
        // ✅ Sesuaikan dengan kolom 'image' di database
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('acara', 'public');
        }

        $acara = Acara::create($data);

        // ✅ Return dengan struktur yang sesuai frontend
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $acara->id,
                'name' => $acara->name,
                'description' => $acara->description,
                'status' => $acara->status,
                'link' => $acara->link,
                'image_url' => $acara->image ? Storage::url($acara->image) : null, // Convert ke URL
                'created_at' => $acara->created_at
            ]
        ]);
    }

    public function update(Request $request, Acara $acara)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'description', 'status', 'link']);
        
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($acara->image) {
                \Storage::disk('public')->delete($acara->image);
            }
            $data['image'] = $request->file('image')->store('acara', 'public');
        }

        $acara->update($data);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $acara->id,
                'name' => $acara->name,
                'description' => $acara->description,
                'status' => $acara->status,
                'link' => $acara->link,
                'image_url' => $acara->image ? Storage::url($acara->image) : null,
                'created_at' => $acara->created_at
            ]
        ]);
    }

    public function toggleStatus(Acara $acara)
    {
        // Toggle antara 0 (draft) dan 1 (published)
        $acara->status = $acara->status == 1 ? 0 : 1;
        $acara->save();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $acara->id,
                'status' => $acara->status
            ]
        ]);
    }

    public function destroy(Acara $acara)
    {
        if ($acara->image) {
            \Storage::disk('public')->delete($acara->image);
        }
        $acara->delete();

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil dihapus'
        ]);
    }

    public function data()
{
    $acaras = Acara::select('id', 'name', 'description', 'status', 'image', 'link')->get();
    return response()->json(['data' => $acaras]);
}

}
