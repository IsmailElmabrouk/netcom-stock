<h1>Import Products</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('product.import.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="file">Choose file:</label>
        <input type="file" name="file" id="file" accept=".xlsx, .csv" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>
