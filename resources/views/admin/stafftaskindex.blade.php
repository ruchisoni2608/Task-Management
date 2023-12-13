  @php
      use Carbon\Carbon;

  @endphp
  @extends('layouts.app')
  @inject('carbon', 'Carbon\Carbon')
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
                          <h2> Staff Task Index </h2>
                      </div>
                      <div class="text-right">
                          <a class="btn btn-success" href="{{ route('home') }}"> Back</a>
                      </div></br>
                  </div>
              </div>



              <table class="table table-bordered">
                  <tr>
                      <th>No</th>
                      <th>Task Name</th>
                      <th>Assign To</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Time Taken</th>
                      <th width="280px">Action</th>
                  </tr>


                  <?php $no = 1; ?>
                  @foreach ($tasks as $task)
                      <tr>
                          <td>{{ $no++ }}</td>
                          {{-- <td>{{ $task->id }}</td> --}}
                          <td>{{ $task->title }}</td>
                          <td>{{ $task->user->name }}</td>
                          <td>{{ $task->status }}</td>
                          <td>{{ $task->date }}</td>
                          <td>
                              @foreach ($timetaken as $time)
                                  @if ($time->task_id == $task->id)
                                      <ul>

                                          <li>{{ $time->time_taken }}</li>
                                      </ul>
                                  @endif
                              @endforeach

                              {{-- <ul>

                                  @if ($startTimesByTask->has($task->id))
                                      @foreach ($startTimesByTask[$task->id] as $time)
                                          <li>
                                              Start Time: {{ $time->start_time }}<br>
                                              End Time: {{ $time->end_time }}<br>
                                              Time Taken: {{ $time->time_taken }}<br>
                                          </li>
                                      @endforeach
                                  @endif

                              </ul> --}}
                          </td>
                          {{-- @foreach ($timetaken as $time)
                                  @if ($time->task_id == $task->id)
                                      <ul>
                                          <li>{{ $time->end_time }}</li>
                                          <li>{{ $time->start_time }} ={{ $time->time_taken }}</li>
                                      </ul>
                                  @endif                        
                  @endforeach --}}

                          <td>
                              <button class="update-button" data-task-id="{{ $task->id }}">Update</button>
                              <form action="{{ route('admin.deletestaffTask', $task->id) }}" method="POST">
                                  {{-- <a class="update-button btn btn-primary" data-task-id="{{ $task->id }}">Edit</a>                                --}}
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit"
                                      onclick="return confirm('Are you sure you want to delete this task?')"class="btn btn-danger">Delete
                                      Task</button>
                              </form>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="12">

                              <form id="update-form-{{ $task->id }}"
                                  action="{{ route('admin.editstaffTask', $task->id) }}" style="display: none;">
                                  <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                                  <div class="form-group">
                                      <p><b>Update Task: {{ $task->title }}</b></p>
                                  </div>
                                  <div class="form-group">
                                      <label for="status" class="form-label">Status:</label>
                                      <select name="status" id="status" class="form-select">
                                          <option value="Pending" {{ $task->status === 'not_started' ? 'selected' : '' }}>
                                              Pending</option>
                                          <option value="in_progress"
                                              {{ $task->status === 'in_progress' ? 'selected' : '' }}>
                                              In Progress</option>
                                          <option value="Complete" {{ $task->status === 'Complete' ? 'selected' : '' }}>
                                              Complete</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="date" class="form-label">Date:</label>
                                      <input type="date" class="form-control" name="date"
                                          value="{{ $task->date }}"></br>
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
