@extends('layouts.app')

@section('title') Application Detail #{{ $application->application_id }} @endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://gambarpel.ukm.my/images/A174652.jpg" alt="User profile picture"/>
                    </div>

                    <h3 class="profile-username text-center">{{ $application->applicant->name }}</h3>

                    <p class="text-muted text-center">
                        {{ $application->applicant->studentInfo->faculty }} -
                        Year {{ $application->applicant->studentInfo->year() }}
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>
                                Priority
                                <i class="fas fa-info-circle" data-toggle="tooltip"
                                           title="Based on Current Year, Citra Course Category needed, and CGPA."></i></b>
                            <a class="float-right">{{ $application->points > 499 ? 'HIGH' : 'MEDIUM' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Citra Course Taken</b> <a
                                class="float-right">{{ $application->applicant->applications->where('status', 'approved')->count() }}</a>
                        </li>
                    </ul>
                </div>

                <div class="ribbon-wrapper ribbon-lg">
                    @php
                        $status = 'warning';
                        if($application->status === 'approved')
                            $status = 'success';
                        elseif ($application->status === 'rejected')
                            $status = 'danger';
                    @endphp

                    <div class="ribbon bg-{{ $status }} text-lg">
                        {{ $application->status }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Student Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">

                    <div class="form-group row">
                        <label for="matric" class="col-sm-2 col-form-label">Matric Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" value="{{ $application->matric_no }}"
                                   id="matric" placeholder="Matric Number" readonly/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->applicant->name }}" id="name" placeholder="Student Name"
                                   readonly/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="faculty" class="col-sm-2 col-form-label">Faculty</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->applicant->studentInfo->faculty }}" id="faculty"
                                   placeholder="Faculty" readonly/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sessionEnter" class="col-sm-2 col-form-label">Session Enter</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->applicant->studentInfo->session_enter }}" id="sessionEnter"
                                   placeholder="Session Enter" readonly/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->applicant->phone }}" id="phone" placeholder="Phone Number"
                                   readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Extra Information</h3>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="currentCredit">Current Credit</label>
                            <input type="number" class="form-control-plaintext"
                                   value="{{ $application->applicant->studentInfo->credit_limit }}"
                                   id="currentCredit" placeholder="Current Credit" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="creditAllow">Credit Allowed</label>
                            <input type="number" class="form-control-plaintext" value="20" id="creditAllow"
                                   placeholder="Credit Allowed" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="courseCode">Course Code</label>
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->course->courseCode }}"
                                   id="courseCode" placeholder="Course Code" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="courseName">Course Name</label>
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->course->courseName }}" id="courseName"
                                   placeholder="Course Name" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="createdAt" class="col-sm-2 col-form-label">Applied at</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $application->created_at->format('d M, Y H:i a') }}" id="createdAt"
                                   placeholder="Applied at" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-10">
                            <textarea readonly class="form-control-plaintext" rows="3"
                                      placeholder="Reason">{{ $application->reason }}</textarea>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer {{ ($application->status !== 'pending') ? 'text-center' : '' }}">
                    <a href="{{ route('application.index') }}" class="btn btn-success"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>

                    @if($application->status=='pending')
                        <div class="float-right">
                            <form action="{{ route('application.update', $application->application_id) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <button class="btn bg-gradient-danger float-right mr-2" name="deact"
                                        value="{{$application->application_id}}">
                                    Reject
                                </button>

                                <button class="btn bg-gradient-success float-right mr-2" name="act"
                                        value="{{$application->application_id}}">
                                    Approve
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
