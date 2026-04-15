<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CheckIn;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCheckIns = CheckIn::count();
        $todayCheckIns = CheckIn::whereDate('date', today())->count();
        $users = User::all();
        $checkIns = CheckIn::with('user')->latest()->take(20)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'totalCheckIns', 'todayCheckIns', 'users', 'checkIns'));
    }
    
    public function deleteCheckIn($id)
    {
        $checkIn = CheckIn::findOrFail($id);
        $checkIn->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Check-in supprimé');
    }
    
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();
        
        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur promu admin');
    }
    
    public function makeEmployee($id)
    {
        // Empêcher un admin de se rétrograder lui-même
        if ($id == auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas vous rétrograder vous-même !');
        }
        
        $user = User::findOrFail($id);
        $user->role = 'employee';
        $user->save();
        
        return redirect()->route('admin.dashboard')->with('success', 'Admin rétrogradé en employé');
    }
}