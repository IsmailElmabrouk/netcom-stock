<!-- resources/views/bonsorties/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Bon de Sortie</h2>

        <!-- Display validation errors if they exist -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Bon de Sortie Form -->
        <form action="{{ route('bonsorties.update', $record->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Date field -->
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $record->date }}" required>
            </div>

            <div class="form-group">
        <label for="editStock">Stock ID:</label>
        <input type="text" class="form-control" id="editStock" name="stock_id" value="{{ $record->stock_id }}" required>
    </div>


            <!-- Clients field -->
            <div class="form-group">
            <label for="editReason">Reason:</label>
            <input type="text" class="form-control" id="editReason" name="reason" required>
        </div>


            <!-- Update button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
