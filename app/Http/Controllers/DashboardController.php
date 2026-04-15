<?php

namespace App\Http\Controllers;

use App\Models\Kudo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalKudos = Kudo::count();
        $receivedCount = $user->receivedKudos()->count();
        $sentCount = $user->sentKudos()->count();
        
        $topUsers = User::withCount('receivedKudos')
            ->orderBy('received_kudos_count', 'desc')
            ->take(5)
            ->get();
        
        $recentKudos = Kudo::with(['sender', 'receiver'])
            ->latest()
            ->take(10)
            ->get();
        
        $activeUsers = User::has('sentKudos')->count();
        $totalUsers = User::count();
        $participationRate = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100) : 0;
        
        // Statistiques par jour (derniers 7 jours)
        $weeklyStats = [];
        $days = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Kudo::whereDate('created_at', $date->toDateString())->count();
            $weeklyStats[] = [
                'day' => $days[date('N', strtotime($date)) - 1],
                'percentage' => $totalKudos > 0 ? min(100, round(($count / max(1, $totalKudos)) * 100)) : 0,
                'count' => $count
            ];
        }
        
        // Croissance (comparaison mois dernier vs mois précédent)
        $lastMonth = Kudo::whereBetween('created_at', [now()->subMonth(), now()])->count();
        $previousMonth = Kudo::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
        $kudosGrowth = $previousMonth > 0 ? round((($lastMonth - $previousMonth) / $previousMonth) * 100) : 0;
        
        // Croissance reçus
        $lastMonthReceived = $user->receivedKudos()->whereBetween('created_at', [now()->subMonth(), now()])->count();
        $previousMonthReceived = $user->receivedKudos()->whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
        $receivedGrowth = $previousMonthReceived > 0 ? round((($lastMonthReceived - $previousMonthReceived) / $previousMonthReceived) * 100) : 0;
        
        // Croissance envoyés
        $lastMonthSent = $user->sentKudos()->whereBetween('created_at', [now()->subMonth(), now()])->count();
        $previousMonthSent = $user->sentKudos()->whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
        $sentGrowth = $previousMonthSent > 0 ? round((($lastMonthSent - $previousMonthSent) / $previousMonthSent) * 100) : 0;
        
        return view('dashboard', compact(
            'totalKudos', 'receivedCount', 'sentCount', 
            'topUsers', 'recentKudos', 'participationRate', 
            'weeklyStats', 'kudosGrowth', 'receivedGrowth', 'sentGrowth'
        ));
    }
}