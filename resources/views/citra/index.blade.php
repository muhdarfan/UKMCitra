@extends('layouts.app')

@section('title','Citra Courses')
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
            <h3 class="card-title">Citra Courses</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10%">Course Code</th>
                    <th>Course Name</th>
                    <th>Course Credit</th>
                    <th>Course Category</th>
                    <th style="width: 20%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($citras as $citra)
                    <tr>
                        <td class="align-middle">{{ $citra->courseCode }}</td>
                        <td class="align-middle">{{ $citra->courseName }}</td>
                        <td class="align-middle">{{ $citra->courseCredit }}</td>
                        <td class="align-middle">{{ $citra->courseCategory }}</td>
                        <td class="align-middle" class="text-center">
                            <form action="{{ route('citra.destroy', $citra->courseCode) }}" method="POST">
                                <a href="{{ route('citra.show', $citra->courseCode) }}" class="btn bg-gradient-primary mr-1">Detail</a>
                                <a href="{{ route('citra.edit', $citra->courseCode) }}"
                                   class="btn bg-gradient-warning mr-1">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn bg-gradient-danger"
                                        onclick="return confirm('Are you sure want to delete this Citra?');">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br/>
            {!! $citras->withQueryString()->links() !!}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
