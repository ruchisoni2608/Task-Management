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
                    <h2>Staff Dashboard </h2>
                </div>

            </div>
        </div>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Status</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->start_time }}</td>
                    <td>{{ $task->end_time }}</td>
                    <td>
                        <button class="update-button" data-task-id="{{ $task->id }}">Update</button>
                    </td>
                </tr>
                <tr>
                    {{-- <td colspan="6">
                                <form id="update-form-{{ $task->id }}"
                    action="{{ route('staff.editTask', $task->id) }}"
                    style="display: none;">
                    <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                    <p>Update Task: {{ $task->title }}</p>
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="Pending" {{ $task->status === 'not_started' ? 'selected' : '' }}>
                            Pending</option>
                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>
                            In Progress</option>
                        <option value="Complete" {{ $task->status === 'Complete' ? 'selected' : '' }}>
                            Complete</option>
                    </select>
                    <label for="date">Date:</label>
                    <input type="date" name="date" value="{{ $task->date }}">
                    <label for="start_time">Start Time:</label>
                    <input type="datetime-local" name="start_time" value="{{ $task->start_time }}">
                    <label for="end_time">End Time:</label>
                    <input type="datetime-local" name="end_time" value="{{ $task->end_time }}"> <button
                        class="update-task-button" data-task-id="{{ $task->id }}">Update Task</button>
                    </form>
                    </td> --}}
                    <td colspan="12">

                        <form id="update-form-{{ $task->id }}" action="{{ route('admin.editstaffTask', $task->id) }}"
                            style="display: none;">
                            <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                            <div class="form-group">
                                <p><b>Update Task: {{ $task->title }}</b></p>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Pending" {{ $task->status === 'not_started' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>
                                        In Progress</option>
                                    <option value="Complete" {{ $task->status === 'Complete' ? 'selected' : '' }}>
                                        Complete</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date" class="form-label">Date:</label>
                                <input type="date" class="form-control" name="date" value="{{ $task->date }}"></br>
                            </div>
                            <div class="form-group">
                                <label for="start_time" class="form-label">Start Time:</label>
                                <input type="datetime-local" class="form-control" name="start_time"
                                    value="{{ $task->start_time }}">
                            </div>
                            <div class="form-group">
                                <label for="end_time" class="form-label">End Time:</label>
                                <input type="datetime-local" class="form-control" name="end_time"
                                    value="{{ $task->end_time }}">
                            </div> <button class="update-task-button" data-task-id="{{ $task->id }}">Update
                                Task</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
// JavaScript to toggle the update form
document.addEventListener('DOMContentLoaded', function() {
    //alert("rr");
    const updateButtons = document.querySelectorAll('.update-button');

    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log("click........ ");
            const taskId = button.getAttribute('data-task-id');
            const updateForm = document.querySelector(`#update-form-${taskId}`);

            if (updateForm.style.display === 'none' || !updateForm.style.display) {
                updateForm.style.display = 'block';
            } else {
                updateForm.style.display = 'none';
            }
        });
    });
});
</script>
@endpush