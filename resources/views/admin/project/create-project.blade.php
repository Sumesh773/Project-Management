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
    <form id="projectForm" action="{{ route('store.project') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Project Category</label>
                <select id="name" class="form-select" aria-label="Default select example" name="designation_id">
                    <option selected>Select Project Category</option>
                    @foreach ($category as $key => $categories)
                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="row g-3">
                <div class="col">
                    <label for="start_date" class="form-label">Project Start Date</label>
                    <input type="date" id="start_date" class="form-control" placeholder="" min="<?php echo date('Y-m-d'); ?>" name="started_at">
                </div>
                <div class="col">
                    <label for="end_date" class="form-label">Project End Date</label>
                    <input type="date" id="end_date" class="form-control" placeholder="" min="<?php echo date('Y-m-d'); ?>" name="completed_at">
                </div>
            </div>

            <div class="mb-3 my-3">
                <label for="name" class="form-label">Status</label>
                <select id="name" class="form-select" aria-label="Default select example" name="status">
                    <option value="Started">Started</option>
                    <option value="Started">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
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

   

    </script>
</body>
</html>
