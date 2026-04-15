@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <!-- En-tête -->
    <div class="max-w-7xl mx-auto mb-8 animate-fade-in-up">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-xl p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold mb-2 tracking-tight">Tableau de bord</h1>
                    <p class="text-gray-300">Vue d'ensemble des reconnaissances de l'équipe</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Dernière mise à jour</p>
                    <p class="font-semibold">{{ now()->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes statistiques -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Carte 1 -->
            <div class="stat-card bg-gradient-to-br from-indigo-500 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-indigo-100 text-sm mb-1">Total Kudos</p>
                        <p class="text-4xl font-bold">{{ $totalKudos }}</p>
                        <p class="text-indigo-100 text-sm mt-2">+{{ $kudosGrowth ?? 0 }}% ce mois</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Carte 2 -->
            <div class="stat-card bg-gradient-to-br from-emerald-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-emerald-100 text-sm mb-1">Kudos reçus</p>
                        <p class="text-4xl font-bold">{{ $receivedCount }}</p>
                        <p class="text-emerald-100 text-sm mt-2">+{{ $receivedGrowth ?? 0 }}%</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M6 14h12M5 18h14M7 6h10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Carte 3 -->
            <div class="stat-card bg-gradient-to-br from-amber-500 to-amber-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-amber-100 text-sm mb-1">Kudos envoyés</p>
                        <p class="text-4xl font-bold">{{ $sentCount }}</p>
                        <p class="text-amber-100 text-sm mt-2">+{{ $sentGrowth ?? 0 }}%</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Carte 4 -->
            <div class="stat-card bg-gradient-to-br from-cyan-500 to-cyan-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-cyan-100 text-sm mb-1">Participation</p>
                        <p class="text-4xl font-bold">{{ $participationRate }}%</p>
                        <p class="text-cyan-100 text-sm mt-2">membres actifs</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top contributeurs et Activité -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Top contributeurs -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-left">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-gray-800">Top contributeurs</h2>
                        </div>
                        <a href="{{ route('kudos.leaderboard') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium transition-colors">
                            Voir tout →
                        </a>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($topUsers as $index => $user)
                    <div class="group flex items-center gap-4 p-3 rounded-xl transition-all duration-300 hover:bg-gray-50">
                        <div class="flex-shrink-0">
                            @if($index == 0)
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                    🏆
                                </div>
                            @elseif($index == 1)
                                <div class="w-12 h-12 bg-gradient-to-br from-gray-400 to-gray-500 rounded-xl flex items-center justify-center text-white text-xl font-bold">
                                    🥈
                                </div>
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-lg font-bold">
                                    {{ $index + 1 }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $user->name }}</span>
                                <span class="text-sm font-semibold bg-indigo-100 text-indigo-700 px-2 py-1 rounded-lg">{{ $user->received_kudos_count }} kudos</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2 rounded-full transition-all duration-700" style="width: {{ min(100, $user->received_kudos_count * 20) }}%"></div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Aucune donnée disponible</p>
                    @endforelse
                </div>
            </div>

            <!-- Dernière activité -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-right">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-gray-800">Dernière activité</h2>
                        </div>
                        <a href="{{ route('kudos.my-kudos') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium transition-colors">
                            Voir tout →
                        </a>
                    </div>
                </div>
                <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                    @forelse($recentKudos as $kudo)
                    <div class="group bg-gray-50 rounded-xl p-4 transition-all duration-300 hover:shadow-md hover:-translate-x-0.5">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-1">
                                    <div>
                                        <span class="font-semibold text-indigo-600">{{ $kudo->sender->name }}</span>
                                        <span class="text-gray-400 mx-1">→</span>
                                        <span class="font-semibold text-emerald-600">{{ $kudo->receiver->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $kudo->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($kudo->message, 80) }}</p>
                                @if($kudo->badge)
                                    <span class="inline-flex items-center gap-1 text-xs bg-amber-100 text-amber-700 px-2 py-1 rounded-lg">
                                        <span>🎖️</span> {{ $kudo->badge }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Aucune activité récente</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
            <div class="px-6 py-5 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h2 class="text-xl font-bold text-gray-800">Évolution des Kudos</h2>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-end justify-around h-64">
                    @foreach($weeklyStats as $stat)
                    <div class="text-center group">
                        <div class="relative">
                            <div class="w-12 bg-gradient-to-t from-indigo-500 to-purple-600 rounded-t-lg transition-all duration-700 group-hover:opacity-80" style="height: {{ $stat['percentage'] * 2 }}px"></div>
                            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                {{ $stat['count'] }}
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mt-3">{{ $stat['day'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection