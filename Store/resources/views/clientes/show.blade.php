@extends('layouts.app')

@section('content')
    <h1>Client Details</h1>

    <table class="table">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $client->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $client->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $client->phone }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $client->address }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('clientes.index') }}" class="btn btn-primary">Back</a>
@endsection
