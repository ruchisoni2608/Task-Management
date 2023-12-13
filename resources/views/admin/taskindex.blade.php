@extends('layouts.app')
@push('style')
    <style>
        .text-right {
            float: right;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Task Dashboard </h2>
                    </div>
                    <div class="pull-left">
                        <a class="btn btn-success" href="{{ route('admin.create') }}"> Create New Task</a>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
                    </div></br>
                </div>
            </div>


            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Task Name</th>
                    <th>Assign To</th>
                    <th width="280px">Action</th>
                </tr>
                <?php $i = 0; ?>
                @foreach ($tasks as $value)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>
                            <form action="{{ route('admin.deleteTask', $value->id) }}" method="POST">


                                <a class="btn btn-primary" href="{{ route('admin.edit', $value->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this task?')"class="btn btn-danger">Delete
                                    Task</button>

                            </form>
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
