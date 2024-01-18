@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NETCOM NETCOM NETCOM S.A - Bon de Sortie {{ $bonSortie->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    
        table {
            border-collapse: collapse;
            width: 100%;
        }
    
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    
        th {
            background-color: #f2f2f2;
        }
    
        caption {
            text-align: center;
            border: 1px solid #dddddd;
            padding: 8px;
        }
    
        @media print {
            body * {
                visibility: visible !important;
            }
    
            #printable-content * {
                visibility: visible !important;
            }
    
            #printable-content {
                display: block !important;
            }
    
            #printButton {
                display: none;
            }
    
            .hide-on-print {
                display: none;
            }
    
            .print-signature {
                display: block !important;
                margin-top: 20px;
            }
        }
    
        img, svg {
            vertical-align: middle;
            margin-left: 1176px;
            margin-top: -32px;
        }
        .additional-info {
                margin-left: 16px; /* Adjust the margin-left as needed */
                padding: 16px; /* Adjust as needed */
            }
    
        h2 span {
            background: #fff;
            padding: 0;
            position: relative;
            z-index: 1;
        }
    
        h2 span.net {
            color: #B9CC22;
        }
    
        h2 span.com {
            color: #5FB8B1;
        }
    
        .header-line {
            border-bottom: 2px solid #B9CC22;
            margin-top: 10px;
        }
    
        .footer {
            position: fixed;
            bottom: 0px;
            left: 250px;
            width: 100%;
            background-color: #A4D063;
            padding: 10px 0;
        }
    
        .footer a {
            color: #fff;
        }
        @media screen and (max-width: 768px) {
            /* Add responsive styles for smaller screens */
            .additional-info {
                margin-left: 0; /* Adjust as needed */
                padding: 16px; /* Adjust as needed */
            }

            img, svg {
                margin-left: 0;
                margin-top: 0;
            }
        }
    </style>
    
</head>

<body>
    <div class="container" id="printable-content">
        @if($bonSortie->status == 1) <!-- Check if the Bon de Sortie is accepted -->
            <h2>BonSortie: {{ $bonSortie->id }}</h2>
        @else
            <h2>BonSortie Details: {{ $bonSortie->id }}</h2>
        @endif

        <p>Date: {{ isset($currentDate) ? $currentDate : now()->toDateString() }}</p>
        
        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display notifications -->
        @foreach(Auth::user()->notifications as $notification)
            @if(isset($notification->data['bonSortieId']) && $notification->data['bonSortieId'] == optional($bonSortie)->id)
                <div class="alert alert-info">
                    Your Bon de Sortie with ID {{ $notification->data['bonSortieId'] }} has been {{ $notification->data['status'] }}.
                </div>
            @endif
        @endforeach
    
        <!-- Bon de Sortie details -->
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: center; font-weight: bold;">{{ $bonSortie->status == 1 ? 'Les Produit' : 'BonSortie' }}</th>
                    </tr>

                    <tr>
                        <th>Product</th>
                        <th>Unit</th>
                        <th>Quantity</th>
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

            <h3>Details:</h3>
            <table class="table">
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
                        <td><strong>Username:</strong></td>
                        <td>{{ $bonSortie->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>{{ $bonSortie->status == 0 ? 'Pending' : ($bonSortie->status == 1 ? 'Accepted' : 'Rejected')}}</td>
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
           
            @if($bonSortie->status == 1) <!-- Check if the Bon de Sortie is accepted -->
                <a href="{{ route('bonsorties.print', ['id' => $bonSortie->id, 'date' => now()]) }}" id="printButton" onclick="printBonSortie();"  class="btn btn-success" >Print</a>
            @endif

            <a href="{{ route('bonsorties.index') }}" class="btn btn-primary">Back to List</a>
         
        </div>
        
    </div>
    <div class="additional-info">
        <p>&nbsp;</p> <!-- Empty paragraph for space -->
        <p class="print-signature">Signature: ___________________________</p>
    </div>
    <!-- JavaScript to close alerts after a certain period -->
    <!-- Add the following script just before the closing </body> tag -->
    <!-- Add the following script just before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle print
            function printBonSortie() {
                // Open a new window for printing
                var printWindow = window.open("{{ route('bonsorties.print', ['id' => $bonSortie->id, 'date' => now()]) }}", "_blank");
    
                // When the window is fully loaded, trigger the print
                printWindow.onload = function() {
                    printWindow.print();
                    printWindow.onafterprint = function() {
                        // Hide the "Print" button after printing
                        $('#printButton').hide();
                        printWindow.close();
                    };
                };
            }
    
            // Attach click event to the print button
            $('#printButton').on('click', function(e) {
                e.preventDefault();
    
                // Disable the button to prevent multiple clicks
                $(this).prop('disabled', true);
    
                // Call the print function
                printBonSortie();
            });
    
            // Check if the Bon de Sortie is already printed and hide the button
            if ({{ $bonSortie->is_printed ? 'true' : 'false' }}) {
                $('#printButton').hide();
            }
    
            // Timeout to hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').hide();
            }, 5000);
        });
    </script>
    

</body>

</html>
@endsection

