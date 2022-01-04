@extends('layouts.app-basic', ['title' => 'Application Information'])

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-text-width"></i>
      Application Information
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <dl class="row">
      <dt class="col-sm-4">Course Code</dt>
      <dd class="col-sm-8">LMCR2482</dd>
      <dt class="col-sm-4">Course Name</dt>
      <dd class="col-sm-8">ASAS REKA BENTUK GRAFIK</dd>
      <dt class="col-sm-4">Set</dt>
      <dd class="col-sm-8">1</dd>
      <dt class="col-sm-4">Reason</dt>
      <dd class="col-sm-8">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
        sit amet risus.
      </dd>
    </dl>
  </div>
  <!-- /.card-body -->
</div>

@endsection