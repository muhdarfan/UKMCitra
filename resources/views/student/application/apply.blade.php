@extends('layouts.app-basic', ['title' => 'Apply Citra Course'])

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card card-cyan">
                <div class="card-header">
                    <h3 class="card-title">Information</h3>
                </div>

                <div class="card-body">
                    <h4>Course Information</h4>

                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" readonly class="form-control-plaintext" id="inputName" placeholder="Enter name" value="{{ auth()->user()->name }}">
                    </div>

                    <h4>My Information</h4>

                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" readonly class="form-control-plaintext" id="inputName" placeholder="Enter name" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="form-group">
                        <label for="inputReason">Reason</label>
                        <textarea class="form-control" id="inputReason" placeholder="Reason" rows="3"></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
