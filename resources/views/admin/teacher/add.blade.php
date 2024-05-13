@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Teacher</h1>
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
                                            <label>Date Of Joining<span style="color: red">*</span></label>
                                            <input type="date" class="form-control" name="date_of_joining"
                                                value="{{ old('date_of_joining') }}">
                                            <div style="color:red">{{ $errors->first('date_of_joining') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Phone<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="mobile_number"
                                                value="{{ old('mobile_number') }}">
                                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Marital Status<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="marital_status"
                                                value="{{ old('marital_status') }}">
                                            <div style="color:red">{{ $errors->first('marital_status') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Pic<span style="color: red">*</span></label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Current Address<span style="color: red">*</span></label>
                                            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                                            <div style="color:red">{{ $errors->first('address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Permanent Address<span style="color: red">*</span></label>
                                            <textarea name="permanet_address" class="form-control" required>{{ old('permanent_address') }}</textarea>
                                            <div style="color:red">{{ $errors->first('permanet_address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Qualification<span style="color: red">*</span></label>
                                            <textarea name="qualification" class="form-control" required>{{ old('qualification') }}</textarea>
                                            <div style="color:red">{{ $errors->first('qualification') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Work Experience<span style="color: red">*</span></label>
                                            <textarea name="work_experience" class="form-control" required>{{ old('work_experience') }}</textarea>
                                            <div style="color:red">{{ $errors->first('work_experience') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Note<span style="color: red">*</span></label>
                                            <textarea name="note" class="form-control" required>{{ old('note') }}</textarea>
                                            <div style="color:red">{{ $errors->first('note') }}</div>
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
