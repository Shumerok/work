@extends('layouts.main')
@section('css-table')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <h1 class="m-0">Employees</h1>
                    </div><!-- /.col -->
                    <div class="col-2 ml-auto">
                        <a href="{{route('employers.create')}}" class="btn btn-block btn-secondary btn-flat">Add
                            Employee</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <table id="employee" class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Date employment</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Salary</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" id="sample_form" class="form-horizontal">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Remove employee</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="remove"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 align="center" style="margin:0;">Are you sure you want to remove employee
                                            <i class="name"></i>?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-sm-3 col-3">
                                            <button type="button" class="btn btn-block btn-secondary btn-flat"
                                                    data-bs-dismiss="modal">Cencel
                                            </button>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <button type="button" class="btn btn-block btn-secondary btn-flat"
                                                    name="ok_button" id="ok_button">Remove
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js-table')
    <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#employee').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{route('employer.getAjaxData')}}",
                "columns": [
                    {
                        'data': 'photo',
                        "render": function (data) {
                            return '<img src="' + '{{url('storage')}}/' + data + '"  width="40px" />';
                        }
                    },
                    {'data': 'name'},
                    {
                        'data': 'position.name',
                        "defaultContent": "<i>Not set</i>"
                    },
                    {
                        'data': 'date_employment',
                        'render': function (data) {
                            date = new Date(data)
                            return Intl.DateTimeFormat(undefined, {
                                year: "numeric",
                                month: "numeric",
                                day: "numeric",
                            }).format(date);
                        }
                    },
                    {'data': 'phone'},
                    {'data': 'email'},
                    {
                        'data': 'salary',
                        'render': function (data) {
                            return '$' + data.toFixed(3);
                        }
                    },
                    {'data': 'action', orderable: false, searchable: false},
                ]
            });

            var employer_id;

            $(document).on('click', '.delete', function () {
                employer_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#ok_button').click(function () {
                $.ajax({
                    type: "DELETE",
                    url: "employers/" + employer_id,
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    success: function () {
                        $('#confirmModal').modal('hide');
                        $('#employee').DataTable().ajax.reload();
                    }
                })
            });
        });
    </script>
@endpush
