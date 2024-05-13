@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add List of Class Timetable</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Add Class Timetable
                                        </h3>
                                    </div>
                                    <form method="get" action="">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Class Name</label>
                                                    <input type="text" class="form-control" name="class_name"
                                                        placeholder="Enter Class Name"
                                                        value="{{ Request::get('class_name') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Subject Name</label>
                                                    <input type="text" class="form-control" name="subject_name"
                                                        placeholder="Enter Subject Name"
                                                        value="{{ Request::get('subject_name') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Date</label>
                                                    <input type="date" class="form-control" name="date"
                                                        placeholder="Enter Email" value="{{ Request::get('date') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-success"
                                                        style="margin-top:30px">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('_message')
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Subject List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->subject_name }}</td>
                                                <td>
                                                    @if ($value->status == 0)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/assign_subject/edit/' . $value->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/assign_subject/edit_single/' . $value->id) }}"
                                                        class="btn btn-primary">Edit Single</a>
                                                    <a href="{{ url('admin/assign_subject/delete/' . $value->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px;text-align: right">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
