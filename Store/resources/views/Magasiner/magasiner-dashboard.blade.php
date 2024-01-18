<!-- resources/views/magasiner-dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Magasiner Dashboard</h1>

        <!-- Display Magasiner-specific content and functionality here -->

        <h2>Bons de Sortie Awaiting Approval</h2>

        <table class="table">
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
                @foreach($bonsSortieAwaitingApproval as $bonSortie)
                    <tr>
                        <td>{{ $bonSortie->date }}</td>
                        <td>{{ $bonSortie->reason }}</td>
                        <td>{{ $bonSortie->user->name }}</td>
                        <td>{{ $bonSortie->status == 0 ? 'Pending' : ($bonSortie->status == 1 ? 'Accepted' : 'Rejected') }}</td>
                        <td>
                            <a href="{{ route('bonsorties.show', $bonSortie->id) }}" class="btn btn-info">View</a>

                            <!-- Display Reject and Accept buttons only for Pending Bons de Sortie -->
                            @if($bonSortie->status == 0)
                                <form action="{{ route('bonsorties.update-status', $bonSortie->id) }}" method="post" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="1"> <!-- 1 for Accept -->
                                    <button type="submit" class="btn btn-success">Accept</button>
                                </form>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal{{ $bonSortie->id }}">Reject</button>

                                <!-- Modal for Reject confirmation -->
                                <div class="modal fade" id="rejectModal{{ $bonSortie->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel">Reject Bon de Sortie</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('bonsorties.update-status', $bonSortie->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="2"> <!-- 2 for Reject -->
                                                    <div class="form-group">
                                                        <label for="magasiner_comments">Comments:</label>
                                                        <textarea name="magasiner_comments" id="magasiner_comments" class="form-control" rows="3" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
