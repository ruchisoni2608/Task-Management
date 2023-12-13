@extends('staff.app')
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
                        <h2>Task</h2>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('staff.index') }}"> Back</a>
                    </div>
                </div>
            </div>



            <form action="{{ route('staff.store') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ $id }}">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Task Name:</strong>
                            <input type="text" name="task_id" class="form-control" value="{{ $stafftaskn }}">
                        </div>
                    </div></br>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <div class="mb-3">
                                <strong>Status:</strong></br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Complete" name="status">
                                    <label class="form-check-label" for="">Complete</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Pending" name="status">
                                    <label class="form-check-label" for="">Pending</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="In Process" name="status">
                                    <label class="form-check-label" for="">In Process</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="date">Date </label>
                            <input type="date" class="form-control" name="date">

                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="time">Start time </label>
                            <input type="time" class="form-control" name="starttime">

                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="time">End Time </label>
                            <input type="time" class="form-control" name="endtime">

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
