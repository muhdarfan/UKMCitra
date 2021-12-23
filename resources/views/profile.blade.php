@extends('layouts.app')

@section('title', 'My Profile')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://gambarpel.ukm.my/images/A174652.jpg"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                    <p class="text-muted text-center">
                        {{ auth()->user()->matric_no }} - {{ ucfirst(auth()->user()->role) }}
                    </p>

                    @if(auth()->user()->role === 'lecturer')
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Subject</b> <a class="float-right">{{ auth()->user()->citras()->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Students</b> <a class="float-right">543</a>
                            </li>
                        </ul>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Activity</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab">Info</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-danger">10 Feb. 2014</span>
                                </div>
                                <!-- /.timeline-label -->

                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-user bg-info"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your
                                            friend request
                                        </h3>
                                    </div>
                                </div>
                                <!-- END timeline item -->

                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-success">3 Jan. 2014</span>
                                </div>
                                <!-- /.timeline-label -->

                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-user bg-info"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your
                                            friend request
                                        </h3>
                                    </div>
                                </div>
                                <!-- END timeline item -->


                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="info">
                            <div class="form-group row">
                                <label for="inputMatricNo" class="col-sm-2 col-form-label">Matric No</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="inputMatricNo"
                                           placeholder="Matric No"
                                           value="{{ auth()->user()->matric_no }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="inputName" placeholder="Name"
                                           value="{{ auth()->user()->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control-plaintext" id="inputEmail"
                                           placeholder="Email" value="{{ auth()->user()->email }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
