@extends('layouts.app')

@section('title', 'Feedback #'.$feedback->id)
@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Feedback #{{ $feedback->id }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-text">
                        <dl>
                            <dt>Feedback ID</dt>
                            <dd class="bg-secondary p-2">{{ $feedback->id }}</dd>
                            <dt>Matric No.</dt>
                            <dd class="bg-secondary p-2">{{ $feedback->author->matric_no }}</dd>
                            <dt>Name</dt>
                            <dd class="bg-secondary p-2">{{ $feedback->author->name }}</dd>
                            <dt>Date</dt>
                            <dd class="bg-secondary p-2">{{ $feedback->created_at }}</dd>
                            <dt>Comments</dt>
                            <dd class="bg-secondary p-2">{{ $feedback->comment }}</dd>
                        </dl>

                        <div class="text-center">
                            <a href="{{ route('feedback.index') }}" class="btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection
