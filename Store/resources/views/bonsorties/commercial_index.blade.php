@extends('layouts.app')

@section('content')
    <h1>Bons de Sortie à Valider</h1>

    @if(count($bonsAValider) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Raison</th>
                    <!-- Ajoutez d'autres colonnes selon vos besoins -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bonsAValider as $bon)
                    <tr>
                        <td>{{ $bon->id }}</td>
                        <td>{{ $bon->date }}</td>
                        <td>{{ $bon->reason }}</td>
                        <!-- Ajoutez d'autres colonnes selon vos besoins -->
                        <td>
                            <a href="{{ route('bonsorties.validate', ['id' => $bon->id]) }}">Valider</a>
                            <a href="{{ route('bonsorties.reject', ['id' => $bon->id]) }}">Rejeter</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun bon de sortie à valider pour le moment.</p>
    @endif
@endsection
