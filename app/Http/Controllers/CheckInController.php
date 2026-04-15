<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    // Afficher le formulaire de check-in
    public function index()
    {
        $todayCheckIn = CheckIn::where('user_id', Auth::id())
                               ->where('date', today())
                               ->first();
        
        return view('checkin.form', compact('todayCheckIn'));
    }

    // Enregistrer le check-in
    public function store(Request $request)
    {
        $request->validate([
            'yesterday' => 'required|string',
            'today' => 'required|string',
            'blockers' => 'nullable|string',
        ]);

        CheckIn::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'date' => today()
            ],
            [
                'yesterday' => $request->yesterday,
                'today' => $request->today,
                'blockers' => $request->blockers,
            ]
        );

        return redirect()->route('team-wall')->with('success', 'Check-in enregistré !');
    }

    public function teamWall()
    {
        $checkIns = CheckIn::with('user')
                           ->where('date', today())
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        return view('checkin.team-wall', compact('checkIns'));
    }
}