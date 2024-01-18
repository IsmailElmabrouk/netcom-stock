@extends('layouts.app')

@section('content')
    <h1>Category Details</h1>

    <table class="table">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $category->description }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('category.index') }}" class="btn btn-primary">Back</a>
@endsection
