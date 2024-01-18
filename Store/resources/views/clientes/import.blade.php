<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Products</title>
</head>
<body>
    <h1>Import Clients</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('clientes.import.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx, .csv">
        <button type="submit">Import</button>
    </form>
</body>
</html>
