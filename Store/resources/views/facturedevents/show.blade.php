@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">

    <title>Détails de la facture de vente</title>
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

        .container {
            margin-top: 50px;
        }

        .card {
            margin-top: 20px;
        }

        .card-header {
            background-color: #3498db;
            color: white;
        }

        .list-group-item {
            border-color: #3498db;
        }

        .btn-primary,
        .btn-danger,
        .btn-success,
        .btn-secondary {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Adminhashobrd</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="{{'/Admin/admin-page'}}">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}">
                    <i class="fas fa-box"></i>
                    <span class="text">Gestion des produits</span>
                </a>
            </li>
            <li>
                <a href="{{ route('category.index') }}">
                    <i class="fas fa-th-large"></i>
                    <span class="text">Category</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employee.index') }}">
                    <i class="fas fa-users"></i>
                    <span class="text">Employé</span>
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.index') }}">
                    <i class="fas fa-user"></i>
                    <span class="text">Client</span>
                </a>
            </li>
            <li>
                <a href="{{ route('stock.index') }}">
                    <i class="fas fa-box-open"></i>
                    <span class="text">Stock</span>
                </a>
            </li>
            <li>
                <a href="{{ route('bonsorties.index') }}">
                    <i class="fas fa-clipboard"></i>
                    <span class="text">Bon de sortie</span>
                </a>
            </li>
            <li>
                <a href="{{ route('facturedevents.index') }}">
                    <i class="fas fa-file-invoice"></i>
                    <span class="text">Facture Devents</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <!-- Add more links for other pages as needed -->
        </ul>
    </section>
    <!-- SIDEBAR -->
    <!-- CONTENT -->
    <div class="container mt-5">
        <h1 class="mb-4">Détails de la facture de vente</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations de la facture</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Date:</strong>
                        <span>{{ $facture->date }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Quantity:</strong>
                        <span>{{ $facture->quantity }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Total Amount:</strong>
                        <span>{{ $facture->total_amount }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Product:</strong>
                        <span>{{ $facture->product->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Client:</strong>
                        <span>{{ $facture->client->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Payment Method:</strong>
                        <span>{{ $facture->payment_method }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Status Payment:</strong>
                        <span>{{ $facture->status_payment }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Remiss Applique:</strong>
                        <span>{{ $facture->remiss_applique ? 'Yes' : 'No' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Magasiner:</strong>
                        <span>{{ $facture->magasiner->name }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('facturedevents.edit', $facture->id) }}" class="btn btn-primary mr-2">Edit</a>
            <form action="{{ route('facturedevents.destroy', $facture->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this sale invoice?')">Delete</button>
            </form>
            <button class="btn btn-success" id="printButton">Print</button>
            <a href="{{ route('facturedevents.index') }}" class="btn btn-secondary">Back to Sale Invoices</a>
        </div>
    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            // Perform AJAX request for printing, you can customize this part based on your requirements
            alert('Printing feature will be implemented using Ajax.');
        });
    </script>

</body>
</html>
@endsection
