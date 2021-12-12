@extends('layouts.app')

@section('title', 'Course Detail')
@section('content')
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
@endsection
