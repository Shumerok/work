@extends('layouts.main')
@section('css-table')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Employee</h2>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-4 border">
                        <div class="mt-2">
                            <h3>Add employee</h3>
                        </div><!-- /.col -->
                        <form action="{{route('employers.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Photo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="photo" id="exampleInputFile" value="{{old('photo')}}">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @error('photo')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name of employee"
                                       value="{{old('name')}}">
                                @error('name')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="+380 (XX) XXX XX XX" value="{{old('phone')}}">
                                @error('phone')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select name="position_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach($positions as $position)
                                        <option value="{{$position->id}}" {{$position->id == old('position_id') ? ' selected' : ''}}>
                                            {{$position->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Salary, $</label>
                                <input type="text" class="form-control" name="salary" placeholder="500 max" value="{{old('salary')}}">
                                @error('salary')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Head</label>
                                <input class="form-control" id="employee_search" type="text" name="headName" value="{{old('headName')}}"
                                       placeholder="Start to autocomplete">
                                <input class="form-control" id="head" type="hidden" name="head"
                                       value="{{old('head')}}"
                                       placeholder="Start to autocomplete">
                                @error('head')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Date of employment</label>
                                <input id="datepicker" type="text" class="form-control" name="date_employment" value="{{old('date_employment')}}"
                                       placeholder="date">
                                @error('date_employment')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            @if(auth()->user())
                                <div class="form-group">
                                    <input name="admin_created_id" type="hidden" value="{{auth()->user()->id}}">
                                    <input name="admin_updated_id" type="hidden" value="{{auth()->user()->id}}">
                                </div>
                            @endif
                            <div class="row mb-2">
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
    <!-- ./wrapper -->
@endsection
@push('js-table')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({ dateFormat: 'yy-m-d' }).val();
        });
    </script>
    <!-- Script -->
    <script type="text/javascript">

        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {

            $("#employee_search").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{route('employees.getEmployees')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#employee_search').val(ui.item.label); // display the selected text
                    $('#head').val(ui.item.value); // save selected id to input
                    return false;
                }
            });

        });
    </script>
@endpush
