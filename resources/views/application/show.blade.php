@extends('layouts.app')

@section('title','Application Detail')
@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">{{$application->courseCode}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form action="" class="form-horizontal" method="POST">
      @csrf
     

      <div class="card-body">
        <div class="form-group row">
          <label for="coursecode" class="col-sm-2 col-form-label">Course Code</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="" id="coursecode" placeholder="Course Code">
          </div>
        </div>
        <div class="form-group row">
          <label for="coursename" class="col-sm-2 col-form-label">Course Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="" id="coursename" placeholder="Course Name">
          </div>
        </div>
        <div class="form-group row">
            <label for="availability" class="col-sm-2 col-form-label">Availability</label>
            <div class="col-sm-10">
              <input type="number" min="1" class="form-control" id="availability" placeholder="Availability">
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
      <div class="card-footer">
        <button type="submit" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-info float-right">Update</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->


@endsection