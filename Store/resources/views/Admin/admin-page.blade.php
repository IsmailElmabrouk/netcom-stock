@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Netcom') }} 
	
    </title>

	<style>
		/* Custom styles for sidebar icons */
    

		/* Custom styles for the card section */
         
        /* Custom styles for the animated icon */
        .animated-icon {
            animation: rotate 2s infinite linear;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #graph-section {
            margin-top: 50px;
        }

        .graph-container {
            text-align: center;
        }
        .even-row {
    background-color: rgba(255, 255, 255, 0.8); /* Adjust the alpha value for transparency */
}

.odd-row {
    background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha value for transparency */
}
.todo-list-container {
    max-height: 300px; /* Adjust the maximum height as needed */
    overflow-y: auto;
}

.todo-list-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px; /* Adjust the margin as needed */
}

.todo-list-table th, .todo-list-table td {
    border: 1px solid #ddd; /* Add border styling as needed */
    padding: 8px;
    text-align: left;
}

.todo-list-table th {
    background-color: #f2f2f2; /* Add header background color as needed */
}

/*-----*/

		/* Add more styles as needed */

        
    @media only screen and (max-width: 768px) {
        body {
            font-size: 14px; /* Adjust font size for smaller screens */
        }

        .custom-container {
            padding: 10px; /* Adjust padding for smaller screens */
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px; /* Add negative margin to counteract padding on columns */
        }

        .col-md-4 {
            flex: 0 0 100%; /* Make columns full-width on smaller screens */
            max-width: 100%;
            padding: 0 10px; /* Add padding to columns */
        }
    }
	</style>
</head>

<body>

    @include('layouts.sidebar')
	<!-- SIDEBAR -->
    <nav>
  
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
       
    </nav>
	<!-- CONTENT -->
	<section id="content">
    <main>
        <!---card---->
        @include('layouts.card')
        
        
        <!-- Display Products Almost Empty -->
@if(count($productsAlmostEmpty) > 0)
    <div class="alert alert-danger" role="alert">
        <strong>Attention!</strong> Certains produits sont presque terminés.
    </div>
    <div>
        <h2>Produits Presque Terminés</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productsAlmostEmpty as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

        <!-- Display notifications -->
        
               <!-- Display notifications -->
               <div id="graph-section" style="width: 900px;" class="graph-container">
                <h2>Details</h2>
                <!-- Google Chart Container -->
                <div id="googleChart" style="width: 100%; height: 300px;"></div>
                
                <!-- Additional Google Chart Container -->
                 
            </div>
            <!-- Display Bons de Sortie awaiting Admin approval -->
       <!-- Display Bons de Sortie awaiting Admin approval -->
<div>
    <h2>Bons de Sortie Awaiting Admin Approval</h2>
    <table class="table" id="productsAlmostEmptyTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Reason</th>
                <th>User</th>
                 <th>Commercial Verified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bonsSortiesAwaitingCommercial as $bonSortie)
                <tr>
                    <td>{{ $bonSortie->date }}</td>
                    <td>{{ $bonSortie->reason }}</td>
                    <td>{{ $bonSortie->user->name }}</td>
                    <td>
                        @if($bonSortie->verified_by_commercial)
                            <span class="text-success">Verified</span>
                        @else
                            <span class="text-danger">Not Verified</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-info" onclick="openViewModal('{{ $bonSortie->id }}')">View</button>
                        <!-- Display Accept and Reject buttons only for Pending Bons de Sortie -->
                        @if($bonSortie->status == 0 && $bonSortie->verified_by_commercial)
                            <form action="{{ route('bonsorties.update-status', $bonSortie->id) }}" method="post" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="1"> <!-- 1 for Accept -->
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            <button type="button" class="btn btn-danger" onclick="openRejectModal('{{ $bonSortie->id }}')">Reject</button>

<!-- Modal for Reject confirmation -->
<div class="modal fade" id="rejectModal{{ $bonSortie->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Reject Bon de Sortie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bonsorties.update-status', $bonSortie->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="2"> <!-- 2 for Reject -->
                    <div class="form-group">
                        <label for="reject_justification">Comments:</label>
                        <textarea name="reject_justification" id="reject_justification" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
</td>
</tr>
@endforeach
</tbody>
    </table>
 
</div>


            </main>
        </section>
    <!-- CONTENT -->

    <!-- Pass PHP variables to JavaScript using data-* attributes -->
    <div id="phpData"
         data-totalProducts="{{ $totalProducts }}"
         data-totalClients="{{ $totalClients }}"
         data-totalEmployees="{{ $totalEmployees }}"
         data-totalCategories="{{ $totalCategories }}"
         data-totalFactureDevents="{{ $totalFactureDevents }}"
         data-totalUser="{{ $totalUser }}"
     </div>

    <!-- Include the Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        // Load the Google Charts library
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Access PHP variables from data-* attributes
            var totalProducts = document.getElementById('phpData').getAttribute('data-totalProducts');
            var totalClients = document.getElementById('phpData').getAttribute('data-totalClients');
            var totalEmployees = document.getElementById('phpData').getAttribute('data-totalEmployees');
            var totalCategories = document.getElementById('phpData').getAttribute('data-totalCategories');
            var totalFactureDevents = document.getElementById('phpData').getAttribute('data-totalFactureDevents');
            var totalUser = document.getElementById('phpData').getAttribute('data-totalUser');
            var stockStatus = document.getElementById('phpData').getAttribute('data-stockStatus');
            var stockCapacity = document.getElementById('phpData').getAttribute('data-stockCapacity');

            // Convert string variables to integers
            totalProducts = parseInt(totalProducts);
            totalClients = parseInt(totalClients);
            totalEmployees = parseInt(totalEmployees);
            totalCategories = parseInt(totalCategories);
            totalFactureDevents = parseInt(totalFactureDevents);
            totalUser = parseInt(totalUser);

            // Google Pie Chart code goes here for Details
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Count'],
                ['Total Products', totalProducts],
                ['Total Clients', totalClients],
                ['Total Employees', totalEmployees],
                ['Total Categories', totalCategories],
                ['Total Facture Devents', totalFactureDevents],
                ['Total Users', totalUser],
            ]);

            var options = {
                title: 'Details',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('googleChart'));
            chart.draw(data, options);

            // Google Pie Chart code goes here for Stock Status
            var stockData = google.visualization.arrayToDataTable([
                ['Task', 'Space'],
                ['Used Space', stockCapacity - stockStatus],
                ['Available Space', stockStatus]
            ]);

            var stockOptions = {
                title: 'Stock Status',
                pieHole: 0.4,
            };

            var stockChart = new google.visualization.PieChart(document.getElementById('googleStockGraph'));
            stockChart.draw(stockData, stockOptions);
        }
    </script>
<script>
  function openRejectModal(bonSortieId) {
        var modalId = 'rejectModal' + bonSortieId;
        $('#' + modalId).modal('show');
    }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    // ... Existing code ...

    function drawCharts() {
        // ... Existing code ...

        // Google Pie Chart code goes here for Products Almost Empty
        var productsAlmostEmptyData = google.visualization.arrayToDataTable([
            ['Produit', 'Quantité'],
            @foreach($productsAlmostEmpty as $product)
                ['{{ $product->name }}', {{ $product->quantity }}],
            @endforeach
        ]);

        var productsAlmostEmptyOptions = {
            title: 'Produits Presque Terminés',
            pieHole: 0.4,
        };

        var productsAlmostEmptyChart = new google.visualization.PieChart(document.getElementById('googleProductsAlmostEmptyGraph'));
        productsAlmostEmptyChart.draw(productsAlmostEmptyData, productsAlmostEmptyOptions);
    }
</script>
<script>
    $(document).ready(function () {
        $('#productsAlmostEmptyTable').DataTable({
            "order": [[0, "desc"]], // Order by the first column (assumed to be the date) in descending order
            "pageLength": 5, // Set the number of items to display per page
        });
    });
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</body>
</html>
@endsection