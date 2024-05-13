@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Class</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input type="text" class="form-control" name="name" required
                                            placeholder="Enter Class Name" value="{{ $getRecord->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject Type</label>
                                        <select class="form-control" name="type">
                                            <option value="">Select Type</option>
                                            <option value="Theory" {{ $getRecord->type == 'Theory' ? 'selected' : '' }}>
                                                Theory
                                            </option>
                                            <option value="Practical"
                                                {{ $getRecord->type == 'Practical' ? 'selected' : '' }}>
                                                Practice
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
