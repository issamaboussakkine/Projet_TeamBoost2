@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">👥 Mur d'équipe</h2>
                <p class="text-gray-500 mt-1">{{ date('l d F Y') }}</p>
            </div>
            <a href="{{ route('checkin.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-5 rounded-xl transition">
                ✏️ Faire mon check-in
            </a>
        </div>

        @if($checkIns->isEmpty())
            <div class="bg-white rounded-2xl shadow p-12 text-center">
                <p class="text-gray-500">Aucun check-in aujourd'hui. Sois le premier !</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($checkIns as $checkIn)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <!-- En-tête avec nom et heure -->
                        <div class="flex items-center justify-between px-6 py-3 bg-gray-50 border-b">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <span class="text-indigo-600 font-bold">
                                        {{ strtoupper(substr($checkIn->user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-800">{{ $checkIn->user->name }}</span>
                                    <span class="text-gray-400 text-sm ml-2">{{ $checkIn->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Corps -->
                        <div class="p-6">
                            <!-- Hier -->
                            <div class="mb-5">
                                <div class="flex items-center gap-2 text-gray-500 text-sm mb-2">
                                    <span class="text-xl">📆</span>
                                    <span class="font-medium">Hier</span>
                                </div>
                                <p class="text-gray-700 ml-7">{{ $checkIn->yesterday }}</p>
                            </div>

                            <!-- Aujourd'hui -->
                            <div class="mb-5">
                                <div class="flex items-center gap-2 text-gray-500 text-sm mb-2">
                                    <span class="text-xl">🎯</span>
                                    <span class="font-medium">Aujourd'hui</span>
                                </div>
                                <p class="text-gray-700 ml-7">{{ $checkIn->today }}</p>
                            </div>

                            <!-- Blocages (si présent) -->
                            @if($checkIn->blockers)
                                <div class="bg-red-50 rounded-xl p-4 mt-2">
                                    <div class="flex items-center gap-2 text-red-600 text-sm mb-2">
                                        <span class="text-xl">⚠️</span>
                                        <span class="font-medium">Blocage / Difficulté</span>
                                    </div>
                                    <p class="text-red-700 ml-7">{{ $checkIn->blockers }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection