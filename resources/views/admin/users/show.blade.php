@extends('layouts.app')

@section('title','User Information')
@section('content')
    <div class="row">
        <div class="{{ $user->role === 'admin' ? 'col-md-6 offset-md-3' : 'col-md-8' }}">
            <div class="card card-cyan">
                <div class="card-header">
                    <h3 class="card-title">
                        User Information
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <dl>
                        <dt>Matric No</dt>
                        <dd>{{ $user->matric_no }}</dd>
                        <dt>Name</dt>
                        <dd>{{ $user->name }}</dd>
                        <dt>Role</dt>
                        <dd>{{ ucfirst($user->role) }}</dd>
                    </dl>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- ./col -->

        @if($user->role === 'student' || $user->role === 'lecturer')
            <div class="col-md-4">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ $user->role === 'student' ? 'Recent Application' : "Lecturer's Subject" }}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 1%;">#</th>
                                <th>Subject</th>
                                <th>{{ $user->role === 'student' ? 'Status' : 'Current Student' }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($user->role === 'student')
                                {!! $user->applications()->count() < 1 ? '<tr><td colspan="3">No data to be displayed.</td></tr>' : '' !!}

                                @foreach($user->applications->sortBy(['created_at', 'desc'])->take(5) as $idx => $application)
                                    <tr>
                                        <td>{{ $idx+1 }}</td>
                                        <td>
                                            <a href="{{ route('citra.show', $application->courseCode) }}">{{ $application->courseCode }}</a>
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
                            @elseif($user->role === 'lecturer')
                                {!! $user->citras()->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                                @foreach($user->citras as $idx => $citra)
                                    <tr>
                                        <td>{{ $idx+1 }}</td>
                                        <td>
                                            <a href="{{ route('citra.show', $citra->courseCode) }}">
                                                {{ $citra->courseCode }} - {{ $citra->courseName }}
                                            </a>
                                        </td>
                                        <td>{{ $citra->application()->where('status', 'approved')->count() }}
                                            / {{ $citra->courseAvailability }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- ./col -->

        @endif
    </div>
@endsection
