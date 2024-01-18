@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="animate-text">Vérifier l'espace de stockage: {{ $stock->name }}</h1>

        <div class="card my-card">
            <div class="card-body">
                <p class="animate-text"><strong>Nom du stock:</strong> {{ $stock->name }}</p>
                <p class="animate-text"><strong>Lieu:</strong> {{ $stock->location }}</p>
                <p class="animate-text"><strong>Capacité:</strong> {{ $stock->capacity }}</p>
                @if ($stock->capacity > 0)
                    @php
                        $utilizationPercentage = ($availableSpace / $stock->capacity) * 100;
                    @endphp
                    <p class="animate-text"><strong>Utilisation de l'espace:</strong> {{ number_format($utilizationPercentage, 2) }}%</p>
                @else
                    <p class="animate-text"><strong>Utilisation de l'espace:</strong> Non applicable</p>
                @endif
                <!-- Add your content here for checking space -->
                <p class="animate-text"><strong>Espace disponible:</strong> {{ $availableSpace }} unités</p>
                <form action="{{ route('stock.manageMovements.post', $stock->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantité à ajouter:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter des articles</button>
                </form>

                <!-- Chart for space utilization -->
                <div id="graph-section" style="width: 900px;" class="graph-container">
                    <h2>Details</h2>
                    <canvas id="myChart" width="700" height="200"></canvas>
                </div>

                <a href="{{ route('stock.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>

    <style>
        /* Add a scale-in animation to the card */
        .my-card {
            transform: scale(0.8);
            animation: scaleIn 0.5s ease-in-out forwards;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .my-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1);
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
            }
            to {
                transform: scale(1);
            }
        }

        /* Add color change animation for text */
        .animate-text {
            color: #3498db; /* Initial color */
            animation: colorChange 1.5s ease-in-out forwards;
        }

        @keyframes colorChange {
            from {
                color: #3498db; /* Initial color */
            }
            to {
                color: rgb(66, 52, 51); /* Target color (change as needed) */
            }
        }
    </style>

    <!-- JavaScript for Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Assuming you have a variable $spaceUtilizationPercentage available in your view
        document.addEventListener("DOMContentLoaded", function () {
            var spaceUtilizationPercentage = {{ $spaceUtilizationPercentage ?? 0 }};

            // Use Chart.js to create a simple bar chart
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Espace utilisé', 'Espace disponible'],
                    datasets: [{
                        label: 'Pourcentage d\'espace utilisé',
                        data: [spaceUtilizationPercentage, 100 - spaceUtilizationPercentage],
                        backgroundColor: ['#FF6384', '#36A2EB'],
                        hoverBackgroundColor: ['#FF6384', '#36A2EB'],
                    }]
                }
            });
        });
    </script>
@endsection
