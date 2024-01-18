@extends('layouts.app')

@section('content')
    <div class="product-details">
        <h1>Product Details</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Reference</th>
                    <td>{{ $product->reference }}</td>
                </tr>
                <tr>
                    <th>Label</th>
                    <td>{{ $product->label }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{ $product->quantity }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ $product->price }}</td>
                </tr>
            </tbody>
        </table>

        <div class="actions">
            <!-- Form to update the price -->
            <form action="{{ route('product.updatePrice', $product->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="newPrice">New Price:</label>
                    <input type="number" name="price" id="newPrice" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Price</button>
            </form>

            <!-- Form to replenish the stock -->
            <form action="{{ route('product.replenishStock', $product->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="replenishQuantity">Reconstituer la quantit:</label>
                    <input type="number" name="quantity" id="replenishQuantity" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Replenish Stock</button>
            </form>
        </div>

        <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>
@endsection
