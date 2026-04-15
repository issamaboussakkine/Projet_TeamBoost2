@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Check-ins du jour</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @forelse($todayCheckIns as $checkin)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $checkin->user->name }}</h5>
                <p>Humeur : 
                    @switch($checkin->mood)
                        @case('super') 😁 Super @break
                        @case('bien') 😊 Bien @break
                        @case('neutre') 😐 Neutre @break
                        @case('fatigue') 😴 Fatigué @break
                        @case('stresse') 😰 Stressé @break
                    @endswitch
                </p>
                <p><strong>Aujourd'hui :</strong> {{ $checkin->what_i_will_do_today }}</p>
                @if($checkin->blockers)
                    <p class="text-danger"><strong>Blocage :</strong> {{ $checkin->blockers }}</p>
                @endif
            </div>
        </div>
    @empty
        <p>Aucun check-in pour aujourd'hui.</p>
    @endforelse
</div>
@endsection