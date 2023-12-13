@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        You are a Manager User.
                        <h1>Welcome, {{ Auth::user()->name }}</h1>
                        <div class="list-group" id="myList" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="{{ route('manager.create') }}" role="tab">Task Allocation</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="{{ route('manager.index') }}" role="tab">Task Index</a>
                                
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
