@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

      <script>

        // Simulating user type, replace this with your actual logic
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
google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Fetch all products from the server
        $.ajax({
            url: '{{ route('products.all') }}', // Replace with your actual route
            method: 'GET',
            success: function(response) {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Product');
                data.addColumn('number', 'Quantity');

                var chartData = [];

                // Assuming the response is an array of products with 'name' and 'quantity' properties
                response.forEach(function(product) {
                    chartData.push([product.name, product.quantity]);
                });

                data.addRows(chartData);

                var options = {
                    title: 'Product Quantity Distribution',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('productChart'));
                chart.draw(data, options);
            },
            error: function(error) {
                console.error('Error fetching products:', error);
            }
        });
    }

// add animation to create modale
$(document).ready(function () {
        $('#createProductModal').on('show.bs.modal', function () {
            // Add the animation class to the modal dialog
            $('.modal-dialog', this).addClass('animate__animated animate__fadeIn');
        });

        // Optional: If you want to remove the animation class when the modal is closed
        $('#createProductModal').on('hidden.bs.modal', function () {
            // Remove the animation class from the modal dialog
            $('.modal-dialog', this).removeClass('animate__animated animate__fadeIn');
        });
    });
      </script>
       <style>
        @media only screen and (max-width: 600px) {
            /* Add your mobile-specific styles here */
            .table th,
            .table td {
                font-size: 14px; /* Adjust the font size for small screens */
            }

            /* Add more styles as needed */
        }

        /* Your existing styles */
        #bonsortieTable {
            border: 2px solid #dee2e6;
        }
        #bonsortieTable {
    border: 2px solid #dee2e6; /* Add a border to the table */
}

</style>    
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
            border-bottom: 2px solid #ddd;

        }

        .table th {
            background-color: #3498db;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
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
.table-container {
            margin: 20px auto; /* Center the table */
        }

        .sidebar-container {
            margin-top: 20px; /* Add space between table and sidebar */
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
        <div class="container">

        <h1>Les Produits</h1>
        <div style="overflow-x: auto; margin-top: 20px;">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importProductModal">Import Products</a>

            
            <a href="{{ route('product.create') }}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">
                <i class="fas fa-plus"></i> Create Product
            </a>
            <div class="table-container">
            <table class="table " id="producttable">
                <tr>
                    <th>Name</th>
                    <th>Reference</th>
                    <th>Label</th>
                    <th>Description</th>
                    
                  
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->reference }}</td>
                        <td>{{ $product->label }}</td>
                        <td>{{ $product->description }}</td>
                    
                        <td>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showProductModal-{{ $product->id }}">
                                <i class="fas fa-eye"></i> Show
                            </a>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}" data-product-id="{{ $product->id }}">Modifier</a>

                            
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal-{{ $product->id }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                        
                </tr>
    
                <!-- Delete Product Modal for each product -->
                <div class="modal fade" id="deleteProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel-{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteProductModalLabel-{{ $product->id }}">Delete Product</h5>
                                <button class="btn btn-danger delete-product" data-bs-toggle="modal" data-bs-target="#deleteProductModal" data-product-id="{{ $product->id }}">
                                    Delete
                                </button>                            </div>
                            <div class="modal-body">
                                <p>Etes-vous sûr(e) de vouloir supprimer ce produit ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary me-md-6" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                </tbody>
            </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
            <!-- Add a space between the table and the To-do list -->
            <div style="margin-top: 20px;"></div>

            <div class="todo">
              <div>
                <h3>List des Produits</h3>
       
              </div>
              <div class="todo-list-container">
                <div id="productChart" style="height: 300px;"></div>
            </div>
            </div>
        </div>
        </div>
         <!-- FOOTER -->
   
    </section>

    <!-- ... your existing code ... -->
 <!-- Bootstrap JS and dependencies -->
 
 <div class="modal fade animate__animated animate__fadeIn" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('product._create')
             </div>
        </div>
    </div>
</div>
@foreach ($products as $product)
    <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel-{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel-{{ $product->id }}">Modifier une Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('product.edit', ['product' => $product]) <!-- Pass the product data to the edit form -->
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="modal fade" id="importProductModal" tabindex="-1" aria-labelledby="importProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importProductsModalLabel">Import Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productFile" class="form-label">Choose file:</label>
                        <input type="file" class="form-control" id="productFile" name="productFile" accept=".csv, .xlsx, .xls">
                    </div>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>


</body>

<script>
    
</script>
</html>


@endsection