<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acara;

class AcaraUserController extends Controller
{
    public function index(Request $request)
    {
        $acaras = Acara::where('status', 'segera')->get();
        return view('user.acara.index', compact('acaras'));
    }

    public function show(acara $acara)
{
    // EAGER LOAD otomatis ambil user
    $acara->load('user');
    return view('user.acara.show', compact('acara'));
}

    public function pendaftaran(Acara $acara)
    {
        $acara->load('user');
        return view('user.acara.pendaftaranAcara', compact('acara'));
    }

    public function storePendaftaran(Request $request, Acara $acara)
    {
        $acara->pendaftars()->create($request->all());
        return redirect()->route('user.acara.index')->with('success', 'Pendaftaran berhasil!');
    }
}