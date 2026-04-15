@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <!-- En-tête -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-xl p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold mb-2 tracking-tight">Envoyer un Kudos</h1>
                    <p class="text-gray-300">Reconnaissez le travail exceptionnel de vos collègues</p>
                </div>
                <div class="bg-white/10 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="max-w-7xl mx-auto mb-6">
            <div class="bg-emerald-50 border-l-4 border-emerald-500 rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulaire -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">Nouvelle reconnaissance</h2>
                    </div>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('kudos.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Destinataire</label>
                            <select name="to_user_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" required>
                                <option value="">-- Sélectionner un collègue --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Je tiens à remercier..." required></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Badge</label>
                            <select name="badge" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                <option value="">-- Aucun badge --</option>
                                <option value="🌟 Super aide">🌟 Super aide</option>
                                <option value="💡 Idée géniale">💡 Idée géniale</option>
                                <option value="🤝 Team player">🤝 Team player</option>
                                <option value="🚀 Au top">🚀 Au top</option>
                                <option value="💪 Super effort">💪 Super effort</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Envoyer le Kudos
                            </div>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Derniers Kudos -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-gray-800">Dernières reconnaissances</h2>
                        </div>
                        <span class="bg-indigo-100 text-indigo-700 text-sm font-semibold px-3 py-1 rounded-lg">{{ $recentKudos->count() }} kudos</span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">De</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">À</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Message</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Badge</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentKudos as $kudo)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-indigo-600">{{ $kudo->sender->name }}</td>
                                <td class="px-6 py-4 font-medium text-emerald-600">{{ $kudo->receiver->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ Str::limit($kudo->message, 40) }}</td>
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
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Aucun kudos pour le moment</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection