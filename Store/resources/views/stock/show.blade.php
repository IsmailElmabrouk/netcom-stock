@extends('layouts.app')

@section('content')
    <h1>Détails du stock</h1>

    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th>Nom</th>
                    <td>{{ $stock->name }}</td>
                </tr>
                <tr>
                    <th>Emplacement</th>
                    <td>{{ $stock->location }}</td>
                </tr>
                <tr>
                    <th>Capacité</th>
                    <td>{{ $stock->capacity }}</td>
                </tr>
                <tr>
                    <th>Espace disponible</th>
                    <td>{{ $stock->capacity - $stock->getTotalQuantityAttribute() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>Quantité totale pour chaque produit</h2>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('stock.index') }}" class="btn btn-primary">Retour</a>
@endsection
