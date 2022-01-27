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

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
                <span class="info-box-icon bg-olive"><i class="far fa-folder-open"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">My Courses</span>
                    <span class="info-box-number">{{ $courses->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
                <span class="info-box-icon bg-lightblue"><i class="far fa-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Full Courses</span>
                    <span class="info-box-number">{{ $fullCoursesCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
                <span class="info-box-icon bg-purple"><i class="far fa-file-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Application</span>
                    <span class="info-box-number">{{ $applicationCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
                <span class="info-box-icon bg-maroon"><i class="far fa-copy"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pending Application</span>
                    <span class="info-box-number">{{ $statusHolder['pending'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Summary Report</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-6">
                            <h5>Recent Application</h5>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Matric</th>
                                        <th>Student Name</th>
                                        <th style="width: 40px">Status</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($applications->sortByDesc('created_at')->take(4)->values() as  $application)
                                        <tr>
                                            <td>{{ $application->matric_no }}</td>
                                            <td>{{ $application->name }}</td>
                                            <td>
                                                @if($application->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif($application->status == 'rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($application->created_at)->format('d M Y H:i a') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-6">
                            <h5>My Courses</h5>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th style="width: 40px">Status</th>
                                        <th>Availability</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courses->take(4) as $courseCode => $course)
                                        <tr>
                                            <td>{{ $courseCode }}</td>
                                            <td>{{ $course['courseName'] }}</td>
                                            <td>
                                                @if($course['isFull'])
                                                    <span class="badge badge-warning">Full</span>
                                                @else
                                                    <span class="badge badge-success">{{ ($course['courseAvailability'] - $course['applications']) }} left</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $course['applications']  }} / {{ $course['courseAvailability'] }} students
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-purple card-outline">
                <div class="card-header">
                    <h3 class="card-title">Session</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if($applications->isNotEmpty())
                        <canvas id="sessionStatusChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <p class="text-center text-bold">We don’t have enough data to show anything useful.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Faculty Chart -->
        <div class="col-md-6">
            <div class="card card-cyan card-outline">
                <div class="card-header">
                    <h3 class="card-title">Faculty</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if($applications->isNotEmpty())
                        <canvas id="facultyStatusChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <p class="text-center text-bold">We don’t have enough data to show anything useful.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Application Status Chart -->
        <div class="col-md-6">
            <div class="card card-navy card-outline">
                <div class="card-header">
                    <h3 class="card-title">Application Status</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if($applications->isNotEmpty())
                        <canvas id="applicationStatusChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    @else
                        <p class="text-center text-bold">We don’t have enough data to show anything useful.</p>
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
            @if($applications->isNotEmpty())
            // Faculty Chart
            const sessionChartCanvas = $('#sessionStatusChart').get(0).getContext('2d')

            const pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }

            new Chart(sessionChartCanvas, {
                type: 'pie',
                options: pieOptions,
                data: {
                    labels: {!! json_encode($sessionCount->keys()) !!},
                    datasets: [
                        {
                            data: {!! json_encode($sessionCount->values()) !!},
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                },
            });

            // Faculty Chart
            const pieChartCanvas = $('#facultyStatusChart').get(0).getContext('2d')

            new Chart(pieChartCanvas, {
                type: 'doughnut',
                options: pieOptions,
                data: {
                    labels: {!! json_encode($facultyCount->keys()) !!},
                    datasets: [
                        {
                            data: {!! json_encode($facultyCount->values()) !!},
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                },
            });

            // Application Status Chart
            const appStatusChartCanvas = $('#applicationStatusChart').get(0).getContext('2d');
            const a = new Chart(appStatusChartCanvas, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statusHolder->keys()) !!},
                    datasets: [
                        {
                            label: 'Total Application',
                            data: {!! json_encode($statusHolder->values()) !!},
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                            ],
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
