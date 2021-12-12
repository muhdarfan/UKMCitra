@extends('layouts.app')

@section('title','User Information')
@section('content')

<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-text-width"></i>
            User Information
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <dl>
            <dt>Matric No</dt>
            <dd>A description list is perfect for defining terms.</dd>
            <dt>Name</dt>
            <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
            <dt>Role</dt>
            <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
          </dl>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- ./col -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-text-width"></i>
            Application Count
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-4">Course Code</dt>
            <dd class="col-sm-8">A description list is perfect for defining terms.</dd>
            <dt class="col-sm-4">Course Name</dt>
            <dd class="col-sm-8">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
            <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
            <dt class="col-sm-4">Course Detail</dt>
            <dd class="col-sm-8">Etiam porta sem malesuada magna mollis euismod.</dd>
            <dt class="col-sm-4">Course Availability</dt>
            <dd class="col-sm-8">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
              sit amet risus.
            </dd>
          </dl>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- ./col -->
  </div>

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
