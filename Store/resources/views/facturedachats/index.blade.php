@extends('layouts.app')

@section('content')
    <h1>Facture d'achat</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factures as $facture)
                <tr>
                    <td>{{ $facture->date }}</td>
                    <td>{{ $facture->client->name }}</td>
                    <td>
                        <a href="{{ route('facturedachats.show', $invoice->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('facturedachats.edit', $invoice->id) }}" class="btn btn-secondary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('facturedachats.create') }}" class="btn btn-success">Créer une facture d'achat</a>
@endsection
