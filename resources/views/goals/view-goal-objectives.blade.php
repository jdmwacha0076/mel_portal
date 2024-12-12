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
                        <h5 class="mb-1" style="text-align: center;">Objective Details for Goal: {{ $goal->goal_name }}</h5>
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

                    <button class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#addObjectiveModal">
                        Add New Objective
                    </button>

                    <div class="table-responsive">
                    @if($goal->objectives->isEmpty())
                    <p>No objectives available for this goal.</p>
                    @else
                    <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-success">
                                <th>No:</th>
                                <th>Objective</th>
                                <th>Description</th>
                                <th>Creator</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($goal->objectives as $index => $objective)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $objective->objective_name }}</td>
                                <td>{{ $objective->objective_description }}</td>
                                <td>{{ $objective->objectiveCreator->name }}</td>
                                <td>{{ $objective->created_at->format('d-m-Y') }}</td>
                                <td>{{ $objective->updated_at->format('d-m-Y') }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editObjectiveModal{{ $objective->id }}">Edit</button>
                                </td>
                                <td>    
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteObjectiveModal{{ $objective->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                        
                    <div class="d-flex justify-content-left mb-3">
                        <a href="{{ url('/view-goals') }}" class="btn btn-success btn-sm"> Back to Goals</a>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Objective Modal -->
@foreach($goal->objectives as $objective)
<div class="modal fade" id="editObjectiveModal{{ $objective->id }}" tabindex="-1" role="dialog" aria-labelledby="editObjectiveModalLabel{{ $objective->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editObjectiveModalLabel{{ $objective->id }}">Edit Objective: {{ $objective->objective_name }}</h5>
            </div>
            <form action="{{ route('goal.objective.update', $objective->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="objective_name{{ $objective->id }}">1. Objective Name</label>
                        <input type="text" class="form-control" id="objective_name{{ $objective->id }}" name="objective_name" value="{{ $objective->objective_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="objective_description{{ $objective->id }}">2. Description</label>
                        <textarea class="form-control" id="objective_description{{ $objective->id }}" name="objective_description" required>{{ $objective->objective_description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Objective Modal -->
@foreach($goal->objectives as $objective)
<div class="modal fade" id="deleteObjectiveModal{{ $objective->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteObjectiveModalLabel{{ $objective->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteObjectiveModalLabel{{ $objective->id }}">Delete Objective: {{ $objective->objective_name }}</h5>
            </div>
            <form action="{{ route('goal.objective.delete', $objective->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete the objective <strong>{{ $objective->objective_name }}</strong>? This action cannot be undone.</p>
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

<!-- Add New Objective Modal -->
<div class="modal fade" id="addObjectiveModal" tabindex="-1" role="dialog" aria-labelledby="addObjectiveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addObjectiveModalLabel">Add New Objective</h5>
            </div>
            <form action="{{ route('objective.add.more', $goal->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="objective_name">Objective Name</label>
                        <input type="text" class="form-control" id="objective_name" name="objective_name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="objective_description" ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Add Objective</button>
                </div>
            </form>
        </div>
    </div>
</div>





@include('components.footer')






