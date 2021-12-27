@extends('layouts.app')

@section('title','User Lists')
@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="sticky-top mb-3">
                <div class="form-group">
                    <label>Search:</label>
                    <form method="GET" action="{{ route('users.index') }}">
                        <div class="input-group">
                            <input id="inputSearch" name="search" type="text" class="form-control"
                                   value="{{ Request::input('search') }}" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                            <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                    </form>
                </div>
                <hr/>

                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('users.index', ['role' => 'student']) }}"
                           class="list-group-item {{ Request::input('role') === 'student' ? 'active' : '' }}">Student
                            <span class="float-right badge badge-light round">{{ $userRoles['student']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('users.index', ['role' => 'lecturer']) }}"
                           class="list-group-item {{ Request::input('role') === 'lecturer' ? 'active' : '' }}">Lecturer
                            <span class="float-right badge badge-light round">{{ $userRoles['lecturer']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('users.index', ['role' => 'admin']) }}"
                           class="list-group-item {{ Request::input('role') === 'admin' ? 'active' : '' }}">Admin
                            <span class="float-right badge badge-light round">{{ $userRoles['admin']->cnt ?? 0 }}</span>
                        </a>
                    </div>
                </div>

                @if(Request::collect()->count() > 0)
                    <a href="{{ route('users.index') }}">Reset</a>
                @endif
            </div>
        </div>

        <div class="col-md-10">
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
                            <th style="width: 10%;">Role</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="align-middle">{{ $user->matric_no }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">
                                    @if($user->role === 'student')
                                        <span class="badge badge-primary">Student</span>
                                    @elseif($user->role === 'lecturer')
                                        <span class="badge badge-info">Lecturer</span>
                                    @elseif($user->role === 'admin')
                                        <span class="badge badge-danger">Admin</span>
                                    @endif
                                </td>
                                <td class="align-middle" class="text-center">
                                    <a href="{{ route('users.show', $user->matric_no) }}"
                                       class="btn bg-gradient-primary mr-1">Detail</a>
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
        </div>
    </div>
@endsection
