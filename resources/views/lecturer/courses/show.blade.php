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
        <div class="col-md-4">
            @if($pendingCount > 0)
                <button data-toggle="modal" data-target="#modal-approve" class="btn btn-block btn-success mb-2">
                    Approve
                </button>

                <form action="{{ route('mycitra.update', $citra->courseCode) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button onclick="return confirm('Are you sure want to reject all application?')" type="submit"
                            name="type" value="reject" class="btn btn-block btn-danger">Reject All
                    </button>
                </form>

                <hr/>
            @endisset

            <div class="card card-primary">
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
                        <dd>{{ $citra->registeredStudent() }}
                            / {{ $citra->courseAvailability }} students
                        </dd>
                        <dt>Course Availability</dt>
                        <dd>
                            {{ $citra->courseAvailability }} students
                        </dd>
                    </dl>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Application List</h3>
                </div>
                <!-- /.card-header -->
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
                            {!! $citra->application->count() < 1 ? '<tr><td colspan="2">No data to be displayed.</td></tr>' : '' !!}

                            @foreach($citra->application as $application)
                                <tr>
                                    <td>#{{ $application->application_id }}</td>
                                    <td><a target="_blank"
                                           href="{{ route('application.show', $application->application_id) }}">{{ $application->matric_no }}
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

                <div class="card-footer clearfix">
                    {!! $citra->application->withQueryString()->links() !!}

                    <a href="{{ route('mycitra.show', $citra->courseCode) }}"
                       class="badge badge-primary text-sm">All</a>
                    <a href="{{ route('mycitra.show', [$citra->courseCode, 'status' => 'pending']) }}"
                       class="badge badge-warning text-sm">Pending</a>
                    <a href="{{ route('mycitra.show', [$citra->courseCode, 'status' => 'approved']) }}"
                       class="badge badge-success text-sm">Approved</a>
                    <a href="{{ route('mycitra.show', [$citra->courseCode, 'status' => 'rejected']) }}"
                       class="badge badge-danger text-sm">Rejected</a>
                </div>
            </div>
        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modal-approve">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Application Approval</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="approvalForm" action="{{ route('mycitra.update', $citra->courseCode) }}" method="POST"
                          novalidate>
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="type" value="approve"/>

                        <div class="form-group row">
                            <label for="inputPending"
                                   class="col-sm-4 col-form-label">{{ __('Pending Student') }}</label>
                            <div class="col-sm-8">
                                <input id="inputPending" type="text" class="form-control-plaintext"
                                       value="{{ $pendingCount }}" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputQuota">{{ __('Amount student to accept') }}</label>
                            <input id="inputQuota" type="number" name="quota" class="form-control" min="1"
                                   max="{{ $pendingCount }}" value="1" autofocus required/>
                        </div>
                    </form>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="submitFormBtn" type="button" class="btn btn-success">Confirm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" defer
            integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.validator.setDefaults();

            $('#submitFormBtn').on('click', function () {
                $("#approvalForm").submit();
            });

            $('#modal-approve').on('show.bs.modal', function () {
                $('#inputQuota').focus();
            });

            $('#approvalForm').validate({
                rules: {
                    quota: {
                        required: true,
                        min: 1,
                        max: {{ $pendingCount }}
                    }
                },
                messages: {
                    quota: {
                        required: 'Please provide a valid number',
                        min: "Student amount must be at least 1.",
                        max: "Max student can be accepted are {{ $pendingCount }}"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $('#submitFormBtn').addClass('disabled');
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $('#submitFormBtn').removeClass('disabled');
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
