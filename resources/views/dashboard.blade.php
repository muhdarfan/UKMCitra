@extends('layouts.app')

@section('title','Dashboard')
@section('content')
    @if(isset($announcement))
        <div class="col-12">
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Announcement:</h5>
                {{ $announcement->message }}
            </div>
        </div>
    @endif

    <!-- Default box -->
    <div class="row pt-5">
        <div class="col-lg-4 col-6 mx-auto">
            <div class="small-box bg-info">
                <div class="inner">
                    @if (Auth::user()->role == 'lecturer')
                        <h3>2</h3>
                        <p>Total Submitted Application</p>
                    @elseif (Auth::user()->role == 'admin')
                        <h3>2</h3>
                        <p>Total Submitted Feedback</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 mx-auto">
            <div class="small-box bg-info">
                <div class="inner">
                    @if (Auth::user()->role == 'lecturer')
                        <h3>1</h3>
                        <p>Total Approved Application</p>
                    @elseif (Auth::user()->role == 'admin')
                        <h3>1</h3>
                        <p>Total Feedback Today</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="fas fa-check-square"></i>
                </div>
            </div>
        </div>

    </div>
@endsection
