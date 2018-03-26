@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
        Users - {{ $user->full_name }} - Achievements
        @endcomponent
    </div>

    <div class="row">
        @foreach($user->achievements->sortBy('achievement_id') as $achievement)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center {{ $achievement->isUnlocked() ? 'bg-success' : ($achievement->details->points > 1 ? 'bg-warning' : 'bg-danger') }}">
                        <h3>{{ $achievement->details->name }}</h3>
                        <h4>{{ $achievement->details->description }}</h4>
                        <h5>Progress: {{ $achievement->isUnlocked() ? 'Unlocked!' : ($achievement->details->points > 1 ? $achievement->points . '/' . $achievement->details->points : 'Locked!') }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop