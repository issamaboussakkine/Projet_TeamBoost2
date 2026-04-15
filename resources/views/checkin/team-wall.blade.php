@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>👥 Mur d'équipe - {{ date('d/m/Y') }}</h2>
                    <a href="{{ route('checkin.index') }}" class="btn btn-sm btn-primary float-end">✏️ Faire mon check-in</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($checkIns->isEmpty())
                        <div class="alert alert-info">
                            Aucun check-in n'a encore été fait aujourd'hui. Sois le premier !
                        </div>
                    @else
                        <div class="row">
                            @foreach($checkIns as $checkIn)
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <strong>{{ $checkIn->user->name }}</strong>
                                            <span class="text-muted float-end">{{ $checkIn->created_at->format('H:i') }}</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <strong>📆 Hier :</strong>
                                                <p class="mb-1">{{ $checkIn->yesterday }}</p>
                                            </div>
                                            <div class="mb-2">
                                                <strong>🎯 Aujourd'hui :</strong>
                                                <p class="mb-1">{{ $checkIn->today }}</p>
                                            </div>
                                            @if($checkIn->blockers)
                                                <div class="mb-2">
                                                    <strong>⚠️ Blocages :</strong>
                                                    <p class="mb-1 text-danger">{{ $checkIn->blockers }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection