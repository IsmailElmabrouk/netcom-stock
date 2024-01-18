<form action="{{ route('product.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
    </div>
    <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" id="reference" name="reference" value="{{ $product->reference }}">
    </div>
    <div class="form-group">
        <label for="label">Label</label>
        <input type="text" class="form-control" id="label" name="label" value="{{ $product->label }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
    </div>
    <div class="form-group">
        <label for="unit">Unit</label>
        <input type="text" class="form-control" id="unit" name="unit" value="{{ $product->unit }}">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
    </div>
    <input type="hidden" name="category_id" value="{{ $product->category_id }}">
    <input type="hidden" name="stock_id" value="{{ $product->stock_id }}">


    <button type="submit" class="btn btn-primary">Update</button>
</form>
