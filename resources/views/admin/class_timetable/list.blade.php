@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>List of Class Timetable</h1>
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
                                @include('_message');
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Search Class Timetable
                                        </h3>
                                    </div>
                                    <form method="get" action="">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Class Name</label>
                                                    <select class="form-control getClass" required name="class_id">
                                                        <option value="">Select</option>
                                                        @foreach ($getClass as $class)
                                                            <option
                                                                {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                                value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Subject Name</label>
                                                    <select class="form-control getSubject" name="subject_id" required>
                                                        <option value="">Select</option>
                                                        @if (!empty($getSubject))
                                                            @foreach ($getSubject as $subject)
                                                                <option
                                                                    {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}
                                                                    value="{{ $subject->subject_id }}">
                                                                    {{ $subject->subject_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/class_timetable/list') }}"
                                                        class="btn btn-success" style="margin-top:30px">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                         
                        @if (!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                            <form action="{{ url('admin/class_timetable/add') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Class TimeTable</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Week</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Room Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach ($week as $value)
                                                    <tr>
                                                        <th>
                                                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $value['week_id'] }}">
                                                            {{ $value['week_name'] }}
                                                        </th>
                                                        <th>
                                                            <input type="time" name="timetable[{{ $i }}][start_time]" value="{{ $value['start_time'] }}" class="form-control">
                                                        </th>
                                                        <th>
                                                            <input type="time" name="timetable[{{ $i }}][end_time]"  value="{{ $value['end_time'] }}" class="form-control">
                                                        </th>
                                                        <th>
                                                            <input type="text" style="width: 200px" name="timetable[{{ $i }}][room_number]"  value="{{ $value['room_number'] }}" class="form-control">
                                                        </th>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div style="padding: 10px;text-align: center">
                                            <button class="btn btn-primary">Submary</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.getClass').change(function() {
            var class_id = $(this).val();
            console.log(class_id);
            $.ajax({
                url: "{{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id: class_id,
                },
                dataType: "json",
                success: function(response) {
                    $('.getSubject').html(response.html);
                }
            });
        });
    </script>
@endsection
