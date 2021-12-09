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
                        <input type="text" class="form-control" value="{{ $citra->courseCode }}" id="coursecode"
                               name="courseCode" placeholder="Course Code"/>
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
                        <input type="number" min="1" max='3' class="form-control" value="{{ $citra->courseCredit }}" id="coursecredit"
                               name="courseCredit" placeholder="Course Credit" />
                    </div>
                </div>


                <div class="form-group row">
                    <label for="coursecategory" class="col-sm-2 col-form-label">Course Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="coursecategory" name="courseCategory">
                            <option value = "C1" @if($citra->courseCategory=='C1')? selected : null @endif>C1</option>
                            <option value = "C2" @if($citra->courseCategory=='C2')? selected : null @endif">C2</option>
                            <option value = "C3" @if($citra->courseCategory=='C3')? selected : null @endif">C3</option>
                            <option value = "C4" @if($citra->courseCategory=='C4')? selected : null @endif">C4</option>
                            <option value = "C5" @if($citra->courseCategory=='C5')? selected : null @endif">C5</option>
                            <option value = "C6" @if($citra->courseCategory=='C6')? selected : null @endif">C6</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="availability" class="col-sm-2 col-form-label">Availability</label>
                    <div class="col-sm-10">
                        <input name="availability" type="number" min="1" class="form-control" id="availability"
                               placeholder="Availability"/>
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


@endsection
