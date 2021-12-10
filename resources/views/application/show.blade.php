@extends('layouts.app')

@section('title','Application Detail')
@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">{{$application->courseCode}} - Student Information</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form action="" class="form-horizontal" method="POST">
      @csrf
     
      

      <div class="card-body">
        
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$application->user->name}}" id="name" placeholder="Name" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="matric" class="col-sm-2 col-form-label">Matric Number</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$application->matric_no}}" id="matric" placeholder="Matric Number" readonly>
          </div>
        </div>
        <div class="form-group row">
            <label for="faculty" class="col-sm-2 col-form-label">Faculty</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" id="faculty" placeholder="Faculty" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
              <input type="text"  class="form-control" value="{{$application->user->phone}}" id="phone" placeholder="Availability" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" placeholder="Course Description"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="stuentno" class="col-sm-2 col-form-label">Current Student</label>
            <div class="col-sm-10">
              
            </div>
          </div>
        
        
      </div>
      <!-- /.card-body -->
     
    </form>
  </div>
  <!-- /.card -->


@endsection