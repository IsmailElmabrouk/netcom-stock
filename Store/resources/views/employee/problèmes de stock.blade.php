@extends('layouts.app')

@section('content')
    <h1>Problèmes de stocks pour les employés: {{ $employee->name }}</h1>

    @if ($employee->stockIssues->isEmpty())
        <p>Aucun problème de stock n'a été signalé pour cet employé.</p>
    @else
        <ul>
            @foreach ($employee->stockIssues as $issue)
                <li>{{ $issue->issue_description }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back to Employees</a>
@endsection