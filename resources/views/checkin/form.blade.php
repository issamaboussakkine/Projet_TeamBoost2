@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Mon check-in du {{ date('d/m/Y') }}</h2>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('checkin.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="yesterday" class="form-label">
                                <strong>📆 Hier, qu'ai-je fait ?</strong>
                            </label>
                            <textarea name="yesterday" id="yesterday" 
                                      class="form-control @error('yesterday') is-invalid @enderror"
                                      rows="3" 
                                      placeholder="Décris ce que tu as accompli hier...">{{ old('yesterday', $todayCheckIn->yesterday ?? '') }}</textarea>
                            @error('yesterday')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="today" class="form-label">
                                <strong>🎯 Aujourd'hui, que vais-je faire ?</strong>
                            </label>
                            <textarea name="today" id="today" 
                                      class="form-control @error('today') is-invalid @enderror"
                                      rows="3" 
                                      placeholder="Décris tes objectifs pour aujourd'hui...">{{ old('today', $todayCheckIn->today ?? '') }}</textarea>
                            @error('today')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="blockers" class="form-label">
                                <strong>⚠️ Blocages / Difficultés ?</strong>
                            </label>
                            <textarea name="blockers" id="blockers" 
                                      class="form-control @error('blockers') is-invalid @enderror"
                                      rows="2" 
                                      placeholder="As-tu des blocages ? Besoin d'aide ?">{{ old('blockers', $todayCheckIn->blockers ?? '') }}</textarea>
                            @error('blockers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                ✅ Enregistrer mon check-in
                            </button>
                            <a href="{{ route('team-wall') }}" class="btn btn-outline-secondary">
                                👥 Voir le mur d'équipe
                            </a>
                        </div>
                    </form>

                    @if($todayCheckIn)
                        <div class="mt-3 text-muted small">
                            ✔️ Tu as déjà fait ton check-in aujourd'hui. Tu peux le modifier.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection