@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminHub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add these links in the head section -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

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
    margin-bottom: 15px; /* Adjust the margin as needed */
    text-decoration: none;
    color: #3498db;
}

#sidebar .brand i {
    margin-right: 10px; /* Adjust the margin as needed */
    font-size: 24px; /* Adjust the font size as needed */
}

#sidebar .brand .text {
    font-size: 20px; /* Adjust the font size as needed */
}

        /* Custom styles for the card section */
        .form-container {
            margin-top: 50px;
            margin-left: 250px; /* Adjust this value based on your sidebar width */
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">{{ Auth::user()->name }}</span>
        </a>
    
        <!-- User information -->
   
		<ul class="side-menu top">
			<li class="active">
				<a href="{{ url('/Admin/admin-page') }}">
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
            @auth
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endauth
			<!-- Add more links for other pages as needed -->
		</ul>
    <ul class="side-menu">
        <!-- Add more links for other pages as needed -->
    </ul>
</section>
<!-- SIDEBAR -->

    <section id="content">
        <div class="container mt-5">
            <h1>Modifier la facture de vente</h1>

            <form method="POST" action="{{ route('facturedevents.update', $factures->id) }}">
                @csrf
                @method('PUT')

                <!-- Continue adding your other form fields here -->

                <div class="form-group">
                    <!-- Add your other form fields here -->
                </div>

                <div class="form-group">
                    <label for="client_id">Client:</label>
                    <select class="form-control" name="client_id" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ $factures->client->id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="magasiner_id">Magasiner:</label>
                    <select class="form-control" name="magasiner_id" required>
                        @foreach ($magasins as $magasiner)
                            <option value="{{ $magasiner->id }}" {{ $factures->magasiner->id == $magasiner->id ? 'selected' : '' }}>
                                {{ $magasiner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="payment_method">Mode de paiement:</label>
                    <input type="text" class="form-control" name="payment_method" value="{{ old('payment_method', $factures->payment_method) }}" required>
                </div>

                <div class="form-group">
                    <label for="status_payment">Statut du paiement:</label>
                    <input type="text" class="form-control" name="status_payment" value="{{ old('status_payment', $factures->status_payment) }}" required>
                </div>

                <div class="form-group">
                    <label for="total_amount">Montant total:</label>
                    <input type="number" class="form-control" name="total_amount" value="{{ old('total_amount', $factures->total_amount) }}" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remiss_applique" {{ old('remiss_applique', $factures->remiss_applique) ? 'checked' : '' }}>
                        <label class="form-check-label" for="remiss_applique">Remise appliquée</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour la facture</button>
            </form>
        </div>
    </section>
    <!-- CONTENT -->
  
    <!-- CONTENT -->

    <script>
        $(document).ready(function () {
            // Initialize DataTable if needed
            // $('.table').DataTable();
        });
    </script>

</body>
</html>
@endsection
