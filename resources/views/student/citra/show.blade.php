@extends('layouts.app-basic', ['title' => 'Course Details'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ $citra->courseCode }} - {{ $citra->courseName }}</h3>
                    <h3 class="card-title float-right">{{ $citra->courseCategory }}</h3>
                </div>
                <div class="card-body">
                    <div class="p-3">
                        <img src="{{ asset('images/logo_ukm.png') }}"
                             class="center-block d-block mx-auto img-fluid img-thumbnail">
                    </div>

                    {{ $citra->descriptions }}
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-4">
            @if($citra->hasApplication())
                <a href="{{ route('myApplication.show', $citra->application->where('matric_no', auth()->user()->matric_no)->first()->application_id) }}"
                   target="_blank" class="btn btn-block btn-info">View Application</a>

                <hr/>
            @elseif($citra->courseAvailability > 0)
                <button data-toggle="modal" data-target="#modal-register" type="button"
                        class="btn btn-block btn-success">Register
                </button>

                <hr/>
            @endif

            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Lecturer</h3>
                </div>
                <div class="card-body">

                    <div class="list-group">
                        {{ count($citra->lecturers) < 1 ? "No data to be displayed." : '' }}

                        @foreach($citra->lecturers as $lecturer)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="img-fluid" src="https://gambarpel.ukm.my/images/A174652.jpg"
                                             alt="Photo"
                                             style="max-height: 70px;"/>
                                    </div>
                                    <div class="col px-4">
                                        <p>{{ $lecturer->name }} ({{ $lecturer->matric_no }})</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modal-register">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register Citra Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="form-register" action="{{ route('myApplication.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="courseCode" value="{{ $citra->courseCode }}"/>

                        <div class="form-group">
                            <label for="inputCourseName">{{ __('Student Name') }}</label>
                            <input type="text" class="form-control-plaintext" value="{{ auth()->user()->name }}"
                                   readonly/>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseName">{{ __('Faculty') }}</label>
                            <input type="text" class="form-control-plaintext"
                                   value="{{ auth()->user()->studentInfo->faculty }}" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseName">Course Name</label>
                            <input type="text" value="{{ $citra->courseName }}" class="form-control-plaintext"
                                   id="inputCourseName" readonly/>
                        </div>

                        <div class="form-row">
                            <div class="col-6">
                                <label for="inputCourseName">Course Category</label>
                                <input type="text" value="{{ $citra->courseCategory }}" class="form-control-plaintext"
                                       id="inputCourseCategory" readonly/>
                            </div>

                            <div class="col-6">
                                <label for="inputCourseName">Course Credit</label>
                                <div class="input-group">
                                    <input type="text" class="form-control-plaintext" id="inputCourseCredit"
                                           value="{{ $citra->courseCredit }}" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">/</span>
                                        <span
                                            class="input-group-text">{{ auth()->user()->studentInfo->credit_limit }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(!$citra->isAvailable())
                            <div class="form-group form-input-reason">
                                <label for="inputReason">Reason</label>
                                <textarea class="form-control" id="inputReason" name="reason" style="resize: none"
                                          rows="3" required></textarea>
                            </div>
                        @endif

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="event.preventDefault();document.getElementById('form-register').submit();"
                            type="button" class="btn btn-success">Confirm
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
