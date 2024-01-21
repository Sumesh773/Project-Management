    @extends('Employee.layout.dashboard')

    @section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        .projects-section-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .projects-status {
            display: flex;
        }

        .item-status {
            margin-right: 20px;
            text-align: center;
        }

        .status-number {
            font-size: 24px;
            font-weight: bold;
        }

        .status-type {
            font-size: 18px;
        }

        .project-boxes {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .project-box {
            background-color: rgb(255, 255, 255);
            border: 2px solid rgb(180, 126, 126);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.171);
        }

        .project-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .project-btn-more {
            background: none;
            border: none;
            cursor: pointer;
        }

        .box-content-header {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        .box-content-subheader {
            font-size: 18px;
            color: #302f2f;
        }

        .box-progress-header {
            font-size: 18px;
            font-weight: bold;
            color: #000000;
            margin-top: 10px;
        }

        .project-box-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .days-left {
            font-size: 15px;
            font-weight: bold;
            color: #000;
            border-radius: 5px;
        }

        .date-box {
            font-weight: 600;
            font-size: 15px;
            background: #A0D9B4;
            padding: 7px;
            border-radius: 4px;
            color: rgb(43, 43, 43);
            margin: 0px;
        }

        #kanban-board {
            display: flex;
        }

        #create-button {
            display: flex;
            justify-content: center;
            background-color: #008da8;
            margin: 1rem 0;
            height: 2rem;
        }

        .column {
            flex: 1;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .color-1 {
            background: rgb(118, 165, 56);
        }


        .color-2 {
            background: rgb(118, 165, 56);
        }

        .color-3 {
            background: rgb(118, 165, 56);
        }

        .card {
            /* display: flex;
                                                        position: relative;
                                                        border: 1px solid #ccc;
                                                        padding: 10px;
                                                        margin: 10px 0;
                                                        text-align: left; */
        }

        .card {
            margin: 10px 0;
            height: 220px;
            background-color: rgb(255, 255, 255);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 30px;
            gap: 13px;
            position: relative;
            overflow: hidden;
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.062);
        }

        #cookieSvg {
            width: 50px;
        }

        #cookieSvg g path {
            fill: rgb(97, 81, 81);
        }

        .cookieHeading {
            font-size: 1.2em;
            font-weight: 800;
            color: rgb(26, 26, 26);
            margin: 0;
        }

        .cookieDescription {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: rgb(99, 99, 99);
            margin: 0;
        }

        .buttonContainer {
            display: flex;
            gap: 20px;
            flex-direction: row;
        }

        .acceptButton {
            width: 163px;
            height: 39px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #111827;
            transition-duration: .2s;
            border: none;
            color: rgb(241, 241, 241);
            cursor: pointer;
            font-weight: 600;
            border-radius: 20px;
        }

        a {
            text-decoration: none;
        }

        .declineButton {
            width: 80px;
            height: 30px;
            background-color: rgb(218, 218, 218);
            transition-duration: .2s;
            color: rgb(46, 46, 46);
            border: none;
            cursor: pointer;
            font-weight: 600;
            border-radius: 20px;
        }

        .declineButton:hover {
            background-color: #ebebeb;
            transition-duration: .2s;
        }

        .acceptButton:hover {
            background-color: #9173ff;
            transition-duration: .2s;
        }
    </style>

@endsection


@section('content')

    <div class="projects-section">
        <div class="projects-section-header">
            <p>Tasks</p>
            <p class="time">{{ now()->format('F j, Y') }}</p>
        </div>
        <div class="projects-section-line">
            <div class="projects-status">
                <div class="item-status">
                    @if (count($task ?? []) > 0)
                        @if ($task->where('status', 'In Progress')->count() > 0)
                            <span class="status-number">{{ $task->where('status', 'In Progress')->count() }}</span>
                        @else
                            <span class="status-number">0</span>
                        @endif
                        <span class="status-type">In Progress</span>
                    @else
                        <span class="status-number">0</span>
                        <span class="status-type">In Progress</span>
                    @endif
                </div>
                <div class="item-status">
                    @if (count($task ?? []) > 0)
                        @if ($task->where('status', 'Review')->count() > 0)
                            <span class="status-number">{{ $task->where('status', 'Review')->count() }}</span>
                        @else
                            <span class="status-number">0</span>
                        @endif
                        <span class="status-type">Review</span>
                    @else
                        <span class="status-number">0</span>
                        <span class="status-type">Review</span>
                    @endif
                </div>
                <div class="item-status">
                    @if (count($task ?? []) > 0)
                        @if ($task->where('status', 'Completed')->count() > 0)
                            <span class="status-number">{{ $task->where('status', 'Completed')->count() }}</span>
                        @else
                            <span class="status-number">0</span>
                        @endif
                        <span class="status-type">Completed</span>
                    @else
                        <span class="status-number">0</span>
                        <span class="status-type">Completed</span>
                    @endif
                </div>
                <div class="item-status">
                    @isset($task)
                        <span class="status-number">
                            {{ count($task) }}</span>
                    @else
                        <span class="status-number">0</span>
                    @endisset
                    <span class="status-type">Total Task</span>
                </div>
            </div>
            <div class="view-actions">

            </div>
        </div>
        <div class="container-fluid overflow-y-auto">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show container" role="alert">

                    <h3 style="text-align: center;">{{ Session::get('success') }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-around container-fluid border border-dark-subtle p-3"
            style="background:#111827; color:white;">
            <h1>IN PROGRESS</h1>
            <h1> IN REVIEW</h1>
            <h1>COMPLETED</h1>
        </div>

        <div class="overflow-auto">
            <div id="kanban-board">

                <div class="column color-1" id="todo">
                    @if (isset($task))
                        @foreach ($task as $tasks)
                            @if ($tasks->status === 'In Progress')
                                <div class="card">
                                    <p class="cookieHeading">{{ $tasks->name }}</p>
                                    <p class="cookieDescription">{{ $tasks->description }}</p>
                                    <div class="buttonContainer">
                                        <a href="{{route('view.task' , $tasks->id)}}" class="acceptButton view-task">View Task Detail</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($tasks->where('status', 'In Progress')->count() === 0)
                            <div class="card">
                                <p class="cookieHeading"> You have not assgin any tasks</p>
                            </div>
                        @endif
                    @else
                        <div class="card">
                            <p class="cookieHeading"> You have not assgin any tasks </p>
                        </div>
                    @endif
                </div>

                <div class="column color-2" id="in-progress">
                    @if (isset($task))
                        @foreach ($task as $tasks)
                            @if ($tasks->status === 'Review')
                                <div class="card">
                                    <p class="cookieHeading">{{ $tasks->name }}</p>
                                    <p class="cookieDescription">{{ $tasks->description }}</p>
                                    <div class="buttonContainer">
                                        <a href="{{route('view.task' , $tasks->id)}}" class="acceptButton view-task">View Task Detail</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($tasks->where('status', 'Review')->count() === 0)
                            <div class="card">
                                <p class="cookieHeading">You haven't sent any task for review.</p>
                            </div>
                        @endif
                    @else
                        <div class="card">
                            <p class="cookieHeading">You haven't sent any task for review.</p>
                        </div>
                    @endif
                </div>
                <div class="column color-3" id="done">
                    @if (isset($task))
                        @foreach ($task as $tasks)
                            @if ($tasks->status === 'Completed')
                                <div class="card">
                                    <p class="cookieHeading">{{ $tasks->name }}</p>
                                    <p class="cookieDescription">{{ $tasks->description }}</p>
                                    <div class="buttonContainer">
                                        <a href="{{route('view.task' , $tasks->id)}}" class="acceptButton view-task">View Task Detail</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($tasks->where('status', 'Completed')->count() === 0)
                            <div class="card">
                                <p class="cookieHeading">You don't have any completed tasks.</p>
                            </div>
                        @endif
                    @else
                        <div class="card">
                            <p class="cookieHeading">You don't have any completed tasks.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection

@section('js')

<script>
    
</script>
@endsection
