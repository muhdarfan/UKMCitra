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
                        <td class="align-middle">{{ $user->matric_no }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->role }}</td>
                        <td class="align-middle" class="text-center">
                            <form action="{{ route('users.destroy', $user->matric_no) }}" method="POST">
                                <a href="{{ route('users.show', $user->matric_no) }}" class="btn bg-gradient-primary mr-1">Detail</a>
                                <a href="{{ route('users.edit', $user->matric_no) }}"
                                   class="btn bg-gradient-warning mr-1">Edit</a>

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
