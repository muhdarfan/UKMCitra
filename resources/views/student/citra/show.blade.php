@extends('layouts.app-basic', ['title' => 'Course Details'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{$citra->courseCode}} - {{$citra->courseName}}</h3>
                    <h3 class="card-title float-right">{{$citra->courseCategory}}</h3>
                </div>
                <div class="card-body">
                    <div class="p-3">
                        <img src="{{ asset('images/logo_ukm.png') }}"
                             class="center-block d-block mx-auto img-fluid img-thumbnail">
                    </div>

                    {{$citra->descriptions}}
                </div>
                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Lecturer</h3>
                </div>
                <div class="card-body">

                    <div class="list-group">
                        {{ count($citra->lecturers) < 1 ? "No data to be displayed." : '' }}

                        @foreach($citra->lecturers as $lecturer)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="img-fluid" src="https://gambarpel.ukm.my/images/A174652.jpg"
                                             alt="Photo"
                                             style="max-height: 70px;"/>
                                    </div>
                                    <div class="col px-4">
                                        <p>{{ $lecturer->name }} ({{ $lecturer->matric_no }})</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
