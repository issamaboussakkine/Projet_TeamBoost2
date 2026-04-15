<?php

namespace App\Http\Controllers;

use App\Models\Kudo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KudoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $recentKudos = Kudo::with(['sender', 'receiver'])
            ->latest()
            ->take(10)
            ->get();
        
        return view('kudos.index', compact('users', 'recentKudos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'to_user_id' => 'required|exists:users,id|different:from_user_id',
            'message' => 'required|string|min:3|max:500',
            'badge' => 'nullable|string|max:50'
        ]);

        $validated['from_user_id'] = Auth::id();

        Kudo::create($validated);

        return redirect()->route('kudos.index')->with('success', 'Kudos envoyé avec succès !');
    }

    public function leaderboard()
    {
        $users = User::withCount('receivedKudos')
            ->orderBy('received_kudos_count', 'desc')
            ->take(10)
            ->get();

        return view('kudos.leaderboard', compact('users'));
    }

    public function myKudos()
    {
        $sentKudos = Auth::user()->sentKudos()->with('receiver')->latest()->get();
        $receivedKudos = Auth::user()->receivedKudos()->with('sender')->latest()->get();

        return view('kudos.my-kudos', compact('sentKudos', 'receivedKudos'));
    }
}