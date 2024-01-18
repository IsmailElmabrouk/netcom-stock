@extends('layouts.app')

@section('content')
    <h1>Edit Employee</h1>

    <form action="{{ route('employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" class="form-control" id="role" name="role" value="{{ $employee->role }}">
        </div>
        <div class="form-group">
            <label for="stock_id">Stock ID</label>
            <input type="number" class="form-control" id="stock_id" name="stock_id" value="{{ $employee->stock_id }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
