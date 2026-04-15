@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Check-in quotidien</h1>
    <p>Comment ça va aujourd'hui ?</p>

    <form method="POST" action="{{ route('checkin.store') }}">
        @csrf

        <div class="mb-3">
            <label>Comment te sens-tu aujourd'hui ?</label>
            <select name="mood" class="form-control" required>
                <option value="super">😁 Super</option>
                <option value="bien">😊 Bien</option>
                <option value="neutre">😐 Neutre</option>
                <option value="fatigue">😴 Fatigué</option>
                <option value="stresse">😰 Stressé</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Qu'as-tu fait hier ?</label>
            <textarea name="what_i_did_yesterday" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Que vas-tu faire aujourd'hui ?</label>
            <textarea name="what_i_will_do_today" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>As-tu des blocages ?</label>
            <textarea name="blockers" class="form-control" rows="2"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Valider mon check-in</button>
    </form>
</div>
@endsection