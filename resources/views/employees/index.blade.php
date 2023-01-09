@extends('layouts.main')
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
                    <div class="col-1">
                        <a href="{{route('employees.create')}}" class="btn-block btn-primary btn-lg">Add Employee</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            Photo
                                        </th>
                                        <th style="width: 10%">
                                           Name
                                        </th>
                                        <th style="width: 10%">
                                            Position
                                        </th>
                                        <th style="width: 10%">
                                            Date employment
                                        </th>
                                        <th style="width: 10%">
                                            Phone
                                        </th>
                                        <th style="width: 10%">
                                            Email
                                        </th>
                                        <th style="width: 10%">
                                            Salary
                                        </th>
                                        <th style="width: 20%" class="text-center" colspan="3">
                                            Actions
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="">
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>
                                                <img src="{{$employee->photo}}" alt="photo" width="50px">
                                            </td>
                                            <td>
                                                {{$employee->name}}
                                            </td>
                                            <td>
                                                {{$employee->position}}
                                            </td>
                                            <td>
                                                {{$employee->date_employment}}
                                            </td>
                                            <td>
                                                {{$employee->phone}}
                                            </td>
                                            <td>
                                                {{$employee->email}}
                                            </td>
                                            <td>
                                                {{$employee->salary}}
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{route('employees.show',$employee->id)}}">
                                                    <i class="fas fa-folder mr-1"></i>View</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                   href="{{route('employees.edit',$employee->id)}}">
                                                    <i class="fas fa-pencil-alt mr-1"></i>Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{route('employees.destroy', $employee->id)}}" class="mr-15"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash mr-1 " role="button"></i>Delete
                                                    </button>
                                                </form>
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