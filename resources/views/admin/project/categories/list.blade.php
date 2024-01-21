@extends('admin.layout.dashboard')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
            /* margin-bottom:20px; */
        }

        /* .img-box {
                                                background: #b34b4b1c;
                                                width: 60%;
                                                display: initial;
                                                justify-content: center;
                                                align-items: center;
                                                padding: 41px 0px;
                                                cursor: pointer;
                                            } */
        /* .box{
                                                margin: auto;
                                            } */


        .category-box {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            cursor: pointer;
        }

        .category-box:hover {
            transform: translateY(-5px);
        }

        .category-image {
            height: 200px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 6px;
        }

        .category-title {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        form {
            text-align: left;
            font-weight: 500;
        }
    </style>
@endsection


@section('content')
    <div class="head-box ">
        <h1>Categories List</h1>
    </div>
    <div class="container-fluid text-end my-3">
        <button class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#exampleModal"><i style="margin-right: 5px;"
                class="fa-solid fa-plus-circle"></i>Create
            Categories</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="head-box ">
                            <h1> Create Project Category</h1>
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
                        <div class="container-fluid overflow-y-auto">
                            <form action="{{ route('store.categories') }}" method="POST" enctype="multipart/form-data"
                                id="categoryForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <button data-bs-dismiss="modal" type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid overflow-y-auto">
        <div class="container">
            <div class="row" id="img-box">
                @foreach ($category as $item)
                    <div class="col-md-4 mb-4">
                        <div class="category-box">
                            <div class="category-image" style="background-image: url('/images/{{ $item->image }}');"></div>
                            <h3 class="category-title">{{ $item->name }}</h3>
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
            $(document).on('submit', '#categoryForm', function(e) {
                e.preventDefault();

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData($(this)[0]);
                formData.append('_token', csrfToken);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('store.categories') }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false, // Ensure no caching
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#img-box').load(window.location.href + ' #img-box');
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
    </script>
@endsection
