@extends('layouts.app-basic', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Announcement:</h5>
                What??
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Welcome back, {{ auth()->user()->name }}!</h5>

                            <p class="card-text">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Your application</span>
                            <span class="info-box-number text-center text-muted mb-0">{{ $applications->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Approved Application</span>
                            <span class="info-box-number text-center text-muted mb-0">{{ $applications->where('status', 'approved')->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Rejected Application</span>
                            <span class="info-box-number text-center text-muted mb-0">{{ $applications->where('status', 'rejected')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">CW</span>
                            <span class="info-box-number text-center text-muted mb-0">4 out of 6 completed: 2 more credit needed</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">CL</span>
                            <span class="info-box-number text-center text-muted mb-0">4 out of 6 completed: 2 more credit needed</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">CR</span>
                            <span class="info-box-number text-center text-muted mb-0">4 out of 6 completed: 2 more credit needed</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-th-large"></i>
                        Recent application (Session {{ config('app.semester') }}/{{ config('app.session') }})
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 1%;">#</th>
                                <th>Matric No.</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $applications->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                            @foreach($applications->take(5) as $application)
                                <tr>
                                    <td>
                                        <a target="_blank"
                                           href="{{ route('myApplication.show', $application->application_id) }}">#{{ $application->application_id }}</a>
                                    </td>
                                    <td>
                                        <strong>{{ $application->courseCode }}</strong> {{ $application->course->courseName }}
                                    </td>
                                    <td>
                                        @if($application->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>
@endsection
