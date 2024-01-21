@extends('admin.layout.dashboard')

@section('content')
<style>
    .head-box {
        width: 100%;
        height: 100px;
        background: #111827;
        border-radius: 32px 32px 0px 0px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    form{
    color: #111827;
    font-weight: 600;
    }

    </style>
     <div class="head-box">
        <h1>Create Task</h1>
    </div>
    <div class="container-fluid overflow-y-auto">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show container" role="alert">
   
                <h3 style="text-align: center;">{{ Session::get('success') }}</h3>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    @endif
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <form action="{{route('update.task', $task->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label"> Task Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$task->name}}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name" name="project_id" value="{{$task->project->name}}" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Assign To</label>
                <input type="hidden" class="form-control" id="name" name="project_id" value="{{$task->user->id}} ">
                <input type="text" class="form-control" id="name" value="{{$task->user->name}}" readonly onclick="showMessage()">
                {{-- <input type="text" class="form-control" id="name" name="project_id" value="{{$projects->first()->id}}" readonly> --}}
                {{-- <select id="name" class="form-select" aria-label="Default select example" name="user_id" readonly>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $task->user_id ? 'selected' : '' }}>
                        {{ $user->user->name }}
                    @endforeach
                </select> --}}
                 
            </div>

            <div class="row g-3">
                <div class="col">
                    <label for="start_date" class="form-label">Project Start Date</label>
                    <input type="datetime-local" id="start_date" class="form-control" placeholder="" min="<?php echo date('Y-m-d'); ?>" name="started_at" value="{{$task->started_at}}">
                </div>
                <div class="col">
                    <label for="end_date" class="form-label">Project End Date</label>
                    <input type="datetime-local" id="end_date" class="form-control" placeholder="" min="<?php echo date('Y-m-d'); ?>" name="end_at" value="{{$task->end_at}}">
                </div>
            </div>

            <div class="mb-3 my-3">
                <label for="name" class="form-label">Status</label>
                <select id="name" class="form-select" aria-label="Default select example" name="status">
                    <option value="In Progress" @if ($task->status == 'In Progress') selected @endif>In Progress</option>
                    <option value="Review" @if ($task->status == 'Review') selected @endif>Review</option>
                    <option value="Completed" @if ($task->status == 'Completed') selected @endif>Completed</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$task->description}}</textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="text">Submit</button>
            </div>
        </form>
    </div>
    <script>
        const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    // Add an event listener to the "Started Date" input field
    startDateInput.addEventListener('input', () => {
        const startDate = new Date(startDateInput.value);
        
        // Set the minimum date for the "Completed Date" input field
        endDateInput.min = startDateInput.value;
    });

    function showMessage() {
        alert("You cannot change the assigned employee.");
    }
    </script>
@endsection