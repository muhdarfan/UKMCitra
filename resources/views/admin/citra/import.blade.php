@extends('layouts.app')

@section('title','Import Course')
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
        <div class="col-md-6 col-sm-12 offset-md-3">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Import Course</h3>
                </div>
                <!-- /.card-header -->

                <form action="{{ route('citra.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputFile">File (.csv/.xlsx)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="citraFile" class="custom-file-input" id="inputFile">
                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group row">
                            <label for="courseCode" class="col-sm-4 col-form-label">Course Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ old('courseCode') ?? 'courseCode' }}"
                                       id="courseCode" name="courseCode" placeholder="Course Code"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="courseName" class="col-sm-4 col-form-label">Course Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ old('courseName') ?? 'courseName' }}"
                                       id="courseName" name="courseName" placeholder="Course Name"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="courseCredit" class="col-sm-4 col-form-label">Course Credit</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                       value="{{ old('courseCredit') ?? 'courseCredit'}}" id="courseCredit"
                                       name="courseCredit" placeholder="Course Credit"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="courseCategory" class="col-sm-4 col-form-label">Course Category</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                       value="{{ old('courseCategory') ?? 'courseCategory'}}" id="courseCategory"
                                       name="courseCategory" placeholder="Course Category"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="courseAvailability" class="col-sm-4 col-form-label">Course Availability</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                       value="{{ old('courseAvailability') ?? 'courseAvailability' }}"
                                       id="courseAvailability" name="courseAvailability"
                                       placeholder="Course Availability"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descriptions" class="col-sm-4 col-form-label">Course Description</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                       value="{{ old('descriptions') ?? 'descriptions' }}" id="descriptions"
                                       name="descriptions" placeholder="Course Description"/>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js" defer integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
