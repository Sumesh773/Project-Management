<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

        form {
            color: #111827;
            font-weight: 600;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="head-box">
        <h1>Create Project</h1>
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
        <form action="{{ route('update.project', $project->id) }}" method="POST" id="editForm" data-id="{{ $project->id }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Select Categories</label>
                <input type="text" class="form-control" name="designation_id" readonly
                    value="  {{ $project->designation->name }}" onclick="showMessage()">
                {{-- <select class="form-control" aria-label="Default select example" name="designation_id" readonly>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $project->designation_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select> --}}
            </div>

            <div class="row g-3">
                <div class="col">
                    <div class="col">
                        <label for="start_date" class="form-label">Project Start Date</label>
                        <input type="datetime-local" id="start_date_2" class="form-control" placeholder=""
                            min="<?php echo date('Y-m-d'); ?>" name="started_at" value="{{ $project->started_at }}">
                    </div>

                </div>
                <div class="col">
                    <label for="end_date" class="form-label">Project End Date</label>
                    <input type="datetime-local" id="end_date_2" class="form-control" placeholder=""
                        min="<?php echo date('Y-m-d'); ?>" name="completed_at" value="{{ $project->completed_at }}">
                </div>
            </div>

            <div class="mb-3 my-3">
                <label for="name" class="form-label">Status</label>
                <select id="name" class="form-select" aria-label="Default select example" name="status">
                    <option value="Started" @if ($project->status == 'Started') selected @endif>Started</option>
                    <option value="In Progress" @if ($project->status == 'In Progress') selected @endif>In Progress</option>
                    <option value="Completed" @if ($project->status == 'Completed') selected @endif>Completed</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{!! $project->description !!}</textarea>
            </div>
            <div style="text-align: right" >
                <button class="btn btn-primary" type="text" data-bs-dismiss="modal">Submit</button>
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
            endDateInput.min = formatDate(startDate);
        });

        // Function to format the date as "YYYY-MM-DD"
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }


        function showMessage() {
            alert("You cannot edit this project category. Consider adding a new project with the selected category.");

        }



        $(document).on('submit', '#editForm', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'update/project/' + id,
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

        $(document).on('input', '#start_date_2', function() {
            const startDateValue = $(this).val();
            const endDateInput = $('#end_date_2');

            if (startDateValue) {
                endDateInput.attr('min', startDateValue);
            } else {
                endDateInput.attr('min', '');
            }
        });
    </script>
</body>

</html>
