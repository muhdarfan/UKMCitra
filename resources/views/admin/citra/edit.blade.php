@extends('layouts.app')

@section('title','Manage Course')
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8 col-sm-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Manage Course</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('citra.update', $citra->courseCode) }}" class="form-horizontal" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="coursecode" class="col-sm-2 col-form-label">Course Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" value="{{ $citra->courseCode }}" id="coursecode"
                                       name="courseCode" placeholder="Course Code" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coursename" class="col-sm-2 col-form-label">Course Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $citra->courseName }}" id="coursename"
                                       name="courseName" placeholder="Course Name"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coursecredit" class="col-sm-2 col-form-label">Course Credit</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" max='3' class="form-control"
                                       value="{{ $citra->courseCredit }}" id="coursecredit"
                                       name="courseCredit" placeholder="Course Credit"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="coursecategory" class="col-sm-2 col-form-label">Course Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="coursecategory" name="courseCategory">
                                    <option value="C1" @if($citra->courseCategory=='C1')? selected : null @endif>C1
                                    </option>
                                    <option value="C2" @if($citra->courseCategory=='C2')? selected : null @endif
                                    ">C2</option>
                                    <option value="C3" @if($citra->courseCategory=='C3')? selected : null @endif
                                    ">C3</option>
                                    <option value="C4" @if($citra->courseCategory=='C4')? selected : null @endif
                                    ">C4</option>
                                    <option value="C5" @if($citra->courseCategory=='C5')? selected : null @endif
                                    ">C5</option>
                                    <option value="C6" @if($citra->courseCategory=='C6')? selected : null @endif
                                    ">C6</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="availability" class="col-sm-2 col-form-label">Availability</label>
                            <div class="col-sm-10">
                                <input name="courseAvailability" type="number" min="0" class="form-control" id="availability"
                                       value="{{ $citra->courseAvailability }}" placeholder="Availability"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                        <textarea id="description" name="descriptions" class="form-control" rows="3"
                                  placeholder="Course Description">{{ $citra->descriptions }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="studentcount" class="col-sm-2 col-form-label">Current Student</label>
                            <div class="col-sm-10">

                                <input type="number" class="form-control-plaintext" value="{{$current}}" id="current"
                                placeholder="Current" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('citra.index') }}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info float-right">Update</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>

        <!-- Right column -->
        <div class="col-md-4 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Assign Lecturer</h3>
                </div>

                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="form-group">
                            <label for="inputLecturerDetail">Name / Matric No.</label>
                            <input id="inputLecturerDetail" type="text" class="form-control" name="lecturerDetail"/>
                        </div>
                    </div>

                    <table id="resultTable" class="table table-sm d-none">
                        <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th>Lecturer Detail</th>
                            <th style="width: 30%;">Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <form id="assignForm" action="{{ route('citra.lecturer.store', $citra->courseCode) }}"
                          method="POST">
                        @csrf
                        <input type="hidden" id="matric_no" name="matric_no">
                    </form>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Lecturer</h3>
                </div>
                <div class="card-body">

                    <div class="list-group">
                        {{ count($citra->lecturers) < 1 ? "No data to be displayed." : '' }}

                        @foreach($citra->lecturers as $lecturer)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="img-fluid" src="https://gambarpel.ukm.my/images/A174652.jpg"
                                             alt="Photo"
                                             style="max-height: 70px;"/>
                                    </div>
                                    <div class="col px-4">
                                        <p>{{ $lecturer->name }} ({{ $lecturer->matric_no }})</p>
                                        <form
                                            action="{{ route('citra.lecturer.destroy', [$citra->courseCode, $lecturer->matric_no]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('users.show', $lecturer->matric_no) }}"
                                               class="btn btn-outline-primary mr-3"><i
                                                    class="icon fas fa-info"></i></a>
                                            <button
                                                onclick="return confirm('Are you sure want to delete this lecturer ({{ $lecturer->matric_no }}) from Citra ({{ $citra->courseCode }}) ?');"
                                                type="submit" class="btn btn-outline-danger" href="#"><i
                                                    class="icon fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).on('click', '#btn-assign', function (e) {
            e.preventDefault();

            const id = $(this).data('matric');

            if (id !== '') {
                $("#matric_no").val(id);
                $("#assignForm").submit();
            }
        });

        $("#inputLecturerDetail").on('keyup', function () {
            search();
        });

        function search() {
            var keyword = $("#inputLecturerDetail").val();

            if (keyword.length > 1) {
                if ($("#resultTable").hasClass('d-none')) {
                    $("#resultTable").removeClass('d-none');
                }

                $.ajax({
                    url: "{{ route('ajax.find_lecturer') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        search: keyword,
                        courseCode: '{{ $citra->courseCode }}'
                    },
                    success: function (data) {
                        table_post_row(data);
                    },
                    error: function (xhr, status, error) {

                    }
                })
            } else {
                if (!$("#resultTable").hasClass('d-none')) {
                    $("#resultTable").addClass('d-none');
                }
            }
        }

        function table_post_row(res) {
            let htmlView = '';

            if (res.length < 1) {
                htmlView = `<tr><td colspan="3">No data.</td></tr>`;
            }

            for (let i = 0; i < res.length; i++) {

                htmlView += `<tr><td>${i + 1}</td><td>${res[i].matric_no} - ${res[i].name}</td>`;

                if (res[i].courseCode === null) {
                    htmlView += `<td><button id="btn-assign" data-matric="${res[i].matric_no}" class="btn btn-primary btn-sm">Assign</button></td>`;
                } else {
                    htmlView += `<td><button class="btn btn-default disabled btn-sm">Assigned</button></td>`;
                }

                htmlView += '</tr>';
            }

            $('#resultTable tbody').html(htmlView);
        }
    </script>
@endpush
