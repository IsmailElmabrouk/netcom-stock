<!-- resources/views/bonsorties/create.blade.php -->
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-ez13kXFfvNLyzV2DOxAdXa6H5snqFqPYGFouGm8WHrNl7I8Wnikx9A9Fmk2dPwM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        integrity="sha384-rbs5qMkF+tc+V4zQ9MZ50pLLe6SezvYUqbg6zDfswH1IsfFVqIC5lr3HOIrJXfOg" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .modal-body .checkbox-group {
            max-height: 300px;
            overflow-y: auto;
        }

        .modal-body .form-check {
            margin-bottom: 10px;
        }

        .modal-footer {
            justify-content: space-between;
        }

        #addSelectedProducts {
            background-color: #007bff;
            color: #fff;
        }

        .custom-icon {
            margin-right: 5px;
        }

        @media only screen and (max-width: 600px) {
            .container {
                margin-top: 0;
                border-radius: 0;
            }
        }
    </style>

    <title>Create Bon de Sortie</title>
</head>

<body>
    <div class="container">
        <h1>Create Bon de Sortie</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('bonsorties.store') }}">
            @csrf
            <div class="form-group">
                <label for="stock_id">Stock</label>
                <select name="stock_id" id="stock_id" class="form-control">
                    @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" id="client_id" class="form-control">
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="products">Products</label>
                <button type="button" class="btn btn-primary" id="openProductModal">
                    <span class="custom-icon">🛒</span> Select Products
                </button>
                <div id="selectedProducts"></div>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="reason">Motif</label>
                <textarea name="reason" id="reason" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <!-- Product Modal -->
    <div class="modal" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Select Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="checkbox-group">
                        @foreach($products as $product)
                        <div class="form-check">
                            <input type="checkbox" name="selectedProducts[]" value="{{ $product->id }}"
                                class="form-check-input">
                            <label class="form-check-label">{{ $product->name }}</label>
                            <input type="number" name="productQuantities[]" value="1" min="1" class="form-control"
                                style="width: 60px; display: inline-block;">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addSelectedProducts">
                        <span class="custom-icon">➕</span> Add
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rbs5qMkF+tc+V4zQ9MZ50pLLe6SezvYUqbg6zDfswH1IsfFVqIC5lr3HOIrJXfOg"
        crossorigin="anonymous"></script>

   <!-- ... Your existing HTML code ... -->

<script>
    $(document).ready(function () {
        $('#openProductModal').click(function () {
            var productModal = new bootstrap.Modal(document.getElementById('productModal'));
            productModal.show();
        });

        $('#addSelectedProducts').click(function () {
            const selectedProducts = [];
            const selectedProductsContainer = $('#selectedProducts');

            // Clear the container before adding new products
            selectedProductsContainer.empty();

            $('input[name="selectedProducts[]"]:checked').each(function () {
                const productId = $(this).val();
                const quantity = $(this).closest('.form-check').find('input[name="productQuantities[]"]').val();
                const productName = $(this).closest('.form-check').find('.form-check-label').text();

                selectedProducts.push({ id: productId, quantity: quantity, name: productName });

                // Display the selected product name in the container
                selectedProductsContainer.append(`<div>${productName} (${quantity} Quantité)</div>`);

                // Create hidden input fields to store selected product IDs and quantities
                selectedProductsContainer.append(`<input type="hidden" name="products[${productId}][id]" value="${productId}">`);
                selectedProductsContainer.append(`<input type="hidden" name="products[${productId}][quantity]" value="${quantity}">`);
            });

            var productModal = new bootstrap.Modal(document.getElementById('productModal'));
            productModal.hide();
        });

        // Function to dynamically update the display of selected products
        function updateSelectedProducts() {
            const selectedProducts = [];
            const selectedProductsContainer = $('#selectedProducts');

            // Clear the container before updating the display
            selectedProductsContainer.empty();

            $('input[name="selectedProducts[]"]:checked').each(function () {
                const productId = $(this).val();
                const quantity = $(this).closest('.form-check').find('input[name="productQuantities[]"]').val();
                const productName = $(this).closest('.form-check').find('.form-check-label').text();

                selectedProducts.push({ id: productId, quantity: quantity, name: productName });

                // Display the selected product name in the container
                selectedProductsContainer.append(`<div>${productName} (${quantity} Quantité)</div>`);

                // Create hidden input fields to store selected product IDs and quantities
                selectedProductsContainer.append(`<input type="hidden" name="products[${productId}][id]" value="${productId}">`);
                selectedProductsContainer.append(`<input type="hidden" name="products[${productId}][quantity]" value="${quantity}">`);
            });
        }

        // Attach the updateSelectedProducts function to the change event of checkboxes
        $('input[name="selectedProducts[]"]').change(updateSelectedProducts);
    });
</script>

<!-- ... Your existing HTML code ... -->

</body>

</html>
 