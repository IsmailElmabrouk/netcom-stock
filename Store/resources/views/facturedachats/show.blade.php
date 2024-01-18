@extends('layouts.app')

@section('content')
    <h1>Purchase Invoice Details</h1>

    <table class="table">
        <tbody>
            <tr>
                <th>Date</th>
                <td>{{ $invoice->date }}</td>
            </tr>
            <tr>
                <th>Client</th>
                <td>{{ $invoice->client->name }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('facturedachats.index') }}" class="btn btn-primary">Back</a>
</div>
