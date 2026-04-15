@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- En-tête -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">👑 Dashboard Administrateur</h2>
            <p class="text-gray-500">Gestion des utilisateurs et des check-ins</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="text-4xl mb-2">👥</div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</div>
                <div class="text-gray-500">Utilisateurs</div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="text-4xl mb-2">📝</div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalCheckIns }}</div>
                <div class="text-gray-500">Check-ins totaux</div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="text-4xl mb-2">📆</div>
                <div class="text-2xl font-bold text-gray-800">{{ $todayCheckIns }}</div>
                <div class="text-gray-500">Check-ins aujourd'hui</div>
            </div>
        </div>

        <!-- Liste des utilisateurs -->
        <div class="bg-white rounded-2xl shadow mb-8">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-gray-800">👤 Utilisateurs</h3>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Nom</th>
                            <th class="text-left py-2">Email</th>
                            <th class="text-left py-2">Rôle</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-b">
                            <td class="py-2">{{ $user->name }}</td>
                            <td class="py-2">{{ $user->email }}</td>
                            <td class="py-2">
                                @if($user->role === 'admin')
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Admin</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">Employé</span>
                                @endif
                            </td>
                            <td class="py-2">
                                @if($user->role === 'admin')
                                    <form action="{{ route('admin.make.employee', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-orange-600 hover:text-orange-800 text-sm">Rétrograder</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.make.admin', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm">Promouvoir admin</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Derniers check-ins -->
        <div class="bg-white rounded-2xl shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="font-bold text-gray-800">📋 Derniers check-ins</h3>
            </div>
            <div class="p-6">
                @foreach($checkIns as $checkIn)
                    <div class="border-b py-3 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="font-semibold">{{ $checkIn->user->name }}</span>
                                <span class="text-gray-500 text-sm ml-2">{{ $checkIn->date }}</span>
                                <p class="text-gray-600 text-sm mt-1">{{ \Illuminate\Support\Str::limit($checkIn->today, 50) }}</p>
                            </div>
                            <form action="{{ route('admin.delete.checkin', $checkIn->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Supprimer ce check-in ?')">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection