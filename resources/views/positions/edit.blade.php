@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Positions</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-4 border pt-3 pb-3">
                        <div>
                            <h4>Edit position</h4>
                        </div><!-- /.col -->
                        <form action="{{route('positions.update', $position->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$position->name}}">
                                @error('name')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>Created at:</label> {{$position->created_at->format('d.m.Y')}}
                                    <br>
                                    <label>Updated at:</label> {{$position->updated_at->format('d.m.Y')}}
                                </div>
                                <div class="col-4 ml-auto">
                                    <label>Admin created at:</label> {{$position->admin_created_id}}
                                    <br>
                                    <label>Admin updated at:</label> {{$position->admin_updated_id}}
                                </div>
                            </div>
                            @if(auth()->user())
                                <div class="form-group hide">
                                    <input name="admin_updated_id" type="hidden" value="{{auth()->user()->id}}">
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-3 col-3">
                                    <button type="reset" class="btn btn-block btn-secondary btn-flat">Cencel</button>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <button type="submit" class="btn btn-block btn-secondary btn-flat">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection