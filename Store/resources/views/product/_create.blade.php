 
<form action="{{ route('product.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <!-- ... (other form fields) ... -->
    <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" id="reference" name="reference">
    </div>
    <div class="form-group">
        <label for="label">Label</label>
        <input type="text" class="form-control" id="label" name="label">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity">
    </div>
    <div class="form-group">
        <label for="unit">unit</label>
        <input type="text" class="form-control" id="unit" name="unit">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id">
             @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="stock_id">Stock</label>
        <select class="form-control" id="stock_id" name="stock_id">
            @foreach ($stocks as $stock)
                <option value="{{ $stock->id }}">{{ $stock->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
 