<!-- resources/views/facturedevents/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Créer une facture de vente</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('facturedevents.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="total_amount">Total Amount</label>
                                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="{{ old('total_amount') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select class="form-control" id="product_id" name="product_id" required>
                                    @foreach (\App\Models\Product::pluck('name', 'id') as $productId => $productName)
                                        <option value="{{ $productId }}" {{ old('product_id') == $productId ? 'selected' : '' }}>{{ $productName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="client_id">Client</label>
                                <select class="form-control" id="client_id" name="client_id" required>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ old('payment_method') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status_payment">Status Payment</label>
                                <input type="text" class="form-control" id="status_payment" name="status_payment" value="{{ old('status_payment') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="remiss_applique">Remiss Applique</label>
                                <select class="form-control" id="remiss_applique" name="remiss_applique" required>
                                    <option value="1" {{ old('remiss_applique') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('remiss_applique') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="magasiner_id">Magasiner</label>
                                <select class="form-control" id="magasiner_id" name="magasiner_id" required>
                                    @foreach ($magasins as $magasin)
                                        <option value="{{ $magasin->id }}">{{ $magasin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <!-- Add other form fields as needed -->
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
