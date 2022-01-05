@extends('layouts.app-basic', ['title' => 'Application Information'])

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card card-cyan">
                <div class="card-header">
                    <h3 class="card-title">Application Information</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="inputApplicationID">Application ID</label>
                        <input type="text" readonly class="form-control-plaintext" id="inputApplicationID"
                               placeholder="Enter name" value="#{{  $application->application_id }}">
                    </div>

                    <div class="form-group">
                        <label for="inputCourseCode">Course Code</label>
                        <input type="text" readonly class="form-control-plaintext" id="inputCourseCode"
                               placeholder="Enter name" value="{{  $application->course->courseCode }}">
                    </div>

                    <div class="form-group">
                        <label for="inputCourseName">Course Name</label>
                        <input type="text" readonly class="form-control-plaintext" id="inputCourseName"
                               placeholder="Enter name" value="{{ $application->course->courseName }}">
                    </div>

                    <div class="form-group">
                        <label for="inputName">Status</label>
                        <span class="form-control-plaintext">
                            @if($application->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($application->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </span>
                    </div>

                    @if($application->status !== 'pending')
                        <div class="form-group">
                            <label for="inputUpdated">Updated At</label>
                            <input type="text" readonly class="form-control-plaintext" id="inputUpdated"
                                   placeholder="Enter name" value="{{ $application->updated_at->format('d M Y, H:i A') }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="inputSubmited">Submitted At</label>
                        <input type="text" readonly class="form-control-plaintext" id="inputSubmited"
                               placeholder="Enter name" value="{{ $application->created_at->format('d M Y, H:i A') }}">
                    </div>

                    <div class="form-group">
                        <label for="inputReason">Reason</label>
                        <textarea class="form-control" readonly id="inputReason" placeholder="Reason" rows="3"
                                  style="resize: none;">{{ $application->reason }}</textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <a onclick="window.close();return false;" class="btn btn-success">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
