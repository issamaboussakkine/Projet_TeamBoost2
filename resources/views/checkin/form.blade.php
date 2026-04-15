@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <!-- En-tête avec déco -->
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Mon check-in</h2>
            <p class="text-gray-500 mt-2">{{ date('l d F Y') }}</p>
        </div>

        <!-- Carte formulaire -->
        <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
            <div class="p-6 sm:p-8">
                
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('checkin.store') }}">
                    @csrf

                    <!-- Hier -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            <span class="text-2xl mr-2">📆</span> Hier, qu'ai-je fait ?
                        </label>
                        <textarea name="yesterday" rows="3" 
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('yesterday') border-red-500 @enderror"
                            placeholder="Décris ce que tu as accompli hier...">{{ old('yesterday', $todayCheckIn->yesterday ?? '') }}</textarea>
                        @error('yesterday')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aujourd'hui -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            <span class="text-2xl mr-2">🎯</span> Aujourd'hui, que vais-je faire ?
                        </label>
                        <textarea name="today" rows="3" 
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('today') border-red-500 @enderror"
                            placeholder="Décris tes objectifs pour aujourd'hui...">{{ old('today', $todayCheckIn->today ?? '') }}</textarea>
                        @error('today')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Blocages -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            <span class="text-2xl mr-2">⚠️</span> Blocages / Difficultés ?
                        </label>
                        <textarea name="blockers" rows="2" 
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="As-tu des blocages ? Besoin d'aide ?">{{ old('blockers', $todayCheckIn->blockers ?? '') }}</textarea>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-between gap-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl transition duration-200 shadow-md hover:shadow-lg">
                            ✅ Enregistrer mon check-in
                        </button>
                        <a href="{{ route('team-wall') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            👥 Voir le mur d'équipe →
                        </a>
                    </div>

                    @if($todayCheckIn)
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg text-blue-600 text-sm">
                            ✔️ Tu as déjà fait ton check-in aujourd'hui. Tu peux le modifier.
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection