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
            margin-bottom: 100px;
        }

        .card {
            width: 250px;
            height: 350px;
            background: #111827;
            position: relative;
            display: flex;
            place-content: center;
            place-items: center;
            overflow: hidden;
            border-radius: 20px;
            font-weight: 600;
        }

        .card a {
            z-index: 1;
            color: white;
            font-size: 25px;
            text-decoration: none;
        }

        .card::before {
            content: '';
            position: absolute;
            width: 100px;
            background-image: linear-gradient(180deg, rgb(0, 183, 255), rgb(255, 48, 255));
            height: 130%;
            animation: rotBGimg 3s linear infinite;
            transition: all 0.2s linear;
        }

        @keyframes rotBGimg {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .card::after {
            content: '';
            position: absolute;
            background: #111827;
            ;
            inset: 5px;
            border-radius: 15px;
        }

        .box {
            margin: auto;
        }

        /* .card:hover:before {
              background-image: linear-gradient(180deg, rgb(81, 255, 0), purple);
              animation: rotBGimg 3.5s linear infinite;
            } */
    </style>
    <div class="head-box ">
        <h1>Project Management</h1>
    </div>
    <div class="container-fluid overflow-y-auto">
        <div class="col-md-8 d-flex justify-content-around box">
            <div class="card">
                <a href="{{ route('admin.dasboard') }}">Project</a>
            </div>
            <div class="card">
                <a href="">Task</a>
            </div>
            <div class="card">
                <a href="{{route('view.categories')}}">Categories</a>
            </div>

        </div>
        
    </div>
@endsection
