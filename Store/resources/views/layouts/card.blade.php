<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Produits Total</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalProducts }}</h5>
                        <a href="{{ route('product.index') }}" class="btn btn-light">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Clients</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalClients }}</h5>
                        <a href="{{route('clientes.index')}}" class="btn btn-light">
                            <i class="fas fa-eye"></i> Voir

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Employees</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalEmployees }}</h5>
                        <a href="{{route('employee.index')}}" class="btn btn-light">
                            <i class="fas fa-eye"></i> Voir

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total Categories</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalCategories }}</h5>
                        <a href="{{route('category.index')}}" class="btn btn-light">
                            <i class="fas fa-eye"></i> Voir

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Facture Devents</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalFactureDevents }}</h5>

                        <a href="{{route('facturedevents.index')}}" class="btn btn-light">
                            <i class="fas fa-eye"></i> Voir

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalUser }}</h5>
                        <a href="{{route('users.index')}}"class="btn btn-light">
                            <i class="fas fa-eye"></i> Voir

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>