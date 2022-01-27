@extends('layouts.app-basic', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        @if(isset($announcement))
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Announcement:</h5>
                    {{ $announcement->message }}
                </div>
            </div>
        @endif

        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Welcome back, <strong>{{ auth()->user()->name }}</strong>!</h5>

                            <p class="card-text text-justify">
                                Here you can see the academic reports for your Citra
                                courses, recent application and courses recommendation. Our course recommendation system
                                are based on your current semester and program, thus compare it with the same program
                                and semester of the last session.
                            </p>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Your application</span>
                            <span
                                class="info-box-number text-center text-muted mb-0">{{ $applications->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Approved Application</span>
                            <span
                                class="info-box-number text-center text-muted mb-0">{{ $applications->where('status', 'approved')->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Rejected Application</span>
                            <span
                                class="info-box-number text-center text-muted mb-0">{{ $applications->where('status', 'rejected')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-2">Recommended Courses For You...</h5>
                    <div class="text-center citra-legends">
                        <ul>
                            <li class="badge bg-primary text-md" data-toggle="tooltip" data-placement="top"
                                title="Literasi Bahasa dan Komunikasi">Citra 1
                            </li>
                            <li class="badge bg-maroon text-md" data-toggle="tooltip" data-placement="top"
                                title="Citra Bahasa, Komunikasi & Literasi">Citra 2
                            </li>
                            <li class="badge bg-olive text-md" data-toggle="tooltip" data-placement="top"
                                title="Citra Kuantitatif & Kualitatif">Citra 3
                            </li>
                            <li class="badge bg-purple text-md" data-toggle="tooltip" data-placement="top"
                                title="Citra Kepimpinan, Keusahawanan & Inovasi">Citra 4
                            </li>
                            <li class="badge bg-orange text-md" data-toggle="tooltip" data-placement="top"
                                title="Citra Sains, Teknologi dan Kelestarian">Citra 5
                            </li>
                            <li class="badge bg-lightblue text-md" data-toggle="tooltip" data-placement="top"
                                title="Kekeluargaan, Kesihatan dan Gaya Hidup">Citra 6
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-center flex-wrap results-body"></div>

                </div>
            </div>

        </div>

        <div class="col-md-4">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-th-large"></i>
                        Recent application (Session {{ config('app.semester') }}/{{ config('app.session') }})
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 1%;">#</th>
                                <th>Subject</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $applications->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                            @foreach($applications->take(5) as $application)
                                <tr>
                                    <td>
                                        <a target="_blank"
                                           href="{{ route('myApplication.show', $application->application_id) }}">#{{ $application->application_id }}</a>
                                    </td>
                                    <td>
                                        <strong>{{ $application->courseCode }}</strong> {{ $application->course->courseName }}
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
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .citra-legends {
            display: none;
        }

        .results-body > div {
            text-align: center;

            width: calc((100% / 2) - 10px);
            height: 100px !important;
            margin: 5px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ config('constant.API_AI_URL') }}/api/getrecommendation',
                method: "POST",
                data: {
                    matric_no: '{!! auth()->user()->matric_no !!}',
                    program: '{!! auth()->user()->studentInfo->program_code !!}',
                    semester: '{!! config('app.semester') !!}',
                    session: '{!! config('app.session') !!}',
                },
                beforeSend() {
                    $('.results-body').html('Loading ...');
                },
                success: function (data) {
                    $('.results-body').html('');

                    if (data.data) {
                        const courses = data.data;
                        let url = '{{ route('citras.show', ':id') }}';

                        if (courses.length > 0) {
                            $(courses).each(function (idx, item) {
                                $.get(`{{ url('api/citra') }}?citra=${item['courseCode']}`, function (val) {
                                    let temp1 = 'dark';

                                    if (val.courseCategory == 'C1') {
                                        temp1 = 'primary';
                                    } else if (val.courseCategory == 'C2') {
                                        temp1 = 'maroon';
                                    } else if (val.courseCategory == 'C3') {
                                        temp1 = 'olive';
                                    } else if (val.courseCategory == 'C4') {
                                        temp1 = 'purple';
                                    } else if (val.courseCategory == 'C5') {
                                        temp1 = 'orange';
                                    } else if (val.courseCategory == 'C6') {
                                        temp1 = 'lightblue';
                                    }

                                    $('.results-body').append(`<div class='card card-${temp1} card-outline'><div class='card-body text-center'><a href='${url.replace(':id', item.courseCode)}' target="_blank"><strong>${item.courseCode}</strong></a> <span class="right badge bg-${temp1}">${val.courseCategory}</span><br/><span class='d-inline-block text-truncate' style='max-width: 100%;'>${val.courseName}</span></div></div>`);
                                });

                                $(".citra-legends").fadeIn("slow");
                            });
                        } else {
                            $('.results-body').html('Sorry, but there are no enough data to be processed.');
                        }
                    } else {
                        $('.results-body').html('An error has been occurred! Please contact administrator.');
                    }
                },
                error: function (xhr, status, error) {
                    alert('AJAX Error! Please contact administrator.');
                },
            });
        });
    </script>
@endpush
