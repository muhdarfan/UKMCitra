@extends('layouts.app')

@section('title', "Courses Detail")
@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-{{ $message['type'] ?? 'danger' }} alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> {{ $message['type'] == 'success' ? 'Success' : 'Error' }}!</h5>
            <p>{{ $message['text'] }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Application List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 1%;"></th>
                                <th>Student</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $citra->application->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                            @foreach($citra->application as $application)
                                <tr>
                                    <td>#{{ $application->application_id }}</td>
                                    <td><a target="_blank"
                                           href="{{ route('application.show', $application->application_id) }}">{{ $application->matric_no }}
                                            - {{ $application->applicant->name }}</a>
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
                                    <td>{{ $application->created_at->format('d-m-Y H:m') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    {!! $citra->application->withQueryString()->links() !!}

                    <a href="{{ route('mycitra.show', $citra->courseCode) }}"
                       class="badge badge-primary text-sm">All</a>
                    <a href="{{ route('mycitra.show', [$citra->courseCode, 'status' => 'pending']) }}"
                       class="badge badge-warning text-sm">Pending</a>
                    <a href="{{ route('mycitra.show', [$citra->courseCode, 'status' => 'approved']) }}"
                       class="badge badge-success text-sm">Approved</a>
                    <a href="{{ route('mycitra.show', [$citra->courseCode, 'status' => 'rejected']) }}"
                       class="badge badge-danger text-sm">Rejected</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $citra->courseCode }} - {{ $citra->courseName }}'s</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <dl>
                        <dt>Course Code</dt>
                        <dd>{{ $citra->courseCode }}</dd>
                        <dt>Course Name</dt>
                        <dd>{{ $citra->courseName }}</dd>
                        <dt>Course Credit</dt>
                        <dd>{{ $citra->courseCredit }}</dd>
                        <dt>Course Category</dt>
                        <dd>{{ $citra->courseCategory }}</dd>
                        <dt>Course Current Student</dt>
                        <dd>{{ $citra->application->where('status', 'approved')->count() }}
                            / {{ $citra->courseAvailability }} students
                        </dd>
                        <dt>Course Availability</dt>
                        <dd>
                            {{ $citra->courseAvailability }} students
                        </dd>
                    </dl>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
