@extends('Employee.layout.dashboard')

@section('css')
    <style>
        .main-container {
            background-image: url({{ asset('images/background.jpg') }});
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            height: 100%;
        }

        #task-section,
        #chat-section {
            flex: 1;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
            /* border-radius: 10px; */
        }

        #task-section {
            padding: 40px 0px 40px 0px;
        }

        #task-section {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: center;
            /* align-items: center; */
            color: black;
        }

        .detail-box {
            width: 714px;
            padding: 40px;
            background: white;
        }

        #chat-section {
            display: flex;
            flex-direction: column;
        }

        #chat-header {
            background-color: #111827;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            border-radius: 8px 8px 0 0;
        }


        .chat-box {

            overflow: auto;
            padding: 10px;
            color: black;
            font-weight: 600;
            height: 640px;

        }


        /* Apply overflow auto to show scrollbar only when needed */
        /* Hide the default scrollbar */
        .chat-box {
            overflow: auto;
            scrollbar-width: 20px;
            scrollbar-color: transparent transparent;
            /* For Firefox */
        }

        /* Style the chat box scrollbar handle for WebKit browsers */
        .chat-box::-webkit-scrollbar {
            width: 12px;
        }

        /* Initially hide the chat box scrollbar handle and track */
        .chat-box::-webkit-scrollbar-thumb,
        .chat-box::-webkit-scrollbar-track {
            background-color: transparent;
        }

        /* Show the chat box scrollbar handle and track during scrolling */
        .chat-box:scroll::-webkit-scrollbar-thumb,
        .chat-box:scroll::-webkit-scrollbar-track {
            background-color: #3498db;
            /* Change to your desired color */
        }

        .message {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 8px;
            margin-bottom: 8px;
            display: inline-block;
            max-width: 70%;
        }

        .user-message {
            text-align: right;
            background-color: rgba(255, 255, 255, 0.9);
        }

        #task-details {
            line-height: 1.6;
        }

        #message-input-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.8);
        }

        .message-input {
            flex: 1;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            margin-right: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;

        }

        #send-btn {
            padding: 10px;
            background-color: #111827;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .info {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;

        }

        p {
            margin-bottom: 0px;
        }

        .right-box {
            width: 207px;
            text-align: left;
        }


        h4 {
            font-size: 18px;
            color: #007BFF;
            margin: 0;
        }

        h2 {
            font-size: 35px;
            background: #111827;
            color: white;
            padding: 10px 20px;
            margin: 0;
            text-align: center;
            margin-bottom: 30px;
        }


        .description {
            border-top: 1px solid #ccc;
            padding-top: 15px;
            display: flex;
            align-items: center;
        }

        .message-container-1 {
            text-align: left;
            margin-bottom: 10px;
        }

        .left-msg {
            background-color: #111827;
            /* Add your desired background color */
            border-radius: 8px;
            padding: 8px;
            display: inline-block;
            max-width: 70%;
            color: white;
        }

        .message-container-2 {
            text-align: right;
            margin-bottom: 10px;

        }

        .right-msg {
            background-color: #111827;
            /* Add your desired background color */
            border-radius: 8px;
            padding: 8px;
            display: inline-block;
            max-width: 70%;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="modal fade" id="deleteModal-" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-">Submit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to Submit this task?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('update.status', $task->id) }}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div id="task-section">
            <div class="detail-box shadow-lg">

                <h2>Task Details</h2>
                <div id="task-details">
                    <div class="info">
                        <h4>Task Name:</h2>
                            <div class="right-box">
                                <p>{{ $task->name }}</p>
                            </div>
                    </div>
                    <div class="info">
                        <h4>Project Name:</h2>
                            <div class="right-box">
                                <p>{{ $task->project->name }}</p>
                            </div>
                    </div>
                    <div class="info">
                        <h4>Work Employee on this Task:</h2>
                            <div class="right-box">
                                <p>{{ $task->user->name }}</p>
                            </div>
                    </div>
                    <div class="info">
                        <h4>Started Date Of Task:</h2>
                            <div class="right-box">
                                <p>{{ \Carbon\Carbon::parse($task->started)->format('F j, Y') }}</p>
                            </div>
                    </div>
                    <div class="info">
                        <h4>Submission Date Of Task:</h2>
                            <div class="right-box">
                                <p>{{ \Carbon\Carbon::parse($task->end_at)->format('F j, Y') }}</p>
                            </div>
                    </div>
                    <div class="description">
                        <h4>Task Description:</h2>
                            <p class="mx-2">{{ $task->description }}</p>
                    </div>
                    <button type="button" class="btn btn-primary my-5 text-center" data-bs-toggle="modal"
                        data-bs-target="#deleteModal-">
                        Submit Your Task
                    </button>
                    <div class="container-fluid overflow-y-auto">
                        @if (Session::has('info'))
                            <div class="alert alert-success alert-dismissible fade show container" role="alert">

                                <h3 style="text-align: center;">{{ Session::get('info') }}</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div id="chat-section">
            <div id="chat-header">Chat with Admin about Task</div>
            <div id="chatBox">
                <div class="chat-box" id="chatBox">

                    @if (isset($task->comments))
                        @foreach ($task->comments as $comment)
                            @if ($comment->user->role_id == 1)
                                <div class="message-container-1">
                                    <p class="left-msg">
                                        <span style="font-size: 12px; font-weight: 400;">{{ $comment->user->name }}:</span>
                                        {{ $comment->comment }}
                                    </p><br>
                                    <span style="font-size: 10px;">
                                        {{ \Carbon\Carbon::parse($comment->created_at)->format('F j, Y \a\t H:i') }}</span>
                                </div>
                            @endif

                            @if ($comment->user->role_id == 2)
                                <div class="message-container-2">
                                    <p class="right-msg" style="margin-bottom: 0px; text-align:right;">
                                        {{ $comment->comment }}
                                        <span style="font-size: 12px; font-weight: 400;">: You </span>
                                    </p><br>
                                    <span
                                        style="font-size: 10px;">{{ \Carbon\Carbon::parse($comment->created_at)->format('F j, Y \a\t H:i') }}</span>

                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- <div id="message-input-container"> --}}
            <div id="input-box">
                <form action="{{ route('add.comment') }}" method="POST" id="message-input-container">
                    @csrf
                    <input type="text" name="task_id" id="" value="{{ $task->id }}" hidden>

                    @if (auth()->check())
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    @endif
                    <input type="text" class="message-input" name="comment" placeholder="Type your comment.....">
                    <button type="submit" id="send-btn">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Function to scroll to the bottom of the chat box
        function scrollToBottom() {
            var chatBox = $('.chat-box');
            var scrollHeight = chatBox.prop('scrollHeight');
            var currentScroll = chatBox.scrollTop();
            var distanceToScroll = scrollHeight - currentScroll;
            chatBox.animate({
                scrollTop: '+=' + distanceToScroll
            }, 'easeIn');
        }

        $(document).ready(function() {
            setTimeout(function() {
                scrollToBottom();
            }, 500);
        });


        // ---------Send Message Function in AJAX -------------
        $(document).on('submit', '#message-input-container', function(event) {
            event.preventDefault();
            let formData = $(this).serialize();

            // Send an AJAX request to the add.comment route
            $.ajax({
                type: 'POST',
                url: '{{ route('add.comment') }}',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#chatBox').load(window.location.href + ' #chatBox');
                        $('#input-box').load(window.location.href + ' #input-box');

                        function scrollToBottom() {
                            var chatBox = $('.chat-box');
                            var scrollHeight = chatBox.prop('scrollHeight');
                            chatBox.scrollTop(scrollHeight);
                        }

                        $(document).ready(function() {
                            setTimeout(function() {
                                scrollToBottom();
                            }, 500);
                        });

                        $("#chat-section").html(text).hide().show("easeIn");

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection
