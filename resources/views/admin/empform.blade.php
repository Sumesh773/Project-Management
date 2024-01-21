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
    </style>
   
        <div class="head-box">
            <h1>Employees Register Form</h1>
        </div>
        <div class="container-fluid overflow-y-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show container" role="alert">
   
                <h3 style="text-align: center;">{{ Session::get('success') }}</h3>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    @endif
        <form method="POST" action="{{ route('update.employee', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name"
                    value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                    value="{{ $user->email }}">
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="number" aria-describedby="emailHelp" name="phone_no"
                    value="{{ $user->phone_no }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection 
