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


    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('citra.create') }}" class="btn btn-app bg-gradient-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    <a class="btn btn-app bg-gradient-warning">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-danger">
                                Not Ready
                            </div>
                        </div>
                        <i class="fas fa-cloud-upload-alt"></i> Import
                    </a>
                    <a href="{{ route('citra.export') }}" class="btn btn-app bg-gradient-info">
                        <i class="fas fa-cloud-download-alt"></i> Export
                    </a>
                </div>

                <div class="form-group">
                    <label>Search:</label>
                    <form method="GET" action="{{ route('citra.index') }}">
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
                        <a href="{{ route('citra.index', ['category' => 'C1']) }}" class="list-group-item {{ Request::input('category') === 'C1' ? 'active' : '' }}">C1 <span
                                class="float-right badge badge-light round">{{ $citraCategory['C1']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citra.index', ['category' => 'C2']) }}" class="list-group-item {{ Request::input('category') === 'C2' ? 'active' : '' }}">C2 <span
                                class="float-right badge badge-light round">{{ $citraCategory['C2']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citra.index', ['category' => 'C3']) }}" class="list-group-item {{ Request::input('category') === 'C3' ? 'active' : '' }}">C3 <span
                                class="float-right badge badge-light round">{{ $citraCategory['C3']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citra.index', ['category' => 'C4']) }}" class="list-group-item {{ Request::input('category') === 'C4' ? 'active' : '' }}">C4 <span
                                class="float-right badge badge-light round">{{ $citraCategory['C4']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citra.index', ['category' => 'C5']) }}" class="list-group-item {{ Request::input('category') === 'C5' ? 'active' : '' }}">C5 <span
                                class="float-right badge badge-light round">{{ $citraCategory['C5']->cnt ?? 0 }}</span>
                        </a>
                        <a href="{{ route('citra.index', ['category' => 'C6']) }}" class="list-group-item {{ Request::input('category') === 'C6' ? 'active' : '' }}">C6 <span
                                class="float-right badge badge-light round">{{ $citraCategory['C6']->cnt ?? 0 }}</span>
                        </a>
                    </div>
                </div>

                @if(Request::collect()->count() > 0)
                    <a href="{{ route('citra.index') }}">Reset</a>
                @endif
            </div>
        </div>

        <div class="col-md-9">
            <!-- Default data table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Citra Courses</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10%">Course Code</th>
                                <th>Course Name</th>
                                <th>Course Credit</th>
                                <th>Course Category</th>
                                <th>Total Application</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{ count($citras) < 1 ? "No data to be displayed." : '' }}
                            @foreach($citras as $citra)
                                <tr>
                                    <td class="align-middle">{{ $citra->courseCode }}</td>
                                    <td class="align-middle">{{ $citra->courseName }}</td>
                                    <td class="align-middle">{{ $citra->courseCredit }}</td>
                                    <td class="align-middle">{{ $citra->courseCategory }}</td>
                                    <td class="align-middle">{{ $citra->application_count }}</td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('citra.destroy', $citra->courseCode) }}" method="POST">
                                            <a href="{{ route('citra.show', $citra->courseCode) }}"
                                               class="btn bg-gradient-primary mr-1">Detail</a>
                                            <a href="{{ route('citra.edit', $citra->courseCode) }}"
                                               class="btn bg-gradient-warning mr-1">Edit</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn bg-gradient-danger"
                                                    onclick="return confirm('Are you sure want to delete this Citra?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br/>
                    {!! $citras->withQueryString()->links() !!}
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
