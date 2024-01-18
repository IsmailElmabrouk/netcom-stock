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

    <title>Produits</title>
    
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

        /* Center the table */
        .center-table {
            margin: auto;
        }

        /* Adjust margin for mobile devices */
        .mb-3 {
            margin-bottom: 1rem!important;
            margin-left: 0;
        }

        /* Make the table responsive */
        @media (max-width: 767px) {
            .table th, .table td {
                padding: 8px;

            }
            .mb-3 {
            margin-left: auto;
        }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
@include('layouts.sidebar')

<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <h1>Les utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">Create Users</a>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table id="usersTable" class="table table-bordered mb-5">
                    <!-- Table Header -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">Modifier</a>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">Afficher</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</section>
<!-- Add the modal for user creation -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Create Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('users._create') <!-- Include the create form here -->
            </div>
        </div>
    </div>
</div>
@foreach ($users as $user)
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('users.edit', ['user' => $user]) <!-- Include the edit form here -->
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Add these scripts at the bottom of your layout, after including jQuery and Bootstrap CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#usersTable').DataTable();
    });
</script>
</body>
</html>

@endsection
