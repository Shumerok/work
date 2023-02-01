@extends('layouts.main')
@section('css-table')
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"/>--}}
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
                                                <div class="row">
                                                    <a class="btn btn-default  mr-3"
                                                       href="{{route('positions.edit',$position->id)}}">
                                                        <i class="fas fa-pencil-alt "></i></a>
                                                    <a href="#delete{{$position->id}}" data-toggle="modal" class="btn btn-danger"><i class='fa fa-trash'></i></a>
                                                    @include('includes.positions.delete')
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
            $('#position-table').DataTable();

        });


    </script>
@endpush