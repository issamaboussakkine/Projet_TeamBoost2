<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $todayCheckIn = Auth::user()->todayCheckIn;
        
        if ($todayCheckIn) {
            return redirect()->route('team.wall')->with('info', 'Tu as déjà fait ton check-in aujourd\'hui !');
        }
        
        return view('checkin.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood' => 'required|in:super,bien,neutre,fatigue,stresse',
            'what_i_did_yesterday' => 'nullable|string|max:1000',
            'what_i_will_do_today' => 'required|string|max:1000',
            'blockers' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['checkin_date'] = today();

        CheckIn::create($validated);

        return redirect()->route('team.wall')->with('success', 'Check-in enregistré avec succès !');
    }

    public function teamWall()
    {
        $todayCheckIns = CheckIn::with('user')
            ->where('checkin_date', today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('checkin.team-wall', compact('todayCheckIns'));
    }

    public function history()
    {
        $checkIns = Auth::user()->checkIns()->orderBy('checkin_date', 'desc')->paginate(20);
        return view('checkin.history', compact('checkIns'));
    }
}