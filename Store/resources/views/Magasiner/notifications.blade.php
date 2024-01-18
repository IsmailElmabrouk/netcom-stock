@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Notifications</div>
        <div class="card-body">
            <ul>
                @forelse(auth()->user()->notifications as $notification)
                    <li>{{ $notification->data['message'] }}</li>
                    <pre>{{ json_encode($notification->data) }}</pre>
                @empty
                    <li>Aucune notification non lue</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
    