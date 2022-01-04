@extends('layouts.app-basic', ['title' => 'Application Status'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Application Status</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 20%">Course Code</th>
                                <th>Course Name</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Submitted On</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>{{ $application->courseCode }}</td>
                                    <td>{{ $application->course->courseName }}</td>
                                    <td>
                                        @if($application->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($application->status === 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $application->created_at->format('d M Y, H:i A') }}</td>
                                    <td>
                                        <a href="{{ route('myApplication.show', $application->application_id) }}"
                                           target="_blank" class="btn btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($applications->hasPages())
                    <div class="card-footer clearfix">
                        {{ $applications->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
@endsection
