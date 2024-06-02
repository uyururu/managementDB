@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Marks Register</h1>
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
                                            Search Marks Register
                                        </h3>
                                    </div>
                                    <form method="get" action="">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Exam</label>
                                                    <select class="form-control" name="exam_id" required>
                                                        <option value="">Select</option>
                                                        @foreach ($getExam as $exam)
                                                            <option
                                                                {{ Request::get('exam_id') == $exam->id ? 'selected' : '' }}
                                                                value="{{ $exam->id }}"> {{ $exam->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Class</label>
                                                    <select class="form-control" name="class_id" required>
                                                        <option value="">Select</option>
                                                        @foreach ($getClass as $class)
                                                            <option
                                                                {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                                value="{{ $class->id }}"> {{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for=""></label>
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top:30px">Search</button>
                                                    <a href="{{ url('admin/examinations/marks_register') }}"
                                                        class="btn btn-success" style="margin-top:30px">Reset</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include('_message')
                        @if (!empty($getSubject) && !empty($getSubject->count()))
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Marks Register</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                @foreach ($getSubject as $subject)
                                                    <th>
                                                        {{ $subject->subject_name }} <br />
                                                        {{ $subject->passing_mark }}/{{ $subject->full_marks }}
                                                    </th>
                                                @endforeach
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($getSubject) && !empty($getSubject->count()))
                                                @foreach ($getStudent as $student)
                                                    <form name="post" class="SubmitForm">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="student_id"
                                                            value="{{ $student->id }}">
                                                        <input type="hidden" name="exam_id"
                                                            value="{{ Request::get('exam_id') }}">
                                                        <input type="hidden" name="class_id"
                                                            value="{{ Request::get('class_id') }}">
                                                        <tr>
                                                            <td>
                                                                {{ $student->name }} {{ $student->last_name }}
                                                            </td>

                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($getSubject as $subject)
                                                                @php
                                                                    $getMark = $subject->getMark(
                                                                        $student->id,
                                                                        Request::get('exam_id'),
                                                                        Request::get('class_id'),
                                                                        $subject->subject_id,
                                                                    );
                                                                @endphp
                                                                <td>
                                                                    <div>
                                                                        Class Work
                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][subject_id]"
                                                                            value="{{ $subject->subject_id }}"
                                                                            class="form-control">
                                                                        <input type="text"
                                                                        value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}"
                                                                            name="mark[{{ $i }}][class_work]"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div>
                                                                        Home Work
                                                                        <input type="text"
                                                                            value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}"
                                                                            name="mark[{{ $i }}][home_work]"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div>
                                                                        Test Work
                                                                        <input type="text"
                                                                            value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}"
                                                                            name="mark[{{ $i }}][test_work]"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div>
                                                                        Exam
                                                                        <input type="text"
                                                                            value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}"
                                                                            name="mark[{{ $i }}][exam]"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div style="margin-top: 10px">
                                                                        <button type="button" class="btn btn-primary SaveSingleSubject"
                                                                            id="{{ $student->id }}"  data-val="{{ $subject->subject_id }}"
                                                                        data-exam="Request::get('exam_id')" data-class="Request::get('class_id')">Save</button>
                                                                    </div>
                                                                </td>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            <td>
                                                                <button class="btn btn-success" type="button"> Save
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    .

    <script type="text/javascript">
        $('.SubmitForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/examinations/submit_marks_register') }}",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    alert(data.message)
                }
            })
        })

        $('.SaveSingleSubject').click(function(e) 
        {
            var student_id = $(this).attr('id');
            var subject_id = $(this).attr('data-val');
            var exam_id = $(this).attr('data-exam');
            var class_id = $(this).attr('data-class');
            $.ajax({
                type: "POST",
                url: "{{ url('admin/examinations/single_submit_marks_register') }}",
                data:{
                    "_token" : "{{ csrf_token() }}",
                    student_id : student_id,
                    subject_id : subject_id,
                    exam_id : exam_id,
                    class_id : class_id,
                },
                dataType: "json",
                success: function(data) {
                    alert(data.message)
                }
            })
        })
        
    </script>
@endsection
