@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div>
            <h1>Dashboard</h1>
            
            You are logged in from 
            {{ $location['region_name'] ?: '(unknown)' }}, 
            {{ $location['country_name'] ?: '(unknown)' }}
            ({{ $location['ip'] }})
        </div>

        <hr>

        <div class="row justify-content-center mt-4">
            <div class="col col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Recent Posts') }}</div>

                    <div class="card-body">
                        @if ($posts->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Created</th>
                                            <th>Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('post.view', $post->id) }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span title="{{ $post->created_at->format('d/m/Y H:i') }}">
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $post->user->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted text-center py-4">
                                There are no recent posts
                            </p>
                        @endif
                        
                        <div class="text-center">
                            <a href="{{ route('posts') }}" class="btn btn-primary">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Notifications') }}</div>

                    <div class="card-body">
                        @if ($notifications->isNotEmpty())
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
                        @else
                            <p class="text-muted text-center py-4">
                                You have no unread notifications.
                            </p>
                        @endif

                        <div class="text-center">
                            <a href="{{ route('notifications') }}" class="btn btn-primary">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
