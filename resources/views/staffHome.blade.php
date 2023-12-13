@extends('staff.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }} </div>

                    <div class="card-body">
                        You are a Staff User.
                        <h1>Welcome, {{ Auth::user()->name }}</h1>
                        <div class="list-group" id="myList" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="{{ route('staff.index') }}" role="tab">Task Index</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
