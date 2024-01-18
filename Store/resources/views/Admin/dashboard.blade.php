<!-- admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="card-deck">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Products</h5>
            <p class="card-text">{{ $totalProducts }}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Categories</h5>
            <p class="card-text">{{ $totalCategories }}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Employees</h5>
            <p class="card-text">{{ $totalEmployees }}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Clients</h5>
            <p class="card-text">{{ $totalClients }}</p>
        </div>
    </div>
</div>
@endsection
