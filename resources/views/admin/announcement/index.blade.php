@extends('layouts.app')

@section('title', 'Announcements')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if ($message = Session::get('message'))
                <div class="alert alert-{{ $message['type'] ?? 'danger' }} alert-dismissible fade show" role="alert">
                    <h5><i class="icon fas fa-check"></i> {{ $message['type'] == 'success' ? 'Success' : 'Error' }}!
                    </h5>
                    <p>{!! $message['text'] !!}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="card-title">Announcements</div>
                    <div class="card-tools">
                        <a href="{{ route('announcement.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 2%">#</th>
                                <th style="width: 50%">Content</th>
                                <th style="width: 20%">Author</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $announcements->isEmpty() ? '<tr><td colspan="4">No data to be displayed.</td></tr>' : '' !!}

                            @foreach($announcements as $announcement)
                                <tr {{ $announcement->featured === '1' ? 'class=table-primary' : '' }}>
                                    <td>{{ $announcement->id }}</td>
                                    <td>{{ $announcement->message }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $announcement->author_id) }}" target="_blank"
                                           data-toggle="tooltip" title="{{ $announcement->author->name }}">
                                            {{ $announcement->author_id }}
                                        </a>
                                    </td>
                                    <td class="align-middle text-center">
                                        <form id="deleteForm"
                                              action="{{ route('announcement.destroy', $announcement->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            @if($announcement->featured === '1')
                                                <a href="{{ route('announcement.feature', $announcement->id) }}"
                                                   onclick="return confirm('Are you sure want to remove this announcement from being featured?');"
                                                   type="button" class="btn btn-info"><i class="far fa-star"></i></a>
                                            @else
                                                <a href="{{ route('announcement.feature', $announcement->id) }}"
                                                   onclick="return confirm('Are you sure want to feature this announcement?');"
                                                   type="button" class="btn btn-primary"><i class="fas fa-star"></i></a>
                                            @endif

                                            <a href="{{ route('announcement.show', $announcement->id) }}" type="button"
                                               class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <button type="submit" class="btn bg-gradient-danger"
                                                    onclick="return confirm('Are you sure want to delete this announcement?');">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($announcements->hasPages())
                    <div class="card-footer clearfix">
                        {!! $announcements->withQueryString()->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
