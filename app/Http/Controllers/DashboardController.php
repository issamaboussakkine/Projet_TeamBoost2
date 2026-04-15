<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $todayCheckInCount = CheckIn::whereDate('date', today())->count();
        $totalUsers = User::count();
        $userCheckInsCount = CheckIn::where('user_id', auth()->id())->count();
        
        return view('dashboard', compact('todayCheckInCount', 'totalUsers', 'userCheckInsCount'));
    }
}