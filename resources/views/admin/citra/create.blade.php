@extends('layouts.app')

@section('title','Add Course')
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
        <div class="col-md-6 col-sm-12 offset-md-3" >
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add Course</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('citra.store') }}" class="form-horizontal" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="coursecode" class="col-sm-2 col-form-label">Course Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('courseCode')}}" id="coursecode"
                                       name="courseCode" placeholder="Course Code"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coursename" class="col-sm-2 col-form-label">Course Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('courseName') }}" id="coursename"
                                       name="courseName" placeholder="Course Name"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coursecredit" class="col-sm-2 col-form-label">Course Credit</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" max='3' class="form-control"
                                       value="{{ old('courseCredit') }}" id="coursecredit"
                                       name="courseCredit" placeholder="Course Credit"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="coursecategory" class="col-sm-2 col-form-label">Course Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="coursecategory" name="courseCategory">
                                    <option value="C1" @if(old("courseCategory")=='C1')? selected : null @endif>C1
                                    </option>
                                    <option value="C2" @if(old("courseCategory")=='C2')? selected : null @endif
                                    >C2</option>
                                    <option value="C3" @if(old("courseCategory")=='C3')? selected : null @endif
                                    >C3</option>
                                    <option value="C4" @if(old("courseCategory")=='C4')? selected : null @endif
                                    >C4</option>
                                    <option value="C5" @if(old("courseCategory")=='C5')? selected : null @endif
                                    >C5</option>
                                    <option value="C6" @if(old("courseCategory")=='C6')? selected : null @endif
                                    >C6</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="availability" class="col-sm-2 col-form-label">Availability</label>
                            <div class="col-sm-10">
                                <input name="courseAvailability" type="number" min="0" class="form-control" id="availability"
                                       value="{{ old('courseAvailability') }}" placeholder="Availability"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                        <textarea id="description" name="descriptions" class="form-control" rows="3"
                                  placeholder="Course Description">{{ old('descriptions') }}</textarea>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('citra.index') }}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Add</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
