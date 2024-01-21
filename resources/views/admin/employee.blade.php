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

        table {
            text-align: center;
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

        .dataTables_filter{
            text-align: right;
            font-size: 20px;
            font-weight: 500;
        }
        .dataTables_length{
            font-size: 20px;
            font-weight: 500;
        }
        


        /*
                                        th ,td{
                                            width: 30px;
                                        } */
    </style>
    <div class="head-box">
        <h1>Employees List</h1>
    </div>
    <div class="container-fluid overflow-y-auto">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show container" role="alert">
   
                <h3 style="text-align: center;">{{ Session::get('success') }}</h3>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    @endif
    <div class="alert alert-success alert-dismissible fade show delete-confirm"  role="alert" style="display: none">
        <h3 style="text-align: center;">User is deleted successfully!</h3>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        <table class="employees-list  table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
    </div>
    

 
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.employees-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employees') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_no',
                        name: 'phone_no'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });

      
    </script>
    <script>
            $(document).on('click', '.delete-btn', function () {
                var deleteUrl = $(this).data('delete-url');
                console.log(deleteUrl);
                var modalId = $(this).data('modal-id');

                $('.confirm-delete-btn').off('click').on('click', function () {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (result) {
                            // Handle success, for example, refresh the DataTable
                            $('.employees-list').DataTable().ajax.reload();
                            $('.delete-confirm').show();
                        },
                        error: function (xhr, status, error) {
                            // Handle error
                            console.error(xhr.responseText);
                        }
                    });
                    $('#' + modalId).modal('hide');
                    $('.modal-backdrop').remove();
                });
            });
    </script>
    
@stop