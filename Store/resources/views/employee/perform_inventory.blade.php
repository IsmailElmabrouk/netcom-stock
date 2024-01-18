<!-- employee.perform_inventory.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Effectuer un inventaire pour l'employé: {{ $employee->name }}</h1>

    <form action="{{ route('employee.performInventory', $employee->id) }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="product_id" class="form-label">Sélectionner un produit :</label>
            <select class="form-select" id="product_id" name="product_id" required>
                @foreach ($employee->stock->products as $product)
                    <option value="{{ $product->id }}">{{ $product->label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="adjustment_quantity" class="form-label">Quantité d'ajustement</label>
            <input type="number" class="form-control" id="adjustment_quantity" name="adjustment_quantity" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajuster l'inventaire</button>
    </form>

    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Retour aux employés</a>
@endsection
