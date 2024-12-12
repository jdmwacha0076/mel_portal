<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring and Evaluation Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

@include('components.navbar')

<div class="clearfix">
    <div class="content">
        <div class="animated fadeIn">
            <div class="card mb-4" style="margin-bottom: -30px !important;">

                <div class="cardheader">
                    <div class="card-header">
                        <h5 class="mb-1" style="text-align: center;">View Goals</h5>
                    </div>
                </div>

                <div class="panel-body" style="padding: 10px;">

                    <div>
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-success">
                                    <th>No:</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Goal name</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Description</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Created by</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Created</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Updated</th>
                                    <th>Edit</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($goals as $index => $goal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $goal->goal_name }}</td>
                                    <td>{{ $goal->goal_description }}</td>
                                    <td>{{ $goal->goalCreator->name ?? 'N/A' }}</td>
                                    <td>{{ $goal->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $goal->updated_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('view.goal.objectives', $goal->id) }}" class="btn btn-primary btn-sm">
                                            View
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editGoalModal{{ $goal->id }}">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGoalModal{{ $goal->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing goal -->
@foreach($goals as $goal)
<div class="modal fade" id="editGoalModal{{ $goal->id }}" tabindex="-1" role="dialog" aria-labelledby="editGoalModalLabel{{ $goal->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGoalModalLabel{{ $goal->id }}">Edit Goal: {{ $goal->goal_name }}</h5>
            </div>
            <form action="{{ route('goals.update', $goal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="goal_name{{ $goal->id }}">1.Goal Name</label>
                        <input type="text" class="form-control" id="goal_name{{ $goal->id }}" name="goal_name" value="{{ $goal->goal_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="goal_description{{ $goal->id }}">2. Description</label>
                        <textarea class="form-control" id="goal_description{{ $goal->id }}" name="goal_description" rows="4" required>{{ $goal->goal_description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update Goal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<!-- Modal for deleting goal -->
@foreach($goals as $goal)
<div class="modal fade" id="deleteGoalModal{{ $goal->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteGoalModalLabel{{ $goal->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGoalModalLabel{{ $goal->id }}">Delete Goal: {{ $goal->goal_name }}</h5>
            </div>
            <form action="{{ route('goals.delete', $goal->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete the goal <strong>{{ $goal->goal_name }}</strong> and all its objectives? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@include('components.footer')