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

    <title>Stock-Netcom</title>
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

        /* Responsive styles */
        @media (max-width: 767px) {
            .table {
                font-size: 14px; /* Adjust font size for smaller screens */
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <!-- CONTENT -->
    <section id="content">
        <a href="{{ route('stock.create') }}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">Créer un stock</a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Emplacement</th>
                        <th>Capacité</th>
                        <th>Quantité totale</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $stock->name }}</td>
                            <td>{{ $stock->location }}</td>
                            <td>{{ $stock->capacity }}</td>
                            <td>{{ $stock->getTotalQuantityAttribute() }}</td>
                            <td>
                                <a href="{{ route('stock.show', $stock->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-secondary">Edit</a>
                              </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('stock._create') <!-- Include the create form here -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Simulating user type, replace this with your actual logic
        var userType = 1; // Change this to 2 to test the other user type
    
        $(document).ready(function() {
          $('#dashboard-link').on('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior
    
            // Check user type and redirect accordingly
            if (userType === 1) {
              window.location.href = 'Admin/admin-page'; // Redirect for type 1
            } else if (userType === 2) {
              window.location.href = 'Magasiner/magasiner-page'; // Redirect for type 2
            }
          });
        });
      </script>
</body>
</html>
@endsection
