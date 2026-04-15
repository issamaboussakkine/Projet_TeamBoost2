@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="row justify-content-center w-100">
        
        <!-- Carte 1 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-4 text-center p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="display-1 mb-3">📆</div>
                    <h1 class="display-4 fw-bold">{{ $todayCheckInCount }}</h1>
                    <p class="mb-0 fs-5">"Petit pas aujourd'hui,</p>
                    <p class="fs-5">grand bond demain"</p>
                    <hr class="my-3 bg-white">
                    <small>Check-ins effectués aujourd'hui</small>
                </div>
            </div>
        </div>

        <!-- Carte 2 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-4 text-center p-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-white">
                    <div class="display-1 mb-3">📝</div>
                    <h1 class="display-4 fw-bold">{{ $userCheckInsCount }}</h1>
                    <p class="mb-0 fs-5">"La constance</p>
                    <p class="fs-5">est la clé du succès"</p>
                    <hr class="my-3 bg-white">
                    <small>Vos check-ins totaux</small>
                </div>
            </div>
        </div>

        <!-- Carte 3 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-4 text-center p-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body text-white">
                    <div class="display-1 mb-3">👥</div>
                    <h1 class="display-4 fw-bold">{{ $totalUsers }}</h1>
                    <p class="mb-0 fs-5">"Seul on va plus vite,</p>
                    <p class="fs-5">ensemble on va plus loin"</p>
                    <hr class="my-3 bg-white">
                    <small>Membres dans l'équipe</small>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection