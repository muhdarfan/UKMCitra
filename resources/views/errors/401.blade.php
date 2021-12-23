@extends('layouts.app-basic', ['title' => '401 Error Page'])

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 401</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Not Authorized.</h3>

            <p>
                You are not authorized to view the page that you are looking for.
                Meanwhile, you may <a href="{{ route('dashboard') }}">return to dashboard</a>.
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
@endsection
