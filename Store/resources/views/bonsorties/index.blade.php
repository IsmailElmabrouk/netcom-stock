<!-- resources/views/bonsorties/index.blade.php -->

@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF token for AJAX requests -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Add Bootstrap viewport meta tag -->
    <title>Document</title> 
    <!-- Add these links to the head section of your HTML file -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        setTimeout(function () {
            document.querySelectorAll('.alert').forEach(function (alert) {
                alert.style.display = 'none';
            });
        }, 5000); // Adjust the timeout value (in milliseconds) as needed
    </script>
    <script>
        $(document).ready(function() {
            $('#bonsortieTable').DataTable({
                "paging": true,  // Enable pagination
                "lengthChange": true,  // Disable items per page changing
                "searching": true,  // Disable search bar
                "ordering": true,  // Enable sorting
                "info": true,  // Display information about the table
                "autoWidth": false,  // Disable auto-width calculation
                "pageLength": 5,  // Number of items per page
            });
            $('#bonsortieTable').addClass('table-bordered');

        });

        function openRejectModal(bonSortieId) {
            var modalId = 'rejectModal' + bonSortieId;
            $('#' + modalId).modal('show');
        }
    </script>
    <style>
        #bonsortieTable {
            border: 2px solid #dee2e6; /* Add a border to the table */
        }
        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
            margin-left: 76px;
        }
        .dropdown, .dropend, .dropstart, .dropup {
            position: relative;
            margin-left: 77px;
            margin-top: -6px;
        }
        #sidebar {
    position: fixed;
    top: -4px;
    left: -9px;
    width: 263px;
    height: 100%;
    background: var(--light);
    z-index: 2023;
    font-family: var(--lato);
    transition: .3s ease;
    overflow-x: hidden;
    scrollbar-width: none;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
    margin-left: 78px;
}
    </style>
</head>
<body>
    @if(Auth::user()->type === 'admin')
    <!-- Include the sidebar only for admin users -->
    @include('layouts.sidebar')
    @endif
 
    <div class="container">
        <h1>Bons de Sortie</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Display notifications -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i> Notifications <span class="badge badge-light">{{ count($notifications) }}</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                @foreach($notifications as $notification)
                <a class="dropdown-item" href="#">
                Your Bon de Sortie with ID {{ optional($notification->data)['bonSortieId'] }} has been {{ optional($notification->data)['status'] ?? 'N/A' }}.
                </a>
                @endforeach
            </div>
        </div>

        <div class="table-responsive">
            <table class="table"  >
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->reason }}</td>
                        <td>{{ $record->status == 0 ? 'Pending' : ($record->status == 1 ? 'Accepté' : 'Rejeté') }}</td>
                        
                        <!-- resources/views/bonsorties/index.blade.php -->

                        <!-- ... (your existing code) ... -->

                        <!-- Add the Edit button -->
                        <td>
                            <a href="{{ route('bonsorties.show', $record->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('bonsorties.edit', $record->id) }}" class="btn btn-warning">Edit</a>
                        </td>

                        <!-- ... (your existing code) ... -->

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $records->links() }}
        </div>
    </div>
    </div>

    <!-- JavaScript to close alerts after a certain period -->

</body>
</html>
 
@endsection
