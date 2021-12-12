@extends('layouts.app')

@section('title','User Information')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$user->matric_no}} - {{$user->name}}</h3>
        <h3 class="card-title float-right">{{$user->role}}</h3>

        <!-- Card Button (Remove if needed) -->
        
    </div>
    <div class="card-body">
        <div class="card-body">
        <img src="{{ asset('images/img_course.png') }}" class="center-block d-block mx-auto img-fluid img-thumbnail" alt="Italian Trulli" width="600" height="500">
        </div>
        
        <p class="text-justify">{{$user->descriptions}}</p>
    </div>
    <!-- /.card-body -->
    
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
