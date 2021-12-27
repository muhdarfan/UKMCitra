@extends('layouts.app')

@section('title','Application List')
@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-{{ $message['type'] ?? 'danger' }} alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> {{ $message['type'] == 'success' ? 'Success' : 'Error' }}!</h5>
            <p>{!! $message['text'] !!}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Search:</label>
                            <form method="GET" action="{{ route('application.index') }}">
                                <div class="input-group">
                                    <input id="inputSearch" name="search" type="text" class="form-control"
                                           value="{{ Request::input('search') }}" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                    <!-- /btn-group -->
                                </div>
                                <!-- /input-group -->
                            </form>
                        </div>

                        <div id="subjects" class="form-group">
                            @php $color = collect(['success', 'secondary', 'primary', 'info']) @endphp
                            @foreach(auth()->user()->citras as $citra)
                                <a class="badge text-md badge-{{ $color->random() }}"
                                   href="{{ route('application.index', ['course' => $citra->courseCode ]) }}"><span>{{ $citra->courseCode }}</span></a>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('application.index', ['search' => 'pending']) }}"
                                       class="nav-link">
                                        <i class="far fa-circle text-warning"></i>
                                        Pending
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('application.index', ['search' => 'approved']) }}"
                                       class="nav-link">
                                        <i class="far fa-circle text-success"></i> Approved
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('application.index', ['search' => 'rejected']) }}"
                                       class="nav-link">
                                        <i class="far fa-circle text-danger"></i>
                                        Rejected
                                    </a>
                                </li>
                            </ul>
                        </div>


                        @if(Request::collect()->count() > 0)
                            <a href="{{ route('application.index') }}">Reset</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Application</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 20%">Course Code</th>
                                <th>Matric No.</th>
                                <th>Applicant's Name</th>
                                <th style="width: 8%" class="text-center">Status</th>
                                <th style="width: 25%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($application as $application)
                                <tr>
                                    <td class="align-middle"><a
                                            href="{{ route('mycitra.show', $application->courseCode) }}">{{$application->courseCode}}</a>
                                    </td>
                                    <td class="align-middle">{{$application->matric_no}}</td>

                                    <td class="align-middle">{{$application->name}}</td>
                                    <td class="text-center align-middle"> @if($application->status=='pending')<span
                                            class="badge badge-warning">Pending</span>
                                        @elseif($application->status=='approved')<span
                                                class="badge badge-success">Approved</span>
                                        @elseif($application->status=='rejected')<span
                                                class="badge badge-danger">Rejected</span>
                                        @endif</td>
                                    <td class="align-middle">
                                        <form action="{{ route('application.update', $application->application_id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')

                                            <a class="btn bg-gradient-primary mr-1"
                                               href="{{ route('application.show',$application->application_id) }}">View</a>

                                            @if($application->status === 'pending')
                                                <button class="btn bg-gradient-success mr-1" name="act"
                                                        value="{{$application->application_id}}">Approve
                                                </button>
                                                <button class="btn bg-gradient-danger" name="deact"
                                                        value="{{$application->application_id}}">Reject
                                                </button>
                                            @endif
                                        </form>
                                    </td>


                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>

                    <br/>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection
