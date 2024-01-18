    @extends('layouts.app')

    @section('content')
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
    /* ... Existing styles ... */

    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 2.5rem;
        padding-left: 1.5rem; /* Adjust the left padding for smaller screens */
    }

    .custom-logout-link {
        color: #3633ff !important;
        transition: color 0.3s;
        margin-left: auto; /* Add margin-left auto */
    }

    .custom-logout-link:hover {
        color: #d9534f !important;
        background-color: #fff;
        border-radius: 5px;
        transition: color 0.3s, background-color 0.3s;
    }

    /* Add media queries for responsiveness */
    @media (max-width: 768px) {
        .navbar-expand-lg .navbar-nav .nav-link {
            padding-left: 0.5rem; /* Adjust the left padding for smaller screens */
        }

        .custom-logout-link {
            margin-left: 0; /* Reset margin-left for smaller screens */
        }
    }

    @media (max-width: 576px) {
        .navbar-expand-lg .navbar-nav .nav-link {
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        /* Adjust other styles for smaller screens */
        .animated-text {
            font-size: 18px; /* Decrease font size for smaller screens */
        }
    }

    /* ... Remaining styles ... */
</style>

    </head>
    <body>
        <div class="container">
            <!-- Header with Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-2 ">
                        <li class="nav-item">
                            
                            <a class="nav-link custom-logout-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}<i class="fas fa-sign-out-alt"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Animated Text and Button -->
            <div class="animated-text mt-4">
                <h1 class="display-4  ">Bienvenue sur votre page d'accueil {{ Auth::user()->name }}</h1>
            </div>

            <!-- Display notifications using icons -->
            <!-- Example success alert -->
            @if(session('success'))
                <div id="successAlert" class="alert alert-success mt-4">
                    <i class="fas fa-check"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Display the rejected alert only once -->
            @php
                $rejectedAlertShown = session('rejected_alert_shown', false);
            @endphp

            @if(session('rejected') && !$rejectedAlertShown)
                <div id="rejectedAlert" class="alert alert-danger mt-4">
                    <i class="fas fa-times"></i> Bon de Sortie rejected! Reason: {{ session('rejected_reason') }}
                    <button type="button" class="close" onclick="closeAlert('rejectedAlert')">×</button>
                </div>
            @endif

            <!-- Add a script to close the alert when the close button is clicked -->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Function to close alerts
                    function closeAlert(alertId) {
                        var alert = document.getElementById(alertId);
                        alert.parentNode.removeChild(alert);
                    }

                    // Animated Text and Button
                    var animatedText = document.querySelector('.animated-text');
                    animatedText.style.display = 'block';
                    animatedText.style.animation = 'fadeIn 1.5s ease';

                    // Close success alerts after a certain period
                    setTimeout(function () {
                        closeAlert('successAlert');
                    }, 2000); // Adjust the timeout value (in milliseconds) as needed

                    // Close rejected alerts after a certain period
                    setTimeout(function () {
                        closeAlert('rejectedAlert');
                    }, 2000); // Adjust the timeout value (in milliseconds) as needed
                });
            </script>

            <div class="dropdown mt-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="notificationDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i> Notifications <span
                        class="badge badge-light">{{ count(Auth::user()->unreadNotifications) }}</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                @foreach(Auth::user()->unreadNotifications as $notification)
    @if(isset($notification->data['bonSortieId']))
        <a class="dropdown-item" href="#">
            <i class="fas fa-info-circle"></i> Your Bon de Sortie with ID {{ $notification->data['bonSortieId'] }}
            has been {{ $notification->data['status'] }}.
        </a>
    @endif
@endforeach
                    <div class="dropdown-divider"></div>
                    <a href="#" id="markAllAsRead" class="btn btn-primary">Mark All as Read</a>
                </div>
            </div>

            @if(Auth::user()->bonsorties->isNotEmpty())
                <h2 class="mt-4">Votre bon de sorties</h2>
                <table class="table" id="bonsortiesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Date</th>
        
                            <th>Motif</th>
                            <th>Client</th>
                            <th>Action</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->bonsorties->sortByDesc('created_at') as $bonSortie)
                            <tr>
                                <td>{{ $bonSortie->id }}</td>
                                <td>{{ $bonSortie->status == 0 ? 'Pending' : ($bonSortie->status == 1 ? 'Accepté' : 'Rejeté') }}</td>
                                <td>{{ \Carbon\Carbon::parse($bonSortie->date)->toDateString() }}</td>
                            
                                <td>{{ $bonSortie->reason }}</td>
                                <td>{{ $bonSortie->client->name }}</td>
                                <td>
                                    <a href="{{ route('bonsorties.show', ['bonsorty' => $bonSortie->id]) }}" class="btn btn-primary">View</a>
                                </td>
                                <!-- Add more cells with bon de sortie information as needed -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mt-4">No Bon de Sorties found for this user.</p>
            @endif
            <!-- Button to create Bon de Sortie -->
            <div class="animated-button mt-4">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createBonSortieModal">
                    <i class="fas fa-plus"></i> Create Bon de Sortie
                </button>
            </div>

            <!-- Logout Button -->
        
        </div>
        <div class="modal" id="createBonSortieModal" tabindex="-1" role="dialog" aria-labelledby="createBonSortieModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBonSortieModalLabel">Create Bon de Sortie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Include the content of your create.blade.php here -->
                        @include('bonsorties.create')
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Bootstrap and DataTables scripts to the head section of your HTML file -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                // Initialize DataTable
                $('#bonsortiesTable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "pageLength": 5,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                    }
                });
            });
        </script>
    </body>
    </html>


    @endsection
