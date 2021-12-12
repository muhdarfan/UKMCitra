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
                            <span class="info-box-number text-center text-muted mb-0">4</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Approved Application</span>
                            <span class="info-box-number text-center text-muted mb-0">2</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Rejected Application</span>
                            <span class="info-box-number text-center text-muted mb-0">2</span>
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
                        Recent application
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>
@endsection
