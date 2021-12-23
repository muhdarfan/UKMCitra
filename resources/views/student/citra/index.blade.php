@extends('layouts.app-basic', ['title' => 'Citra Courses'])
@section('content')
    @if ($data = Session::get('data'))
        <div class="alert alert-{{ $data['type'] ?? 'error' }} alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <p>{{ $data['message'] ?? 'SERVER ERROR' }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif


    <!-- Default data table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Citra Courses</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 12%">Course Code</th>
                    <th>Course Name</th>
                    <th>Course Credit</th>
                    <th>Course Category</th>
                    <th style="width:10%">Registered</th>
                    <th style="width: 20%">Action</th>
                </tr>
                </thead>
                <tbody>
                {{ count($citras) < 1 ? 'No data to be displayed.' : '' }}
                @foreach ($citras as $citra)
                    <tr>
                        <td class="align-middle">{{ $citra->courseCode }}</td>
                        <td class="align-middle">{{ $citra->courseName }}</td>
                        <td class="align-middle">{{ $citra->courseCredit }}</td>
                        <td class="align-middle">{{ $citra->courseCategory }}</td>
                        <td class="align-middle text-center">{{ $citra->application->where('status', 'approved')->count() }}
                            /{{ $citra->courseAvailability }}</td>
                        <td class="align-middle" class="text-center">
                            <a href="{{ route('citras.show', $citra->courseCode) }}"
                               class="btn btn-sm bg-gradient-primary">Detail</a>

                            @if($citra->application->contains('matric_no', auth()->user()->matric_no))
                                <a href="{{ route('myApplication.show', $citra->application->where('matric_no', auth()->user()->matric_no)->first()->application_id) }}"
                                   target="_blank" class="btn btn-sm bg-gradient-info">View Application</a>
                            @else
                                <button type="button" data-toggle="modal" data-target="#modal-register"
                                        data-register="{{ $citra->isAvailable() ? 1 : 0 }}"
                                        data-course="{{ base64_encode(collect($citra)->except(['application', 'descriptions', 'created_at', 'updated_at'])->toJson()) }}"
                                        class="btn btn-sm bg-gradient-success">Register
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br/>
            {!! $citras->withQueryString()->links() !!}
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modal-register">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register Citra Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-register" action="{{ route('myApplication.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="courseCode"/>

                        <div class="form-group">
                            <label for="inputCourseName">{{ __('Student Name') }}</label>
                            <input type="text" class="form-control-plaintext" value="{{ auth()->user()->name }}"
                                   readonly/>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseName">{{ __('Faculty') }}</label>
                            <input type="text" class="form-control-plaintext"
                                   value="{{ auth()->user()->studentInfo->faculty }}" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseName">Course Name</label>
                            <input type="text" class="form-control-plaintext" id="inputCourseName" readonly/>
                        </div>

                        <div class="form-row">
                            <div class="col-6">
                                <label for="inputCourseName">Course Category</label>
                                <input type="text" class="form-control-plaintext" id="inputCourseCategory" readonly/>
                            </div>

                            <div class="col-6">
                                <label for="inputCourseName">Course Credit</label>
                                <div class="input-group">
                                    <input type="text" class="form-control-plaintext" id="inputCourseCredit" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">/</span>
                                        <span
                                            class="input-group-text">{{ auth()->user()->studentInfo->credit_limit }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-input-reason d-none">
                            <label for="inputReason">Reason</label>
                            <textarea class="form-control" id="inputReason" name="reason" style="resize: none"
                                      rows="3" required></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="event.preventDefault();document.getElementById('form-register').submit();"
                            type="button" class="btn btn-success">Confirm
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal-register').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget) // Button that triggered the modal
                const available = button.data('register');
                const courseInfoData = button.data('course') // Extract info from data-* attributes
                const courseInfo = $.parseJSON(atob(courseInfoData));

                const modal = $(this)

                if (available === 0) {
                    modal.find('.modal-body .form-input-reason').removeClass('d-none');
                }

                modal.find('.modal-title').text(`Register ${courseInfo.courseCode} ${courseInfo.courseName}`)
                modal.find('.modal-body input#inputCourseName').val(`${courseInfo.courseCode} ${courseInfo.courseName}`)
                modal.find('.modal-body input#inputCourseCategory').val(courseInfo.courseCategory)
                modal.find('.modal-body input#inputCourseCredit').val(`${courseInfo.courseCredit}`)
                modal.find('.modal-body input[name=courseCode]').val(courseInfo.courseCode)
            });

            $("#modal-register").on('hidden.bs.modal', function (event) {
                const modal = $(this)

                modal.find('.modal-body .form-input-reason').addClass('d-none');
            });
        });
    </script>
@endpush
