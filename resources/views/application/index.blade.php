@extends('layouts.app')

@section('title','Application List')
@section('content')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student Application</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Course Code</th>
                    <th>Matric No.</th>
                    <th>Applicant's Name</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 @foreach($application as $application)
                  <tr>
                    <td>{{$application->courseCode}}</td>
                    <td>{{$application->matric_no}}</td>
                    
                    <td>{{$application->courseCode}}</td>
                    <td> {{$application->status}}</td>
                    <td >
                      <a class="btn btn-info mr-2" href="{{ route('application.show',$application->application_id) }}">View</a>
                      <a class="btn btn-success mr-2" href="">Approve</a>
                      <a class="btn btn-danger" href="">Reject</a>
                    </td>
                    
                  </tr>
                  @endforeach
                 
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            @endsection
            