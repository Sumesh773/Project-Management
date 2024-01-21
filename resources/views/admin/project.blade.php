@extends('admin.layout.dashboard')

@section('css')
    <style>
        .hidden {
            display: none;
            z-index: 99999;

        }

        .show-1 {
            margin-top: 8px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #212529;
            color: white;
            width: 349px;
            margin-left: -331px;
            text-align: left;

        }

        /* .info-text {
                                                                                                                                                                    margin-top: 8px;
                                                                                                                                                                    padding: 20px;
                                                                                                                                                                    border: 1px solid #ccc;
                                                                                                                                                                    background-color: #212529;
                                                                                                                                                                    color: white;
                                                                                                                                                                    width: 349px;
                                                                                                                                                                    margin-left: -331px;
                                                                                                                                                                    text-align: left;

                                                                                                                                                                } */

        .hover {
            transition: all 0.5s;
        }



        .hover:hover {
            transform: scale(1.3);
        }

        .project-btn-more {
            z-index: 9999;
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

        .project-boxes.jsGridView {
            height: 600px;
            padding: 23px 0px;
        }

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

        form {
            color: #111827;
            font-weight: 600;
            text-align: left;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid text-end" id="content-box-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                style="margin-right: 5px;" class="fa-solid fa-plus-circle"></i>
            Create Project
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="head-box">
                            <h1>Create Project</h1>
                        </div>
                        <form id="projectForm" action="{{ route('store.project') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Project Category</label>
                                <select id="name" class="form-select" aria-label="Default select example"
                                    name="designation_id">
                                    <option selected>Select Project Category</option>
                                    @foreach ($category as $key => $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label for="start_date" class="form-label">Project Start Date</label>
                                    <input type="date" id="start_date" class="form-control" placeholder=""
                                        min="{{ date('Y-m-d') }}" name="started_at">
                                </div>
                                <div class="col">
                                    <label for="end_date" class="form-label">Project End Date</label>
                                    <input type="date" id="end_date" class="form-control" placeholder="" min=""
                                        name="completed_at">
                                </div>
                            </div>

                            
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                            </div>
                            <div style="text-align: right" >
                                <button data-bs-dismiss="modal" class="btn btn-primary" type="text">Submit</button>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>


        <a href="{{ route('view.categories') }}"class="btn btn-dark "><i style="margin-right: 5px;"
                class="fa-solid fa-plus-circle"></i>Create Project Categories</a>
        <div class="projects-section">
            <div class="projects-section-header">
                <p>Projects</p>
                <p class="time">{{ now()->format('F j, Y') }}</p>
            </div>
            <div class="projects-section-line">
                <div class="projects-status">
                    <div class="item-status">
                        <span class="status-number">{{ $project->where('status', 'Started')->count() }}</span>
                        <span class="status-type">Started</span>
                    </div>
                    <div class="item-status">
                        <span class="status-number">{{ $project->where('status', 'In Progress')->count() }}</span>
                        <span class="status-type">In Progress</span>
                    </div>
                    <div class="item-status">
                        <span class="status-number">{{ $project->where('status', 'Completed')->count() }}</span>
                        <span class="status-type">Completed</span>
                    </div>
                    <div class="item-status">
                        @isset($project)
                            <span class="status-number">
                                {{ count($project) }}</span>
                        @else
                            <span class="status-number">0</span>
                        @endisset

                        <span class="status-type">Total Projects</span>
                    </div>
                </div>
                <div class="view-actions">

                </div>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show container" role="alert">

                    <h3 style="text-align: center;">{{ Session::get('success') }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="project-boxes jsGridView overflow-y-auto">
                @foreach ($project as $projects)
                    <div class="project-box-wrapper">
                        <div class="project-box" style="background-color:#d5deff;">
                            <div class="project-box-header">
                                <div>
                                    <a class="hover delete-project" type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal-{{ $projects->id }}" style="color: #d61313;">
                                        <i style="font-size: 20px; margin-left:10px;" class="fa-solid fa-trash-can"></i>
                                    </a>
                                    <div class="modal fade" id="exampleModal-{{ $projects->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel-{{ $projects->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        {{ $projects->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you Sure to Delete this Project?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="deleteProjectForm"
                                                        action="{{ route('delete.project', $projects->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" id="delete-btn" class="btn btn-danger"
                                                            data-bs-dismiss="modal"
                                                            data-id={{ $projects->id }}>Delete</button>
                                                        <button type="button" class="btn btn-Primary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-wrapper">

                                    <a type="button" class="hover edit-task" style="color: #212529;"
                                        data-project-id="{{ $projects->id }}" href="#"><i style="font-size: 20px;"
                                            class="fa-solid fa-pen-to-square"></i></a>

                                    <!-- Your modal container -->
                                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog"
                                        aria-labelledby="taskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editProjectModalLabel">Task Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="editProjectModalBody">
                                                    <!-- Content loaded dynamically through AJAX will appear here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="project-box-content-header">
                                <p class="box-content-header">{{ $projects->name }}</p>

                                {{ $projects->designation->name }}

                            </div>

                            <div class="box-progress-wrapper">
                                <p class="box-progress-header">Progress</p>
                                <div class="box-progress-bar">
                                    <span class="box-progress" style="width: 60%; background-color: #4f3ff0"></span>
                                </div>
                                <p class="box-progress-percentage">60%</p>
                            </div>
                            <div class="project-box-footer">
                                <div class="participants">
                                    <span style="font-weight:600;"><span style="font-weight: 400;">Started Date:</span>
                                        {{ \Carbon\Carbon::parse($projects->started_at)->format('F j, Y') }}</span>
                                </div>

                                @php
                                    $startedAt = Carbon\Carbon::parse($projects->started_at);
                                    $completedAt = Carbon\Carbon::parse($projects->completed_at);
                                    $remainingDays = $completedAt->diffInDays($startedAt);
                                @endphp

                                <div class="days-left" style="color: #4f3ff0;">
                                    {{ $remainingDays }} Days Left
                                </div>
                            </div>
                            <div class="project-box-footer" style="margin-top: 10px;">
                                <div>
                                    <a href="{{ route('list.task', $projects->id) }}"class="btn btn-dark "> <i
                                            style="margin-right: 5px;" class="fas fa-eye"></i>View Tasks


                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-dark add-task" type="button"
                                        data-project-id="{{ $projects->id }}">
                                        <i style="margin-right: 5px;" class="fa-solid fa-plus-circle"></i>Add New Task
                                    </a>
                                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog"
                                        aria-labelledby="addTask" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addTask">Task Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="editProjectModalBody">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', function() {
                $('#alert-container').hide();
            });
            $('#alert-container').on('click', function(e) {
                e.stopPropagation();
            });
            setTimeout(function() {
                $('#alert-container').fadeOut('slow');
            }, 2000);
        });

        //  Edit Project AJEX Function
        $(document).on('click', '.edit-task', function(e) {
            e.preventDefault();

            var projectId = $(this).data('project-id');

            $.ajax({
                type: 'GET',
                url: 'edit/project/' + projectId,
                success: function(response) {
                    if (response.html) {

                        $('#editProjectModalBody').html(response.html);
                        $('#Modal').modal('show');
                    } else {
                        console.error('Error fetching task details.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status, error);
                }
            });
        });


        // Add Task In Project AJEX Function
        $('.add-task').click(function(e) {
            e.preventDefault();

            var projectId = $(this).data('project-id');

            $.ajax({
                type: 'GET',
                url: 'create/task/' + projectId,
                success: function(response) {
                    console.log('AJAX Success:', response);

                    if (response.html) {
                        $('#editProjectModalBody').html(response.html);
                        $('#Modal').modal('show');
                    } else {
                        console.error('No HTML content in the AJAX response.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });

        // DATE function
        $(document).on('input', '#start_date', function() {
            const startDateValue = $(this).val();
            const endDateInput = $('#end_date');

            if (startDateValue) {
                endDateInput.attr('min', startDateValue);
            } else {
                endDateInput.attr('min', '');
            }
        });

        // Post Form function In AJAX
        $(document).ready(function() {
            $(document).on('submit', '#projectForm', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('store.project') }}',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#content-box').load(window.location.href + ' #content-box');
                            $('#formData').load(window.location.href + ' #formData');
                            $(".project-boxes").html(text).hide().show("easeIn");
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });




        // Delete Project With AJAX Function
        $(document).on('click', '#delete-btn', function() {
            let id = $(this).data('id');
            // console.log(id);
            $.ajax({
                type: 'DELETE',
                url: '/admin/dashboard/' + id,
                data: {
                    "_token": "{{ csrf_token() }}", 
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        $('#content-box').load(window.location.href + ' #content-box-2');
                        $(".project-boxes").html(text).hide().show("easeIn");
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
