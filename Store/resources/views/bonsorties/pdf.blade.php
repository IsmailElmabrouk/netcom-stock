<!-- resources/views/bonsorties/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Sortie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .details-table td {
            font-weight: bold;
        }

        .additional-info {
            margin-top: 20px;
        }

        .signature {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bon de Sortie</h1>
        <h2>Bon de Sortie NO: {{ $bonSortie->id }}</h2>
        <p>Date: {{ isset($currentDate) ? $currentDate : now()->toDateString() }}</p>

        <div class="details-table">
            <h2>Products:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Unite</th>
                        <th>Quantite</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bonSortie->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="details-table">
            <h2>Details:</h2>
            <table>
                <tbody>
                    <tr>
                        <td><strong>Date:</strong></td>
                        <td>{{ $bonSortie->date }}</td>
                    </tr>
                    <tr>
                        <td><strong>Reason:</strong></td>
                        <td>{{ $bonSortie->reason }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>{{ $bonSortie->status == 0 ? 'Pending' : 'Accepted' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Instalateur :</strong></td>
                        <td>{{ $bonSortie->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stock:</strong></td>
                        <td>{{ $bonSortie->stock->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Client:</strong></td>
                        <td>{{ optional($bonSortie->client)->name }}</td>
                    </tr>
                    @foreach ($magasinerUsers as $magasinerUser)
            <tr class="magasiner-info hide-on-print">
                <td><strong>Magasiner:</strong></td>
                <td>{{ $magasinerUser->name }}</td>
            </tr>
        @endforeach
                </tbody>
            </table>
        </div>

        <div class="additional-info">
            <p>&nbsp;</p> <!-- Empty paragraph for space -->
            <p class="signature">Signature: ___________________________</p>
        </div>
    </div>
</body>

</html>
