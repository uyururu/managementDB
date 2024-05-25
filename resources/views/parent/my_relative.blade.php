@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Relative List</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
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
                                            <th>Student Name</th>
                                            <th>Parent Name</th>
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
                                            <th>Status</th>
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
                                                <td>{{ $value->parent_name }}{{ $value->parent_last_name }}</td>
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
                                                <td>{{ $value->status == 0 ? 'Acitve' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td style="width: 250px; display: flex">
                                                    <a href="{{ url('parent/my_relative/subject/' . $value->id) }}" class="btn btn-success mr-10">Subject</a>

                                                    <a href="{{ url('parent/my_relative/exam_timetable/' . $value->id) }}"class="btn btn-primary">Exam Timetable</a>
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
