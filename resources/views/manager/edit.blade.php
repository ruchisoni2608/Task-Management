{{-- <h1>Edit Task</h1>
<form method="post" action="/manager/edit-task/{{ $task->id }}">
    @csrf
    @method('PUT')
    <label for="title">Task Title:</label>
    <input type="text" name="title" value="{{ $task->title }}" required>
    <label for="description">Task Description:</label>
    <textarea name="description" required>{{ $task->description }}</textarea>

    <button type="submit">Update Task</button>
</form> --}}

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

                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('manager.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            <h1>Edit Task</h1>

            <form action="{{ route('manager.editTask', $task->id) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Task Name:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Task Name"
                                value="{{ $task->title }}">
                        </div>
                    </div></br>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">


                            <div class="mb-3">
                                <strong>Assign To:</strong>
                                <select class="form-select form-select-lg" name="user_id" id="">
                                    <option selected>Select</option>
                                    @foreach ($staffuser as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $task->user_id === $value->id ? 'selected' : '' }}>{{ $value->name }}
                                        </option>
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
