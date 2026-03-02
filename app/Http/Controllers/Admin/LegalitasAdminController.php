<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil;

class LegalitasAdminController extends Controller
{
    public function legalitas() {
        $profil = Profil::first() ?? new Profil();
        return view('admin.legalitas.index', compact('profil'));
    }
}
