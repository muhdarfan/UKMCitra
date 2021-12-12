@extends('layouts.app')

@section('title', 'Feedback List')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Default data table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Feedback</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10%">#</th>
                    <th>Name</th>
                    <th style="width: 20%">Date</th>
                    <th style="width: 30%">Action</th>
                </tr>
                </thead>
                <tbody>
                {!! count($feedback) < 1 ? "<tr><td colspan='4'>No data to be displayed.</td></tr>" : '' !!}
                @foreach($feedback as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->author->name }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td class="text-center">
                            <form action="{{ route('feedback.destroy', $data->id) }}" method="POST">
                                <a href="{{ route('feedback.show', $data->id) }}"
                                   class="btn bg-gradient-primary">Detail</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn bg-gradient-danger"
                                        onclick="return confirm('Are you sure want to delete this feedback?');">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br/>
            {!! $feedback->withQueryString()->links() !!}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
