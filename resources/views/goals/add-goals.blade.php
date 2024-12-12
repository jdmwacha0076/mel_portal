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
                        <h5 class="mb-1 text-center">Create Goal</h5>
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
                        <a href="{{ url('/view-goals') }}" class="btn btn-primary btn-sm"> View Goals</a>
                    </div>

                    <form action="{{ route('goals.save') }}" method="POST" onsubmit="disableButton('add-goal')">
                        @csrf
                        <div class="form-group">
                            <label for="goal_name" class="font-weight-bold">1. Goal name</label>
                            <input type="text" class="form-control" id="goal_name" name="goal_name" value="{{ old('goal_name') }}">
                            @error('goal_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="goal_description" class="font-weight-bold">2. Goal description</label>
                            <textarea class="form-control" id="goal_description" name="goal_description" rows="3">{{ old('goal_description') }}</textarea>
                            @error('goal_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-sm" id="add-goal">Save Goal</button>
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

@include('components.footer')