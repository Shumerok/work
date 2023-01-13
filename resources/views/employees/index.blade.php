@extends('layouts.main')
@section('css-table')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employees</h1>
                    </div><!-- /.col -->
                    {{--                    <div class="col-sm-6">--}}
                    {{--                        <ol class="breadcrumb float-sm-right">--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                            <li class="breadcrumb-item active">Courses</li>--}}
                    {{--                        </ol>--}}
                    {{--                    </div><!-- /.col -->--}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="btn-default ml-2">
                        <a href="{{route('employees.create')}}" class="btn-block btn-primary btn-lg">Add Employee</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <table id="employee" class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th>
                                            Photo
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Position
                                        </th>
                                        <th>
                                            Date employment
                                        </th>
                                        <th>
                                            Phone
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Salary
                                        </th>
                                        <th class="text-center">
                                            Actions
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>
                                                <img src="{{$employee->photo}}" alt="photo" width="40px">
                                            </td>
                                            <td>
                                                {{$employee->name}}
                                            </td>
                                            <td>
                                                {{$employee->position->name}}
                                            </td>
                                            <td>
                                                {{date($employee->date_employment)}}
                                            </td>
                                            <td>
                                                {{$employee->phone}}
                                            </td>
                                            <td>
                                                {{$employee->email}}
                                            </td>
                                            <td>
                                                {{'$'. number_format($employee->salary,3)}}
                                            </td>
                                            <td>
                                                {{--                                                <a class="btn btn-primary btn-sm"--}}
                                                {{--                                                   href="{{route('employees.show',$employee->id)}}">--}}
                                                {{--                                                    <i class="fas fa-folder mr-1"></i>View</a>--}}
                                                <div class="row">
                                                    <a class="btn btn-info btn-sm mr-3"
                                                       href="{{route('employees.edit',$employee->id)}}">
                                                        <i class="fas fa-pencil-alt mr-1"></i></a>
                                                    <form action="{{route('employees.destroy', $employee->id)}}"
                                                          class="mr-15"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash mr-1 " role="button"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
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
    <script>
        $(document).ready(function () {
            $('#employee').DataTable();
        });
    </script>
@endpush
