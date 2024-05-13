@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher List (Total: {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add new Teacher</a>
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
                                            Search Teacher
                                        </h3>
                                    </div>
                                    <form method="get" action="">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Name" value="{{ Request::get('name') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="last_name"
                                                        placeholder="Enter Last Name"
                                                        value="{{ Request::get('last_name') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Enter Email" value="{{ Request::get('email') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender">
                                                        <option value="">Select Gender</option>
                                                        <option {{ Request::get('class') == 'Male' ? 'selected' : '' }}
                                                            value="Male">Male
                                                        </option>
                                                        <option {{ Request::get('class') == 'Female' ? 'selected' : '' }}
                                                            value="Femaie">
                                                            Femaie</option>
                                                        <option {{ Request::get('class') == 'Other' ? 'selected' : '' }}
                                                            value="Other">
                                                            Other
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Date Of Birth</label>
                                                    <input type="date" class="form-control" name="date_of_birth"
                                                        placeholder="Enter Class Name"
                                                        value="{{ Request::get('date_of_birth') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Date Of Joining</label>
                                                    <input type="date" class="form-control" name="date_of_joining"
                                                        placeholder="Enter Class Name"
                                                        value="{{ Request::get('date_of_joining') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" name="mobile_number"
                                                        placeholder="Enter Mobile Number"
                                                        value="{{ Request::get('mobile_number') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Marital Status</label>
                                                    <input type="text" class="form-control" name="marital_status"
                                                        placeholder="Enter Class Name"
                                                        value="{{ Request::get('marital_status') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Current Address</label>
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Enter Address" value="{{ Request::get('address') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="">Select Status</option>
                                                        <option {{ Request::get('status') == 100 ? 'selected' : '' }}
                                                            value="0">Active</option>
                                                        <option {{ Request::get('status') == 1 ? 'selected' : '' }}
                                                            value="1">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/teacher/list') }}" class="btn btn-success"
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
                                <h3 class="card-title">Class List</h3>
                            </div>
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Profile Pic</th>
                                            <th>Teacher Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Date Of Birth</th>
                                            <th>Date Of Joining</th>
                                            <th>Mobile Number</th>
                                            <th>Marital Status</th>
                                            <th>Current Address</th>
                                            <th>Permanent Address</th>
                                            <th>Qualification</th>
                                            <th>Work Experience</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if (!empty($value->getProfile()))
                                                        <img src="{{ $value->getProfile() }}" alt=""
                                                            style="height:50px; width:50px; border-radius:50px">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }}{{ $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>
                                                    @if (!empty($value->date_of_birth))
                                                        {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($value->date_of_joining))
                                                        {{ date('d-m-Y', strtotime($value->date_of_joining)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>{{ $value->marital_status }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->permanent_address }}</td>
                                                <td>{{ $value->qualification }}</td>
                                                <td>{{ $value->work_experience }}</td>
                                                <td>{{ $value->note }}</td>
                                                <td>{{ $value->status == 0 ? 'Acitve' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td style="min-width: 100px">
                                                    <a href="{{ url('admin/teacher/edit/' . $value->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ url('admin/teacher/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
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
