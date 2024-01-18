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

    <title>Facture Devents</title>
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
        <h1>Factures de vente</h1>
        <div style="overflow-x: auto; margin-top: 20px;">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quantité</th>
                        <th>Montant total</th>
                        <th>Produit</th>
                        <th>Client</th>
                        <th>Mode de paiement</th>
                        <th>Statut du paiement</th>
                        <th>Remise appliquée</th>
                        <th>Magasiner</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factures as $facture)
                        <tr>
                            <td>{{ $facture->date }}</td>
                            <td>{{ $facture->quantity }}</td>
                            <td id="totalAmount{{ $facture->id }}">{{ $facture->total_amount }}</td>
                            <td>{{ $facture->product->name }}</td>
                            <td>{{ $facture->client->name }}</td>
                            <td>{{ $facture->payment_method }}</td>
                            <td>{{ $facture->status_payment }}</td>
                            <td>{{ $facture->remiss_applique ? 'Yes' : 'No' }}</td>
                            <td>
                                @foreach ($magasinerUsers as $magasiner)
                                    @if ($magasiner->id == $facture->magasiner_id)
                                        {{ $magasiner->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('facturedevents.show', $facture->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('facturedevents.edit', $facture->id) }}" class="btn btn-secondary">Edit</a>
                                <button class="btn btn-success calculate-total" data-facture-id="{{ $facture->id }}">
                                    Calculate Total
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('facturedevents.create') }}" class="btn btn-success">Créer une facture de vente</a>
        <script>
            $(document).ready(function () {
                $('.table').DataTable({
                    "pageLength": 3, // Set the number of rows per page
                });

                // Function to calculate total amount
                function calculateTotalAmount(id) {
                    fetch(`/facturedevents/calculate-total/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            // Update the total amount in the table
                            document.getElementById(`totalAmount${id}`).innerText = `Total Amount: ${data.totalAmount}`;
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Attach click events to all elements with class "calculate-total"
                document.querySelectorAll('.calculate-total').forEach(button => {
                    button.addEventListener('click', function () {
                        // Get the facture ID from the data attribute
                        const factureId = this.getAttribute('data-facture-id');
                        calculateTotalAmount(factureId);
                    });
                });
            });
        </script>
    </section>
    <!-- CONTENT -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add your custom scripts if any -->
</body>
</html>
@endsection
