@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Courses</span>
                    <span class="info-box-number">{{ $coursesCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Application <i class="fas fa-info-circle" data-toggle="tooltip"
                                                               title="Total application for this session."></i></span>
                    <span class="info-box-number">{{ $applicationCount ?? 0 }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-comment-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Feedback</span>
                    <span class="info-box-number">{{ $feedbackCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- CHARTS SECTION -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Weekly Recap Report</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
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
                        <!-- /.col -->

                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Top 4 Courses</strong>
                                <i class="fas fa-info-circle" data-toggle="tooltip"
                                   title="Top 4 courses based on course availability, application count and time."></i></span>
                            </p>

                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($topCourses as $course)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="https://via.placeholder.com/150" alt="Product Image"
                                                 class="img-circle img-size-32">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('citra.show', $course->courseCode) }}" target="_blank"
                                               class="product-title">
                                                {{ $course->courseCode }} - {{ $course->courseName }}
                                                @if(intval($course->cntLeft) < 0)
                                                    <span class="badge badge-warning float-right">Exceed</span>
                                                @elseif(intval($course->cntLeft) === 0)
                                                    <span class="badge badge-success float-right">Full</span>
                                                @else
                                                    <span class="badge badge-info float-right">{{ intval($course->cntLeft) }} left</span>
                                                @endif
                                            </a>
                                            <span class="product-description">
                                                {{ $course->cnt }} total applications of {{ $course->courseAvailability }} slots.

                                                @if($course->cntLeft < 0)
                                                    Exceeded by {{ $course->approved - $course->courseAvailability }}
                                                    students!
                                                @elseif(intval($course->cntLeft) === 0)
                                                    Full
                                                    at {{ \Carbon\Carbon::parse($course->last_submit)->format('d M, Y') }}
                                                @endif
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ $applicationCount }}</h5>
                                <span class="description-text">TOTAL APPLICATION</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{!! $applicantCount !!}</h5>
                                <span class="description-text">TOTAL APPLICANTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">??</h5>
                                <span class="description-text">UNIQUE COURSES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <h5 class="description-header">{{ $fullCoursesCount }}</h5>
                                <span class="description-text">COURSES FULL</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>

    <!-- APPLICATION BY YEAR & STATUS -->
    <div class="row">
        <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Application by Year</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(!$applicationsStats->isEmpty())
                        <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <div class="p text-center text-bold">We don’t have enough data to show anything useful.</div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Application by Status</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(!$applicationStatus->isEmpty())
                        <canvas id="applicationStatusChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <div class="p text-center text-bold">We don’t have enough data to show anything useful.</div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"
            integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    <script>
        $(function () {
            /*
            ===========
            LINE CHART
            ===========
            */

            const applicationChartCanvas = $('#applicationChart').get(0).getContext('2d')
            var areaChartOptions = {
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


            /*
            ========
            PIE CHART
            ========
             */
            @if(!$applicationsStats->isEmpty())
            const pieChartCanvas = $('#pieChart').get(0).getContext('2d')

            const pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }

            // Create pie chart for Application by Year & Status
            new Chart(pieChartCanvas, {
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
            @endif

            @if($applicationStatus->isNotEmpty())
            const appStatusChartCanvas = $('#applicationStatusChart').get(0).getContext('2d');
            new Chart(appStatusChartCanvas, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($applicationStatus->keys()) !!},
                    datasets: [
                        {
                            label: 'Total Application',
                            data: {!! json_encode($applicationStatus->values()) !!},
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: '#eee',
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                        }
                    ],
                },
            });
            @endif
        });
    </script>
@endpush
