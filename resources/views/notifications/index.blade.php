@extends('layouts.app')
@push('style')
    <style>
        .notification-icon {
            position: relative;
            cursor: pointer;
        }

        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
        }

        .notification-icon:hover .notification-dropdown {
            display: block;
        }
    </style>
@endpush
@section('content')
    <div class="notification-dropdown">
        <ul>
            @foreach ($notifications as $notification)
                <li>
                    <a href="{{ route('notifications.mark-as-read', $notification->id) }}">
                        <strong>{{ $notification->task->title }}</strong>: {{ $notification->message }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
