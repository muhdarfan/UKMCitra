@extends('layouts.app')

@section('title', 'Create Announcement')
@section('content')
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-6 col-sm-12 offset-md-3">
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Announcement Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('announcement.store') }}" class="form-horizontal" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="message" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-sm-10">
                                <textarea id="message" name="message"
                                          class="form-control form-control-border @error('message') is-invalid @enderror"
                                          rows="3"
                                          placeholder="Course Description">{{ old('message') }}</textarea>

                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputFeatured" class="col-sm-2 col-form-label">Featured</label>
                            <div class="col-sm-10">
                                <select class="custom-select form-control-border @error('featured') is-invalid @enderror" name="featured" id="inputFeatured">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>

                                @error('featured')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('announcement.index') }}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Add</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
