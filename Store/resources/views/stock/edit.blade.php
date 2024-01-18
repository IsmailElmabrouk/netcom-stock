@extends('layouts.app')

@section('content')
    <h1>Edit Stock</h1>

    <form action="{{ route('stock.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class a="form-control" id="name" name="name" value="{{ $stock->name }}">
        </div>
        <div class="form-group">
            <label for="location">Name</label>
            <input type="text" class a="form-control" id="location" name="location" value="{{ $stock->location }}">
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $stock->capacity }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
