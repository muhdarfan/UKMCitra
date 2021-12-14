@extends('layouts.app')

@section('title', 'My Courses')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Citra Courses</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="myCitraTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 20%">Course Code</th>
                    <th>Course Name</th>
                    <th>Current Student</th>
                    <th style="width: 25%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($citras as $citra)
                    <tr>
                        <td class="align-middle">{{ $citra->courseCode }}</td>
                        <td class="align-middle">{{ $citra->courseName }}</td>
                        <td class="align-middle">{{ $citra->approvedApplication }} / {{ $citra->courseAvailability }}
                            ({{ $citra->pendingApplication }} pending)
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('mycitra.show', $citra->courseCode) }}"
                               class="btn bg-gradient-primary mr-1">Detail</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
