@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Relative List {{ $getParent->name }} {{ $getParent->last_name }}</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add new Parent</a>
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
                                            Search Relatve
                                        </h3>
                                    </div>
                                    <form method="get" action="">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label>Student ID</label>
                                                    <input type="text" class="form-control" name="id"
                                                        placeholder="Enter Id" value="{{ Request::get('id') }}">
                                                </div>
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
                                                {{-- <div class="form-group col-md-2">
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
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" name="occupation"
                                                        placeholder="Enter Occupation"
                                                        value="{{ Request::get('occupation') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Enter Address" value="{{ Request::get('address') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" name="mobile_number"
                                                        placeholder="Enter Mobile Number"
                                                        value="{{ Request::get('mobile_number') }}">
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
                                                <div class="form-group col-md-2">
                                                    <label>Created Date</label>
                                                    <input type="date" class="form-control" name="date"
                                                        placeholder="Enter Date" value="{{ Request::get('date') }}">
                                                </div> --}}
                                                <div class="form-group col-md-3">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/parent/my_relative/' . $parent_id) }}"
                                                        class="btn btn-success" style="margin-top:30px">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('_message')
                        @if (!empty($getSearchStudent))
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Parent Relative List</h3>
                                </div>
                                <div class="card-body p-0" style="overflow: auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Profile Pic</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Parent Name</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getSearchStudent as $value)
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
                                                    <td>{{ $value->parent_name }}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                    <td style="min-width: 100px">
                                                        <a href="{{ url('admin/parent/assign_student/' . $value->id . '/' . $parent_id) }}"
                                                            class="btn btn-primary btn-sm">Add Student To Parent</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div style="padding: 10px;text-align: right">
                                        {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parent Relative List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Profile Pic</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Parent Name</th>
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
                                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->parent_name }}</td>
                                                <td>
                                                    <a href="{{ url('admin/parent/assign_student_delete/' . $value->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px;text-align: right">
                                    {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
