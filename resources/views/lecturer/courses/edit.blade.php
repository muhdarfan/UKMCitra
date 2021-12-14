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
        <div class="col-md-6 offset-md-1 col-xs-12">
            <div class="card card-cyan">
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
                            / {{ $citra->courseAvailability }}</dd>
                        <dt>Course Availability</dt>
                        <dd>
                            <form action="{{ route('mycitra.update', $citra->courseCode) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="input-group">
                                    <input type="number" name="courseAvailability" class="form-control"
                                           placeholder="Course Availability"
                                           min="{{ $citra->application->where('status', 'approved')->count() }}"
                                           value="{{ $citra->courseAvailability }}"/>
                                    <span class="input-group-append">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </span>
                                </div>
                            </form>
                        </dd>
                    </dl>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card card-cyan">
                <div class="card-header">
                    <h3 class="card-title">Recent Application</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 1%;">#</th>
                            <th>Matric No.</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        {!! $citra->application->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                        @foreach($citra->application->sortBy(['created_at', 'desc'])->take(5) as $idx => $application)
                            <tr>
                                <td>{{ $idx+1 }}</td>
                                <td>{{ $application->matric_no }}</td>
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
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
