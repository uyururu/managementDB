@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Exam Timetable</h1>
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
                                @include('_message')
                        @foreach ( $getRecord as $value )
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $value['name'] }}</h3>
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
                                                @foreach ( $value['exam'] as $valueW )
                                                  
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        @endforeach
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
