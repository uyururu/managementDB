@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject List (Total: {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/subject/add') }}" class="btn btn-primary">Add new subject</a>
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
                                            Search subject
                                        </h3>
                                    </div>
                                    <form method="get" action="">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Name" value="{{ Request::get('name') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Subject Type</label>
                                                    <select class="form-control" name="type" required>
                                                        <option value="">Select Type</option>
                                                        <option {{ Request::get('type') == 'Theory' ? 'selected' : '' }}
                                                            value="Theory">Theory</option>
                                                        <option {{ Request::get('type') == 'Practical' ? 'selected' : '' }}
                                                            value="Practical">Practical
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Date</label>
                                                    <input type="date" class="form-control" name="date"
                                                        placeholder="Enter Email" value="{{ Request::get('date') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/subject/list') }}" class="btn btn-success"
                                                        style="margin-top:30px">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Subject List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Subject Type</th>
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
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->type }}</td>
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
                                                    <a href="{{ url('admin/subject/edit/' . $value->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/subject/delete/' . $value->id) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
