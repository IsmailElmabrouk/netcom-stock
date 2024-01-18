@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
        <style>
             body {
                font-size: 16px;
            }

            .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: 2.5rem;
                padding-left: 1.5rem;
            }

            .custom-logout-link {
                color: #3633ff !important;
                transition: color 0.3s;
                margin-left: auto;
            }

            .custom-logout-link:hover {
                color: #d9534f !important;
                background-color: #fff;
                border-radius: 5px;
                transition: color 0.3s, background-color 0.3s;
            }

            @media (max-width: 768px) {
                .navbar-expand-lg .navbar-nav .nav-link {
                    padding-left: 0.5rem;
                }

                .custom-logout-link {
                    margin-left: 0;
                }
            }

            @media (max-width: 576px) {
                .navbar-expand-lg .navbar-nav .nav-link {
                    padding-right: 0.5rem;
                    padding-left: 0.5rem;
                }

                body {
                    font-size: 14px;
                }
            }

            /* Responsive table styles */
            @media (max-width: 767px) {
                .table-responsive {
                    display: block;
                    width: 100%;
                    overflow-x: auto;
                }
            }
        </style>
    </head>
    <body>
    <div class="container">
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
        <table class="table" id="bonsortiesTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Justification</th> <!-- New column for justification -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $bonSortie)
                    <tr>
                        <td>{{ $bonSortie->date }}</td>
                        <td>{{ $bonSortie->reason }}</td>
                        <td>{{ $bonSortie->user->name }}</td>
                        <td>{{ $bonSortie->status == 0 ? 'Pending' : ($bonSortie->status == 1 ? 'Accepted' : 'Rejected') }}</td>
                        <td>
                            @if($bonSortie->status == 2) <!-- Only display justification for rejected Bons de Sortie -->
                                {{ $bonSortie->reject_justification }}
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-info" onclick="openViewModal('{{ $bonSortie->id }}')">View</button>

                            <!-- Display Verifier button only for Pending Bons de Sortie -->
                            @if($bonSortie->status == 0 && !$bonSortie->verifiedByCommercial)
                                <form action="{{ route('bonsorties.verify', $bonSortie->id) }}" method="post" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Verifier</button>
                                </form>
                            @endif

                            <!-- Display Edit button for Rejected Bons de Sortie -->
                            @if($bonSortie->status == 2)
    <button type="button" class="btn btn-warning" onclick="openEditModal('{{ $bonSortie->id }}')">Edit</button>
@endif


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
 
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Bon de Sortie Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display Bon de Sortie details here -->
                    <div id="bonSortieDetails"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Bon de Sortie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            

        </div>
    </div>
</div>
    <script>
        function openViewModal(bonSortieId) {
            $.ajax({
                url: '/bonsorties/' + bonSortieId,
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('#bonSortieDetails').html(data);
                    $('#viewModal').modal('show');
                },
                error: function () {
                    alert('Error fetching Bon de Sortie details.');
                }
            });
        }
    </script>
    <script>
    function openEditModal(bonSortieId) {
        $.ajax({
            url: '/bonsorties/' + bonSortieId + '/edit',
            type: 'GET',
            dataType: 'html',
            success: function (data) {
                $('#editBonSortieForm').html(data);
                $('#editModal').modal('show');
            },
            error: function () {
                alert('Error fetching Bon de Sortie details for editing.');
            }
        });
    }
</script>
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
