<!-- employee.show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="employee-details">
        <h1>Employee Details</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $employee->role }}</td>
                </tr>
                <tr>
                    <th>Stock ID</th>
                    <td>{{ $employee->stock_id }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('employee.index') }}" class="btn btn-primary">Back to Employees</a>

        <form action="{{ route('employee.reportStockIssue', $employee->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="issue_description">Description du problème de stock :</label>
                <textarea name="issue_description" id="issue_description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Signaler un problème de stock</button>
        </form>     
           <a href="{{ route('employee.problèmes_de_stock', $employee->id) }}" class="btn btn-info">View Stock Issues</a>
    </div>
@endsection
