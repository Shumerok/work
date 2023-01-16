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
                        <h1 class="m-0">Positions</h1>
                    </div><!-- /.col -->

                    <div class=" ml-auto mr-2">
                        <a href="{{route('positions.create')}}" class="btn btn-block btn-secondary btn-flat">Add position</a>
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
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <table id="position-table" class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th style="width: 70%">
                                            Name
                                        </th>
                                        <th style="width: 20%">
                                            Date
                                        </th>
                                        <th>
                                            Actions
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="">
                                    @foreach($positions as $position)
                                        <tr>
                                            <td>
                                                {{$position->name}}
                                            </td>
                                            <td>
                                                {{$position->updated_at->format('d.m.Y')}}
                                            </td>
                                            <td>
                                                {{--                                                <a class="btn btn-primary btn-sm"--}}
                                                {{--                                                   href="{{route('employees.show',$employee->id)}}">--}}
                                                {{--                                                    <i class="fas fa-folder mr-1"></i>View</a>--}}
                                                <div class="row">
                                                    <a class="btn btn-info btn-sm mr-3"
                                                       href="{{route('positions.edit',$position->id)}}">
                                                        <i class="fas fa-pencil-alt mr-1"></i></a>
                                                    <form action="{{route('positions.destroy', $position->id)}}"
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

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
            $('#position-table').DataTable();
        });
    </script>
@endpush