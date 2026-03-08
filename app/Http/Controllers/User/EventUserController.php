<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Masukkan;
use Illuminate\Support\Facades\Auth;

class EventUserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    $status = $request->get('status');
    $dateFrom = $request->get('dateFrom');
    $dateTo = $request->get('dateTo');

    $events = event::with(['user'])
        ->withCount('pendaftarans as pendaftarans_count') // ✅ FIX ERROR
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($status, fn($q, $s) => $q->where('status', $status))
        ->when($dateFrom, fn($q, $d) => $q->whereDate('tanggal', '>=', $d))
        ->when($dateTo, fn($q, $d) => $q->whereDate('tanggal', '<=', $d))
        ->latest('tanggal')
        ->paginate(12);

    return view('user.events.index', compact('events', 'search', 'status', 'dateFrom', 'dateTo'));
}

    public function show(event $event)
        {
    // EAGER LOAD otomatis ambil user
            $event->load('user');
            return view('user.event.show', compact('event'));
        }

    public function pendaftaran(event $event)
    {
        $event->load('user');
        return view('user.events.pendaftaran',$event , compact('event'));
    }

    public function storePendaftaran(Request $request, event $event)
    {
        $event->pendaftars()->create($request->all());
        return redirect()->route('user.events.index')->with('success', 'Pendaftaran berhasil!');
    }
}