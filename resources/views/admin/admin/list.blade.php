@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Admin List (Total: {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Add new Admin</a>
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
                                            Search Admin
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
                                                    <label>Email Address</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Enter Email" value="{{ Request::get('email') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Date</label>
                                                    <input type="date" class="form-control" name="date"
                                                        placeholder="Enter Email" value="{{ Request::get('date') }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for=""></label>
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/admin/list') }}" class="btn btn-success"
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
                                <h3 class="card-title">Admin List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/admin/edit/' . $value->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/admin/delete/' . $value->id) }}"
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
