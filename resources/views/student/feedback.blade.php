@extends('layouts.app-basic', ['title' => 'Feedback'])

@section('content')

    <div class="row">
        <div class="col-10 offset-1">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title">Feedback</h5>

                    <form action="{{ route('user_feedback_store') }}" method="POST">
                        <div class="card-text p-3">
                            @csrf

                            <div class="form-group">
                                <label for="inputFeedback">Feedback</label>
                                <textarea class="form-control @error('feedback') is-invalid @enderror"
                                          id="inputFeedback" rows="4" style="max-height: 150px;" name="feedback"
                                          placeholder="Enter feedback">{{ old('feedback') }}</textarea>

                                @error('feedback')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
@endsection
