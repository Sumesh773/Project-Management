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

        .container-task {
            display: flex;
            justify-content: space-between;
            margin: 20px;
        }

        .category {
            background-color: #111827;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 30%;
            overflow: auto;
        }

        .head {
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            /* padding: 0px 30px; */
        }


        .head-2{
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* padding: 0px 30px; */
            overflow: auto;
            scrollbar-width: 10px;
            scrollbar-color: transparent transparent;
            /* For Firefox */
        }

        /* Style the chat box scrollbar handle for WebKit browsers */
        .head-2::-webkit-scrollbar {
            width: 5px;
        }

        /* Initially hide the chat box scrollbar handle and track */
        .head-2::-webkit-scrollbar-thumb,
        .head-2::-webkit-scrollbar-track {
            background-color: transparent;
        }

        /* Show the chat box scrollbar handle and track during scrolling */
        .head-2:scroll::-webkit-scrollbar-thumb,
        .head-2:scroll::-webkit-scrollbar-track {
            background-color: #3498db;
            /* Change to your desired color */
        }

        h2 {
            color: #ffffff;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 8px;
            background-color: #f8f8f8;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .confirmation-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(to right, rgb(20, 30, 48), rgb(36, 59, 85));
            box-shadow: rgb(0, 0, 0, 0.7) 5px 10px 50px, rgb(0, 0, 0, 0.7) -5px 0px 250px;
            transition: all 10s ease-in-out;
            padding: 40px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .confirm-btn,
        .cancel-btn {
            margin: 10px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .confirm-btn {
            background: none;
            color: #fff;
            border: 2px solid rgb(255, 2, 2);
            border-radius: 2px;
            font-size: 22px;
            padding: 5px 34px;
            color: rgb(255, 2, 2);
            transition: all 0.3s ease-in-out;
        }

        .confirm-btn:hover {
            background: rgb(255, 2, 2);
            color: #fff;
        }



        .cancel-btn {
            background: none;
            color: rgb(17, 206, 253);
            border: 2px solid rgb(17, 206, 253);
            padding: 5px 40px;
            border-radius: 2px;
            font-size: 22px;
            transition: all 0.3s ease-in-out;
        }

        .cancel-btn:hover {
            background: rgb(17, 206, 253);
            color: #fff;
        }

        .sure-text {
            font-size: 25px;
            color: #ffffff;
            font-weight: 600;
        }

        .color{
            background: rgb(118, 165, 56);
        }

        /*
                                            th ,td{
                                                width: 30px;
                                            } */
    </style>
    <div class=" container-fluid head-box">
        <h1>Task List</h1>
    </div>
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show container" role="alert">

            <h3 style="text-align: center;">{{ Session::get('success') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif
    <div class="head">
        <div class="category">
            <h2>In Progress</h2>
        </div>
        <div class="category">
            <h2>Review</h2>
        </div>
        <div class="category">
            <h2>Completed</h2>
        </div>
    </div>
    <div class="  head-2 ">




    <div class=" container-fluid head my-2">
        <div class="category color">
            <ul>   
                    @if (isset($tasks))
                @foreach ($tasks as $task)
                    @if ($task->status === 'In Progress')
                    <li>
                            <h5 class="cookieHeading"><span style="font-size:12px; font-weight:400;">Task Name:</span><br>{{ $task->name }}</h5>
                            <a class="btn btn-primary link" href="{{ route('view.comment', $task->id) }}">View Task Detail</a>
                        </li>
                    @endif
                @endforeach
                @if ($tasks->where('status', 'In Progress')->count() === 0)
                <li>
                        <h5 style="text-align: center;"> There is no task In Progress.</h5>
                    </li>
                @endif
                @else
                <li>
                    <h5 style="text-align: center;"> There is no task for Progress. </h5>
                </li>
                @endif
            
             

                <!-- Add more tasks as needed -->
            </ul>
        </div>

        <div class="category color">
            <ul>   
                @if (isset($tasks))
            @foreach ($tasks as $task)
                @if ($task->status === 'Review')
                <li>
                        <h5 class="cookieHeading"><span style="font-size:12px; font-weight:400;">Task Name:</span><br>{{ $task->name }}</h5>
                        <a class="btn btn-primary link" href="{{ route('view.comment', $task->id) }}">View Task Detail</a>
                    </li>
                @endif
            @endforeach
            @if ($tasks->where('status', 'Review')->count() === 0)
            <li>
                    <h5 style="text-align: center;"> There is no task for Review.</h5>
                </li>
            @endif
            @else
            <li>
                <h5 style="text-align: center;"> There is no task for Review. </h5>
            </li>
            @endif
        
            <!-- Add more tasks as needed -->
        </ul>
        </div>

        <div class="category color" >
            <ul>
                <ul>   
                    @if (isset($tasks))
                @foreach ($tasks as $task)
                    @if ($task->status === 'Completed')
                    <li>
                            <p class="cookieHeading"><span style="font-size:12px; font-weight:400;">Task Name:</span><br>{{ $task->name }}</p>
                            <a class="btn btn-primary link" href="{{ route('view.comment', $task->id) }}">View Task Detail</a>
                        </li>
                    @endif
                @endforeach
                @if ($tasks->where('status', 'Completed')->count() === 0)
                <li>
                        <h5 style="text-align: center;">There is no Completed task.</h5>
                    </li>
                @endif
                @else
                <li>
                    <h5 style="text-align: center;"> There is no Completed task. </h5>
                </li>
                @endif
            
             

                <!-- Add more tasks as needed -->
            </ul>
        </div>
    </div>
    </div>

    <script>
        function showDeleteConfirmation() {
            var confirmationPopup = document.getElementById("deleteConfirmation");
            confirmationPopup.style.display = "block";
        }

        function closeDeleteConfirmation() {
            var confirmationPopup = document.getElementById("deleteConfirmation");
            confirmationPopup.style.display = "none";
        }

        function confirmDelete() {
            // Perform the delete operation here.
            // Example: document.getElementById("deleteForm").submit(); 
            // Then close the confirmation popup.
            closeDeleteConfirmation();
        }
        // 
    </script>
@endsection
