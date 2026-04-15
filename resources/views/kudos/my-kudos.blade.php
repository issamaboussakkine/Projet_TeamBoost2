@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <!-- En-tête -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-xl p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold mb-2 tracking-tight">Mes Kudos</h1>
                    <p class="text-gray-300">Historique complet de vos reconnaissances</p>
                </div>
                <div class="bg-white/10 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes statistiques -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-indigo-100 text-sm">Kudos reçus</p>
                        <p class="text-5xl font-bold mt-2">{{ count($receivedKudos) }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M6 14h12M5 18h14M7 6h10"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-emerald-100 text-sm">Kudos envoyés</p>
                        <p class="text-5xl font-bold mt-2">{{ count($sentKudos) }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button class="tab-btn active px-6 py-4 text-sm font-semibold transition-all" data-tab="received">
                        📥 Reçus <span class="ml-2 bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">{{ count($receivedKudos) }}</span>
                    </button>
                    <button class="tab-btn px-6 py-4 text-sm font-semibold transition-all" data-tab="sent">
                        📤 Envoyés <span class="ml-2 bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ count($sentKudos) }}</span>
                    </button>
                </nav>
            </div>

            <!-- Reçus -->
            <div id="received-tab" class="tab-content active overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">De</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Badge</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($receivedKudos as $kudo)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-indigo-600">{{ $kudo->sender->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $kudo->message }}</td>
                            <td class="px-6 py-4">
                                @if($kudo->badge)
                                    <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2 py-1 rounded-lg">{{ $kudo->badge }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $kudo->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Aucun kudos reçu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Envoyés -->
            <div id="sent-tab" class="tab-content hidden overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">À</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Badge</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($sentKudos as $kudo)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-emerald-600">{{ $kudo->receiver->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $kudo->message }}</td>
                            <td class="px-6 py-4">
                                @if($kudo->badge)
                                    <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2 py-1 rounded-lg">{{ $kudo->badge }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $kudo->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Aucun kudos envoyé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active', 'border-indigo-500', 'text-indigo-600'));
            btn.classList.add('active', 'border-indigo-500', 'text-indigo-600');
            
            const tabId = btn.dataset.tab;
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            document.getElementById(`${tabId}-tab`).classList.remove('hidden');
        });
    });
</script>

<style>
    .tab-btn {
        border-bottom: 2px solid transparent;
    }
    .tab-btn.active {
        border-bottom-color: #6366f1;
        color: #6366f1;
    }
    .tab-content.active {
        display: block;
    }
    .tab-content {
        display: none;
    }
</style>
@endsection