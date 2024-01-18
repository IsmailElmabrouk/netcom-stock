@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name', 'Netcom') }} 
	
    </title>
 <style>
		/* Custom styles for sidebar icons */
    

		/* Custom styles for the card section */
         
        /* Custom styles for the animated icon */
        .animated-icon {
            animation: rotate 2s infinite linear;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #graph-section {
            margin-top: 50px;
        }

        .graph-container {
            text-align: center;
        }
        .even-row {
    background-color: rgba(255, 255, 255, 0.8); /* Adjust the alpha value for transparency */
}

.odd-row {
    background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha value for transparency */
}
.todo-list-container {
    max-height: 300px; /* Adjust the maximum height as needed */
    overflow-y: auto;
}

.todo-list-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px; /* Adjust the margin as needed */
}

.todo-list-table th, .todo-list-table td {
    border: 1px solid #ddd; /* Add border styling as needed */
    padding: 8px;
    text-align: left;
}

.todo-list-table th {
    background-color: #f2f2f2; /* Add header background color as needed */
}

/*-----*/

		/* Add more styles as needed */
	</style>
</head>

<body>

    @include('layouts.sidebar')
	<!-- SIDEBAR -->
    <nav>
  
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
       
    </nav>
	<!-- CONTENT -->
    <section id="content">
        <main>
            <div class="container">
                <h1>Magasiner Dashboard</h1>

                <!-- Display Magasiner-specific content and functionality here -->

                <h2>Bons de Sortie en Attente d'Approbation</h2>

                <table class="table" id="bonsortieTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Reason</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($magasinerBonSorties as $bonSortie)
                            <tr>
                                <td>{{ $bonSortie->date }}</td>
                                <td>{{ $bonSortie->reason }}</td>
                                <td>{{ $bonSortie->user->name }}</td>
                                <td id="status_{{ $bonSortie->id }}">
            @if($bonSortie->status == 1)
                <button id="sortieButton_{{ $bonSortie->id }}" type="button" class="btn btn-success" onclick="confirmSortie('{{ $bonSortie->id }}')">Sortie</button>
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-info" onclick="openViewModal('{{ $bonSortie->id }}')">View</button>
            <!-- Display Sortie button only for Pending Bons de Sortie -->
            @if($bonSortie->status == 0)
                <button id="sortieButton_{{ $bonSortie->id }}" type="button" class="btn btn-success" onclick="confirmSortie('{{ $bonSortie->id }}')">Sortie</button>
            @endif
        </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
        aria-hidden="true">
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

<!-- CONTENT -->
<!-- ... Existing code ... -->

<!-- ANOTHER SECTION -->


<!-- ... Existing code ... -->
 

<!-- Add your custom scripts if any -->

 

 <script>
    function openRejectModal(bonSortieId) {
        var modalId = 'rejectModal' + bonSortieId;
        $('#' + modalId).modal('show');
    }

    // Cette fonction doit être appelée au chargement de la page
function hideClickedButtons() {
    // Itérer sur les boutons et les cacher s'ils ont déjà été cliqués
    $('[id^="sortieButton_"]').each(function() {
        var bonSortieId = this.id.split('_')[1];
        if (localStorage.getItem('sortieButtonClicked_' + bonSortieId)) {
            $(this).remove();
        }
    });
}

// Appel de la fonction au chargement de la page
$(document).ready(function() {
    hideClickedButtons();
});

function confirmSortie(bonSortieId) {
    // Check if the button has already been clicked
    var sortieButton = $('#sortieButton_' + bonSortieId);
    if (localStorage.getItem('sortieButtonClicked_' + bonSortieId)) {
        alert('Sortie button already clicked for Bon de Sortie ID: ' + bonSortieId);
        return;
    }

    // Disable the button after a click to prevent multiple clicks
    sortieButton.prop('disabled', true);

    // Adjust the URL based on your routes
    var url = '/bonsorties/' + bonSortieId + '/confirm-sortie';

    // Send an Ajax request to the server
    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            // The request was successful, update the UI or perform other necessary actions
            alert('Sortie confirmed for Bon de Sortie ID: ' + bonSortieId);

            // Remove the Sortie button after confirmation
            sortieButton.remove();

            // Save information about the removed button in localStorage
            localStorage.setItem('sortieButtonClicked_' + bonSortieId, true);
        },
        error: function (error) {
            // Enable the button if there is an error, so the user can try again
            sortieButton.prop('disabled', false);

            // Handle the error and display an alert
            alert('Error confirming sortie for Bon de Sortie ID: ' + bonSortieId);
            console.error(error);

            // Display a more detailed error message, if available
            if (error.responseJSON && error.responseJSON.error) {
                alert('Error details: ' + error.responseJSON.error);
            } else {
                alert('No detailed error message available.');
            }
        }
    });
}

</script>

<script>
    $(document).ready(function() {
        $('#bonsortieTable').DataTable({
            "paging": true,  // Enable pagination
            "lengthChange": true,  // Disable items per page changing
            "searching": true,  // Disable search bar
            "ordering": true,  // Enable sorting
            "info": true,  // Display information about the table
            "autoWidth": true,  // Disable auto-width calculation
            "pageLength": 10,  // Number of items per page
        });
        $('#bonsortieTable').addClass('table-bordered');

       
    });

    
</script>
<style>
#bonsortieTable {
border: 2px solid #dee2e6; /* Add a border to the table */
}

</style>
 </body>
</html>
@endsection
