@extends('layouts.app')

@section('title','User Lists')
@section('content')
    <!-- Default data table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Lists</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10%">Matric No</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th style="width: 20%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->matric_no }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="text-center">
                            <form action="{{ route('user.destroy', $user->matric_no) }}" method="POST">
                                <a href="{{ route('user.show', $user->matric_no) }}" class="btn bg-gradient-primary">Detail</a>
                                <a href="{{ route('user.edit', $user->matric_no) }}"
                                   class="btn bg-gradient-warning">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn bg-gradient-danger"
                                        onclick="return confirm('Are you sure want to delete this user?');">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br/>
            {!! $users->withQueryString()->links() !!}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
