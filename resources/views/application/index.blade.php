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
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($application as $key => $value)
                  <tr>
                    <td>{{$value->courseCode}}</td>
                    <td>I{{$value->matric_no}}
                    </td>
                    <td>{{$value->courseCode}}</td>
                    <td> {{$value->status}}</td>
                    <td>X</td>
                  </tr>
                  @endforeach
                 
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            @endsection
            