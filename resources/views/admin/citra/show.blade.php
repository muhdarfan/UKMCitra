@extends('layouts.app')

@section('title', 'Course Detail')
@section('content')
    <!-- COURSE INFO OVERVIEW ROW -->
    <div class="row">
        <div class="col-md-3">
            <div class="info-box mb-3 bg-gradient-primary">
                <span class="info-box-icon"><i class="far fa-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Applications</span>
                    <span class="info-box-number">{{ $applications->count() ?? 0 }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3">
            <div class="info-box mb-3 bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Approved</span>
                    <span
                        class="info-box-number">{{ $applications->where('status', '=', 'approved')->count() ?? 0 }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3">
            <div class="info-box mb-3 bg-gradient-danger">
                <span class="info-box-icon"><i class="far fa-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Rejected</span>
                    <span class="info-box-number">{{ $applications->where('status', '=', 'rejected')->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3">
            <div class="info-box mb-3 bg-gradient-warning">
                <span class="info-box-icon"><i class="far fa-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pending</span>
                    <span
                        class="info-box-number">{{ $applications->where('status', '=', 'pending')->count() ?? 0 }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <!-- COURSE DETAIL ROW -->
    <div class="row">
        <div class="col-md-8">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{$citra->courseCode}} - {{$citra->courseName}}</h3>
                    <h3 class="card-title float-right">{{$citra->courseCategory}}</h3>
                </div>

                <div class="card-body">
                    <div class="p-3">
                        <img src="{{ asset('images/logo_ukm.png') }}"
                             class="center-block d-block mx-auto img-fluid img-thumbnail"/>
                    </div>

                    {{$citra->descriptions}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $citra->courseCategory }}</h5>
                                <span class="description-text">CATEGORY</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $citra->courseCredit }}</h5>
                                <span class="description-text">CREDITS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $citra->courseAvailability }}</h5>
                                <span class="description-text">AVAILABILITY</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <h5 class="description-header">{{ $applications->where('status', '=', 'approved')->count() }}</h5>
                                <span class="description-text">STUDENTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </div>

        <div class="col-md-4">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Recent Application</h3>
                </div>

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
                            {!! $applications->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                            @foreach($applications->take(6) as $application)
                                <tr>
                                    <td>#{{ $application->application_id }}</td>
                                    <td><a target="_blank"
                                           href="{{ route('users.show', $application->matric_no) }}">{{ $application->matric_no }}
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
            </div>
        </div>
    </div>

    <!-- COURSE STATISTIC -->
    <div class="row">
        <div class="col-md-8">
            <!-- CHART -->
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Weekly Recap Report</h3>
                </div>

                <div class="card-body">
                    @if($applicationsDate->isNotEmpty() && $applicationsDate->count() > 2)
                        <p class="text-center">
                            <strong>Application: {{ \Carbon\Carbon::createFromFormat('d/m/Y', $applicationsDate->keys()->first())->format('d M, Y') }}
                                - {{ \Carbon\Carbon::createFromFormat('d/m/Y', $applicationsDate->keys()->last())->format('d M, Y') }}</strong>
                        </p>

                        <div class="chart">
                            <!-- Application Chart Canvas -->
                            <canvas id="applicationChart" height="300" style="height: 300px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    @else
                        <p class="text-center">
                            <strong>We don’t have enough data to show anything useful.</strong>
                        </p>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-4">
            <!-- Application by Year Chart -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Application by Year</h3>
                </div>
                <div class="card-body">
                    @if($applicationsStats->isNotEmpty())
                        <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <div class="p text-center text-bold">We don’t have enough data to show anything useful.</div>
                    @endif
                </div>
            </div>

            <!-- Application by Faculty Chart -->
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">Application by Faculty</h3>
                </div>
                <div class="card-body">
                    @if($applicationsFaculty->isNotEmpty())
                        <canvas id="facultyPieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <div class="p text-center text-bold">We don’t have enough data to show anything useful.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"
            integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    <script type="text/javascript">
        $(function () {
            const yearPieChartCanvas = $('#pieChart').get(0).getContext('2d')
            const facultyPieChartCanvas = $('#facultyPieChart').get(0).getContext('2d')

            const pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }

            // Application by Year Chart
            new Chart(yearPieChartCanvas, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($applicationsStats->keys()) !!},
                    datasets: [
                        {
                            data: {!! json_encode($applicationsStats->values()) !!},
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                },
                options: pieOptions
            });

            // Application by Faculty Chart
            new Chart(facultyPieChartCanvas, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($applicationsFaculty->keys()) !!},
                    datasets: [
                        {
                            data: {!! json_encode($applicationsFaculty->values()) !!},
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                },
                options: pieOptions
            });

            // Application Weekly Report

            /*
            ===========
            LINE CHART
            ===========
            */

            const applicationChartCanvas = $('#applicationChart').get(0).getContext('2d')
            const areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                elements: {
                    line: {
                        tension: 0.4
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Date"
                        },
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        stacked: true,
                        title: {
                            display: true,
                            text: "Total Application"
                        },
                        grid: {
                            display: false,
                        }
                    }
                }
            }

            new Chart(applicationChartCanvas, {
                type: 'line',
                data: {
                    labels: {!! json_encode($applicationsDate->keys()) !!},
                    datasets: [
                        {
                            label: 'Approved Application',
                            backgroundColor: 'rgb(75, 192, 192)',
                            borderColor: 'rgba(210, 214, 222, 1)',
                            fill: true,
                            data: {!! json_encode($applicationsDate->values()->pluck('approved')) !!}
                        },
                        {
                            label: 'Rejected Application',
                            backgroundColor: 'rgb(255, 99, 132, 0.9)',
                            borderColor: 'rgba(255, 99, 132, 0.8)',
                            fill: true,
                            data: {!! json_encode($applicationsDate->values()->pluck('rejected')) !!}
                        },
                        {
                            label: 'Application Submitted',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188, 0.8)',
                            fill: true,
                            data: {!! json_encode($applicationsDate->values()->pluck('all')) !!}
                        },
                    ]
                },
                options: areaChartOptions
            });
        });
    </script>
@endpush
