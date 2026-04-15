@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <!-- En-tête -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-xl p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold mb-2 tracking-tight">Classement des contributions</h1>
                    <p class="text-gray-300">Les membres les plus actifs et reconnus de l'équipe</p>
                </div>
                <div class="bg-white/10 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">🏅 Rang</th>
                            <th class="px-6 py-4 text-left font-semibold">👤 Membre</th>
                            <th class="px-6 py-4 text-center font-semibold">⭐ Kudos reçus</th>
                            <th class="px-6 py-4 text-center font-semibold">🏆 Niveau</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $index => $user)
                        <tr class="transition-all duration-300 hover:bg-gray-50 {{ $index == 0 ? 'bg-amber-50' : ($index == 1 ? 'bg-gray-50' : '') }}">
                            <td class="px-6 py-4 font-bold">
                                @if($index == 0)
                                    <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-sm">🥇 1er</span>
                                @elseif($index == 1)
                                    <span class="bg-gray-400 text-white px-3 py-1 rounded-full text-sm">🥈 2ème</span>
                                @elseif($index == 2)
                                    <span class="bg-cyan-500 text-white px-3 py-1 rounded-full text-sm">🥉 3ème</span>
                                @else
                                    <span class="text-gray-500">{{ $index + 1 }}ème</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                                        @if($index == 0)
                                            <span class="ml-2 bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-lg">🏆 Champion</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-indigo-100 text-indigo-700 font-semibold px-3 py-1 rounded-lg">{{ $user->received_kudos_count }} kudos</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->received_kudos_count >= 10)
                                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-lg">🏆 Expert</span>
                                @elseif($user->received_kudos_count >= 5)
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg">⭐ Confirmé</span>
                                @elseif($user->received_kudos_count >= 1)
                                    <span class="bg-cyan-100 text-cyan-700 px-3 py-1 rounded-lg">🌟 Débutant</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg">⏳ En attente</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Aucune donnée disponible</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection