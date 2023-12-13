@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are a Admin.
                        {{ __('You are logged in!') }}
                        <!-- List group -->
                        <div class="list-group" id="myList" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#home"
                                role="tab">Home</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="{{ route('admin.taskindex') }}" role="tab">Task Allocation</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="{{ route('admin.stafftaskindex') }}" role="tab">Task Index</a>
                            {{-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#settings"
                                role="tab">Settings</a> --}}
                        </div>

                        <!-- Tab panes -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
