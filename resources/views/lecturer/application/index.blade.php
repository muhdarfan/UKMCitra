@extends('layouts.app')

@section('title','Application List')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Student Application</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th width="20%">Course Code</th>
                    <th>Matric No.</th>
                    <th>Applicant's Name</th>
                    <th style="width: 8%" class="text-center">Status</th>
                    <th width=25%>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($application as $application)
                    <tr>
                        <td class="align-middle">{{$application->courseCode}}</td>
                        <td class="align-middle">{{$application->matric_no}}</td>

                        <td class="align-middle">{{$application->student_name}}</td>
                        <td class="text-center align-middle"> @if($application->status=='pending')<span
                                class="badge badge-warning">{{$application->status}}</span>
                            @elseif($application->status=='approved')<span
                                    class="badge badge-success">{{$application->status}}</span>
                            @elseif($application->status=='rejected')<span
                                    class="badge badge-danger">{{$application->status}}</span>
                            @endif</td>
                        <td class="align-middle">
                            {{Form::open(array('url'=>'application/update','method'=>'post','class'=>'form-login'))}}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a class="btn bg-gradient-primary mr-1"
                               href="{{ route('application.edit',$application->application_id) }}">View</a>
                            @if($application->status=='pending' and count($availability)< $citra->courseAvailability)
                                <button class="btn bg-gradient-success mr-1" name="act"
                                        value="{{$application->application_id}}">Approve
                                </button>
                                <button class="btn bg-gradient-danger" name="deact"
                                        value="{{$application->application_id}}">Reject
                                </button>
                            @endif
                            {{Form::close()}}
                        </td>


                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
