@extends('layouts.app')

@section('title','Application Detail')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{$data->courseCode}} - Student Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="" class="form-horizontal" method="POST">
            @csrf

            <div class="card-body">

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" value="{{$data->name}}" id="name"
                               placeholder="Name" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="matric" class="col-sm-2 col-form-label">Matric Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" value="{{$data->matric_no}}" id="matric"
                               placeholder="Matric Number" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="faculty" class="col-sm-2 col-form-label">Faculty</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" value="{{$data->faculty}}" id="faculty"
                               placeholder="Faculty" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" value="{{$data->phone}}" id="phone"
                               placeholder="Availability" readonly>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Extra Information</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="form-group col-md-6">
                    <label for="currentCredit">Current Credit</label>
                    <input type="number" class="form-control-plaintext" value="{{$data->credit_limit}}"
                           id="currentCredit" placeholder="Current Credit" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="creditAllow">Credit Allowed</label>
                    <input type="number" class="form-control-plaintext" value="20" id="creditAllow"
                           placeholder="Credit Allowed" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="courseName" class="col-sm-2 col-form-label">Course Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" value="{{$data->citra->courseName}}" id="phone"
                           placeholder="Couse Name" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                <div class="col-sm-10">
                    <textarea readonly class="form-control-plaintext" rows="3"
                              placeholder="Reason">{{$data->reason}}</textarea>
                </div>
            </div>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{Form::open(array('url'=>'application/update','method'=>'post','class'=>'form-login'))}}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn bg-gradient-danger float-right mr-2" name="deact" value="{{$data->application_id}}">
                Reject
            </button>
            <button class="btn bg-gradient-success float-right mr-2" name="act" value="{{$data->application_id}}">
                Approve
            </button>
            {{Form::close()}}
        </div>

        </form>
    </div>
    <!-- /.card -->
@endsection
