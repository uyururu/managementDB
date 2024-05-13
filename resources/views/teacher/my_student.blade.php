@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total: {{ $getRecord->total() }})</h1>
                    </div>
                    {{-- <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add new Student</a>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Search Student
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
                                                    <label>Admission Number</label>
                                                    <input type="text" class="form-control" name="admission_number"
                                                        placeholder="Enter Admission Number"
                                                        value="{{ Request::get('admission_number') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Roll Number</label>
                                                    <input type="text" class="form-control" name="roll_number"
                                                        placeholder="Enter Roll Number"
                                                        value="{{ Request::get('roll_number') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Class Name</label>
                                                    <input type="text" class="form-control" name="class_name"
                                                        placeholder="Enter Class Name"
                                                        value="{{ Request::get('class_name') }}">
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
                                                    <label>Caste</label>
                                                    <input type="text" class="form-control" name="caste"
                                                        placeholder="Enter Caste" value="{{ Request::get('caste') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Religion</label>
                                                    <input type="text" class="form-control" name="religion"
                                                        placeholder="Enter Religion"
                                                        value="{{ Request::get('religion') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" name="mobile_number"
                                                        placeholder="Enter Mobile Number"
                                                        value="{{ Request::get('mobile_number') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Admission Date</label>
                                                    <input type="date" class="form-control" name="admission_date"
                                                        placeholder="Enter Admission Date"
                                                        value="{{ Request::get('admission_date') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Blood Group</label>
                                                    <input type="text" class="form-control" name="blood_group"
                                                        placeholder="Enter Class Name"
                                                        value="{{ Request::get('blood_group') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Height</label>
                                                    <input type="text" class="form-control" name="height"
                                                        placeholder="Enter Height" value="{{ Request::get('height') }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Weight</label>
                                                    <input type="text" class="form-control" name="weight"
                                                        placeholder="Enter Weight" value="{{ Request::get('weight') }}">
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
                                                    <a href="{{ url('admin/student/list') }}" class="btn btn-success"
                                                        style="margin-top:30px">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
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
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Admission Number</th>
                                            <th>Roll Number</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>Date Of Birth</th>
                                            <th>Caste</th>
                                            <th>Religion</th>
                                            <th>Mobile Number</th>
                                            <th>Admission Date</th>
                                            <th>Blodd Group</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Created Date</th>
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
                                                {{-- <td>{{ $value->parent_name }}{{ $value->parent_last_name }}</td> --}}
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->admission_number }}</td>
                                                <td>{{ $value->roll_number }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>
                                                    @if (!empty($value->date_of_birth))
                                                        {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $value->caste }}</td>
                                                <td>{{ $value->religion }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>
                                                    @if (!empty($value->admission_date))
                                                        {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $value->blood_group }}</td>
                                                <td>{{ $value->height }}</td>
                                                <td>{{ $value->weight }}</td>
                                                {{-- <td>{{ $value->status == 0 ? 'Acitve' : 'Inactive' }}</td> --}}
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                {{-- <td style="min-width: 100px">
                                                    <a href="{{ url('admin/student/edit/' . $value->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ url('admin/student/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td> --}}
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
