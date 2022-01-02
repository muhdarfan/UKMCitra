@extends('layouts.app-basic', ['title' => 'Application Status'])

@section('content')

  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Set</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td>LMCR2482</td>
              <td>ASAS REKA BENTUK GRAFIK</td>
              <td>1</td>
              <td><span class="tag tag-success">Approved</span></td>
              <td>View</td>
            </tr>
          </tbody>
        </table>
    </div>
@endsection
