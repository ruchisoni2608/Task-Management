@extends('layouts.app')
@push('style')
    <style>
        .text-right {
            float: right;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add New Task</h2>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('manager.index') }}"> Back</a>
                    </div>
                </div>
            </div>



            <form action="{{ route('manager.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Task Name:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Task Name">
                        </div>
                    </div></br>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">


                            <div class="mb-3">
                                <strong>Assign To:</strong>
                                <select class="form-select form-select-lg" name="user_id" id="">
                                    <option selected>Select</option>
                                    @foreach ($staffuser as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
