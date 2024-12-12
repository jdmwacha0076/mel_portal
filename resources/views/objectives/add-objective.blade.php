<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring and Evaluation Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@include('components.navbar')

<div class="clearfix">
    <div class="content">
        <div class="animated fadeIn">
            <div class="card mb-4" style="margin-bottom: -30px !important;">

                <div class="cardheader">
                    <div class="card-header">
                        <h5 class="mb-1 text-center">Add Objective</h5>
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

                    <div class="d-flex justify-content-left mb-3">
                        <a href="{{ url('/view-goals') }}" class="btn btn-primary btn-sm"> View goals</a>
                    </div>

                    <form action="{{ route('objective.save') }}" method="POST" onsubmit="disableButton('add-objective')">
                        @csrf

                        <div class="form-group">
                            <label for="goal_id" class="font-weight-bold">1. Select Goal:</label>
                            <select name="goal_id" id="goal_id" class="form-control" required>
                                <option value="">Click here to select a goal</option>
                                @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->goal_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="objectives-container">
                            <div class="objective-item">
                                <div class="form-group">
                                    <label for="objective_name[]" class="font-weight-bold">Objective Name:</label>
                                    <input type="text" name="objective_name[]" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="objective_description[]" class="font-weight-bold">2. Objective Description:</label>
                                    <textarea name="objective_description[]" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary btn-sm" id="add-more">Add Another Objective</button>
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-sm" id="add-objective">Save Objectives</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function disableButton(buttonId) {
        const button = document.getElementById(buttonId);
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    }
</script>

<script>
    document.getElementById('add-more').addEventListener('click', function() {
        const container = document.getElementById('objectives-container');
        const newObjective = document.createElement('div');
        newObjective.classList.add('objective-item');
        newObjective.innerHTML = `
            <hr>
            <div class="form-group">
                <label for="objective_name[]">Objective Name:</label>
                <input type="text" name="objective_name[]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="objective_description[]">Objective Description:</label>
                <textarea name="objective_description[]" class="form-control" rows="2"></textarea>
            </div>
        `;
        container.appendChild(newObjective);
    });
</script>

@include('components.footer')