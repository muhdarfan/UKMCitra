@extends('layouts.app')

@section('title','Course Details')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Title</h3>

        <!-- Card Button (Remove if needed) -->
        
    </div>
    <div class="card-body">
        <div class="card-body">
        <img src="{{ asset('images/logo_ukm.png') }}" class="center-block d-block mx-auto" alt="Italian Trulli">
        </div>
        
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
        scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
        electronic typesetting, remaining essentially unchanged.
    </div>
    <!-- /.card-body -->
    
    <!-- /.card-footer-->
</div>
<!-- /.card -->


@endsection
