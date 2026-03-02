<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() { return view('profile.index'); }
   public function edit()
{
    $user = auth()->user();
    
    // Pastikan date fields di-parse jadi Carbon
    $user->setAttribute('created_at', $user->created_at ? \Carbon\Carbon::parse($user->created_at) : null);
    $user->setAttribute('updated_at', $user->updated_at ? \Carbon\Carbon::parse($user->updated_at) : null);
    
    // Atau tambah accessor di User model (LEBIHAN BAIK)
    
    return view('profile.edit', compact('user'));
}


    public function update(Request $request)
    {
        $user = auth()->user();
        
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
            'nim' => ['nullable', 'string', 'max:20'],
            'nidn' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],
            'phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ]);

        // Password handling
        if (!empty($request->password)) {
            $credentials['password'] = Hash::make($request->password);
        }

        // ✅ XAMPP AVATAR UPLOAD FIX
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama
            if ($user->avatar && $user->avatar !== 'default-avatar.png') {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Generate nama unik
            $avatarName = $user->id . '_' . time() . '_' . uniqid() . '.' . 
                         pathinfo($request->file('avatar')->getClientOriginalName(), PATHINFO_EXTENSION);
            
            // Buat folder
            $folderPath = storage_path('app/public/avatars');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
            
            // Pindah file dari tmp
            $destinationPath = $folderPath . '/' . $avatarName;
            if (move_uploaded_file($request->file('avatar')->getRealPath(), $destinationPath)) {
                $credentials['avatar'] = 'avatars/' . $avatarName;
            }
        }

        $user->update($credentials);

        return redirect()->route('profile.index')
            ->with('success', '✅ Profile berhasil diperbarui!');
    }
}
