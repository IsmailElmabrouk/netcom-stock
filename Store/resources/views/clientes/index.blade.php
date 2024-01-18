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

    <!-- Add Bootstrap 5 pagination styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <title>Produits</title>
 <script>
     $(document).ready(function() {
    $('#producttable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "pageLength": 4
    });
});
 </script>
    <style>
            @media (max-width: 576px) {
        #content {
            padding-top: 60px; /* Adjust padding for smaller screens */
        }

        #sidebar {
            display: none; /* Hide sidebar on small screens */
        }

        #clientes-table_wrapper .row {
            flex-direction: column-reverse; /* Reverse order of DataTables components for better mobile layout */
        }

        /* Add more responsive styles as needed */
    }
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
    <h1>Les Clients</h1>
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importClientsModal">Import Clients</a>

    <a href="{{ route('clientes.create') }}"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">Créer un client</a>
    <div class="table-container d-flex justify-content-center">
        <table id="producttable" class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- This part is only needed if you want to display clients without DataTables -->
            @foreach ($clientes as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->address }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showClientModal-{{ $client->id }}">Show</button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editClientModal-{{ $client->id }}">Edit</button>
                    </td>
                </tr>
            @endforeach
            <!-- End of optional section -->
        </tbody>
    </table>
</div>

    {{ $clientes->links() }}

    <!-- Import Clients Modal -->
   <div class="modal fade" id="importClientsModal" tabindex="-1" aria-labelledby="importClientsModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importClientsModalLabel">Import Clients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="clientFile" class="form-label">Choose file:</label>
                        <input type="file" class="form-control" id="clientFile" name="clientFile" accept=".csv, .xlsx, .xls">
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
                    @include('clientes._create') <!-- Include the create form here -->
                </div>
            </div>
        </div>
    </div>
   
    @foreach ($clientes as $client)
    <div class="modal fade" id="editClientModal-{{ $client->id }}" tabindex="-1" aria-labelledby="editClientModalLabel-{{ $client->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel-{{ $client->id }}">Modifier un Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('clientes.edit', ['client' => $client]) <!-- Pass the client data to the edit form -->
                </div>
            </div>
        </div>
    </div>
@endforeach


<!-- Add this after the existing edit modals -->
@foreach ($clientes as $client)
    <div class="modal fade" id="showClientModal-{{ $client->id }}" tabindex="-1" aria-labelledby="showClientModalLabel-{{ $client->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showClientModalLabel-{{ $client->id }}">Voir les détails du client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Include the show details content here -->
                    <p><strong>Name:</strong> {{ $client->name }}</p>
                    <p><strong>Email:</strong> {{ $client->email }}</p>
                    <p><strong>Phone:</strong> {{ $client->phone }}</p>
                    <p><strong>Address:</strong> {{ $client->address }}</p>
                    <!-- Add more details as needed -->
                </div>
            </div>
        </div>
    </div>
@endforeach

    </section>

 
    
</body>
</html>
@endsection
