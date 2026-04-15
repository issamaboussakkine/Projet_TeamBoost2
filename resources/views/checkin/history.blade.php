@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mon historique de check-ins</h1>

    @forelse($checkIns as $checkin)
        <div class="card mb-2">
            <div class="card-body">
                <strong>Date : {{ $checkin->checkin_date }}</strong>
                <p>Humeur : {{ $checkin->mood }}</p>
                <p>Objectif du jour : {{ $checkin->what_i_will_do_today }}</p>
                @if($checkin->what_i_did_yesterday)
                    <p>Hier : {{ $checkin->what_i_did_yesterday }}</p>
                @endif
            </div>
        </div>
    @empty
        <p>Tu n'as pas encore fait de check-in.</p>
    @endforelse

    {{ $checkIns->links() }}
</div>
@endsection