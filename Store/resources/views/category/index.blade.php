@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add these links in the head section -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <title>Categories</title>
    <style>
        /* Custom styles for sidebar icons */
        #sidebar .side-menu i {
            color: #3498db; /* Add your desired color */
            opacity: 0.8; /* Add opacity to make the icons transparent */
        }
        /* Add more styles as needed */
#sidebar .brand {
    display: flex;
    align-items: center;
    padding: 10px; /* Adjust the padding as needed */
    margin-bottom: 10px; /* Adjust the margin as needed */
    text-decoration: none;
    color: #3498db;
}

#sidebar .brand i {
    margin-right: 10px; /* Adjust the margin as needed */
    font-size: 24px; /* Adjust the font size as needed */
}

#sidebar .brand .text {
    font-size: 18px; /* Adjust the font size as needed */
}


        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
            text-align: left;
        }

        .table th, .table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;

        }

        .table th {
            background-color: #3498db;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>

    <!-- SIDEBAR -->
     @include('layouts.sidebar')
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
    <h1>Les Categories</h1>
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importCategoriesModal">Import Categories</a>

    <a href="{{ route('category.create') }}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">Create Category</a>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}

    <!-- Import Categories Modal -->
<div class="modal fade" id="importCategoriesModal" tabindex="-1" aria-labelledby="importCategoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importCategoriesModalLabel">Import Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryFile" class="form-label">Choose file:</label>
                        <input type="file" class="form-control" id="categoryFile" name="categoryFile" accept=".csv, .xlsx, .xls">
                    </div>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('category._create') <!-- Include the create form here -->
                </div>
            </div>
        </div>
    </div>
@endsection
