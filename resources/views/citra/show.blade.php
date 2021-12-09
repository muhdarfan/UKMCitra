@extends('layouts.app')

@section('title', 'Course Detail')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$citra->courseCode}} - {{$citra->courseName}}</h3>
        <h3 class="card-title float-right">{{$citra->courseCategory}}</h3>

        <!-- Card Button (Remove if needed) -->
        
    </div>
    <div class="card-body">
        <div class="card-body">
        <img src="{{ asset('images/logo_ukm.png') }}" class="center-block d-block mx-auto img-fluid img-thumbnail" alt="Italian Trulli">
        </div>
        
        {{$citra->descriptions}}
    </div>
    <!-- /.card-body -->
    
    <!-- /.card-footer-->
</div>
<!-- /.card -->


@endsection
