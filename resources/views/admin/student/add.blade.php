@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Student</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form method="post" action="" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="name" required
                                                value="{{ old('name') }}" placeholder="Enter First Name">
                                            <div style="color:red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="last_name" required
                                                value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Number<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="admission_number" required
                                                value="{{ old('admission_number') }}" placeholder="Enter Admission Number">
                                            <div style="color:red">{{ $errors->first('admission_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Roll Number</label>
                                            <input type="text" class="form-control" name="roll_number"
                                                value="{{ old('roll_number') }}" placeholder="Enter Roll Number">
                                            <div style="color:red">{{ $errors->first('roll_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Class<span style="color: red">*</span></label>
                                            <select class="form-control" required name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($getClass as $class)
                                                    <option {{ old('class_id') == $class->id ? 'selected' : '' }}
                                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <div style="color:red">{{ $errors->first('class_id') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender<span style="color: red">*</span></label>
                                            <select class="form-control" required name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male
                                                </option>
                                                <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Femaie">
                                                    Femaie</option>
                                                <option {{ old('gender') == 'Other' ? 'selected' : '' }} value="Other">
                                                    Other
                                                </option>
                                            </select>
                                            <div style="color:red">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date Of Birth<span style="color: red">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth"
                                                value="{{ old('date_of_birth') }}">
                                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Caste<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="caste"
                                                value="{{ old('caste') }}">
                                            <div style="color:red">{{ $errors->first('caste') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="religion"
                                                value="{{ old('religion') }}">
                                            <div style="color:red">{{ $errors->first('religion') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Phone<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="mobile_number"
                                                value="{{ old('mobile_number') }}">
                                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Date<span style="color: red">*</span></label>
                                            <input type="date" class="form-control" name="admission_date"
                                                value="{{ old('admission_date') }}">
                                            <div style="color:red">{{ $errors->first('admission_date') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Pic<span style="color: red">*</span></label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Blood Group<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="blood_group"
                                                value="{{ old('blood_group') }}">
                                            <div style="color:red">{{ $errors->first('blood_group') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Height<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="height"
                                                value="{{ old('height') }}">
                                            <div style="color:red">{{ $errors->first('height') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Weight<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="weight"
                                                value="{{ old('weight') }}">
                                            <div style="color:red">{{ $errors->first('weight') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status<span style="color: red">*</span></label>
                                            <select class="form-control" required name="status">
                                                <option value="">Select Status</option>
                                                <option value="0">Active</option>
                                                <option value="1">Inactive</option>
                                            </select>
                                            <div style="color:red">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Email Address<span style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" required
                                            placeholder="Enter Email" value="{{ old('email') }}">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password<span style="color: red">*</span></label>
                                        <input type="password" class="form-control" name="password" required
                                            placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
