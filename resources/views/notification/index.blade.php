@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Notifications</h1>
        </div>

        <hr>

        
        <div class="card h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>
                                        <a href="{{ $notification->data['url'] }}">
                                            {{ $notification->data['message'] }}
                                        </a>
                                    </td>
                                    <td>
                                        <span title="{{ $notification->created_at->format('d/m/Y H:i') }}">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $notifications->links() !!}
            </div>
        </div>
    </div>

@endsection