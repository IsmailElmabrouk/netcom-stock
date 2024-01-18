<!-- resources/views/magasiner_index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the Magasiner Index Page</h1>

        <!-- Display notifications -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach(Auth::user()->notifications as $notification)
            @if($notification->data['bonSortieId'])
                <div class="alert alert-info">
                    Your Bon de Sortie with ID {{ $notification->data['bonSortieId'] }} has been {{ $notification->data['status'] }}.
                </div>
            @endif
        @endforeach

        <!-- Other content of the Magasiner Index page goes here -->
    </div>
@endsection
