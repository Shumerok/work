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
                <div class="row ">
                    <div class="ml-2">
                        <h1 class="m-0">Employees</h1>
                    </div><!-- /.col -->

                    <div class=" ml-auto mr-2">
                        <a href="{{route('employers.create')}}" class="btn btn-block btn-secondary btn-flat">Add Employee</a>
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
                                    @foreach($employees as $employer)
                                        <tr>
                                            <td>
                                                <img src="{{asset('storage/'. $employer->photo)}}" alt="photo" width="40px">
                                            </td>
                                            <td>
                                                {{$employer->name}}
                                            </td>
                                            <td>
                                                {{$employer->position()->pluck('name')->implode(',')}}
                                            </td>
                                            <td>
                                                {{date($employer->date_employment)}}
                                            </td>
                                            <td>
                                                {{$employer->phone}}
                                            </td>
                                            <td>
                                                {{$employer->email}}
                                            </td>
                                            <td>
                                                {{'$'. number_format($employer->salary,3)}}
                                            </td>
                                            <td>
                                                {{--                                                <a class="btn btn-primary btn-sm"--}}
                                                {{--                                                   href="{{route('employees.show',$employee->id)}}">--}}
                                                {{--                                                    <i class="fas fa-folder mr-1"></i>View</a>--}}
                                                <div class="row">
                                                    <a class="btn btn-info btn-sm mr-3"
                                                       href="{{route('employers.edit',$employer->id)}}">
                                                        <i class="fas fa-pencil-alt mr-1"></i></a>
                                                    <form action="{{route('employers.destroy', $employer->id)}}"
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
