@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Movements for Stock: {{ $stock->name }}</h1>

        <div class="mb-3">
            <p><strong>Location:</strong> {{ $stock->location }}</p>
            <p><strong>Current Capacity:</strong> {{ $stock->capacity }}</p>
        </div>

        <!-- Form for managing stock movements -->
        <form method="post" action="{{ route('stock.manageMovements.post', ['id' => $stock->id]) }}">
            @csrf
            <!-- Add your form fields and logic here for managing movements -->
            <div class="mb-3">
                <label for="movement_type" class="form-label">Movement Type</label>
                <select class="form-select" id="movement_type" name="movement_type" required>
                    <option value="add">Add to Stock</option>
                    <option value="remove">Remove from Stock</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Movement</button>
        </form>

        <a href="{{ route('stock.index') }}" class="btn btn-secondary mt-3">Back to Stocks</a>
    </div>
@endsection
