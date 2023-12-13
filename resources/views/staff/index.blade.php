@extends('staff.app')
@push('style')
    <style>
        .text-right {
            float: right;
        }

        #myInput {
            width: 26%;
            margin-left: 74%;
        }

        #pagination li {
            margin: 0 5px;

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

            <input id="myInput" type="search" class="form-control form-control-sm" placeholder="Search..">

            <table class="table table-bordered table-hover dt-responsive" id="myTable">

                <thead>
                    <tr>
                        <th>Task Title</th>
                        <th>Status</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Time Taken</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody id="myTable">
                    @foreach ($tasks as $task)
                        <tr>

                            <td>{{ $task->title }}</td>
                            {{-- <td>{{ $task->status }}</td> --}}
                            <td>
                                <span id="task-status-{{ $task->id }}">Pending</span>
                            </td>

                            <td>
                                <p class="start-time" id="demo1-{{ $task->id }}"></p>
                            </td>
                            <td>
                                <p class="end-time" id="demo2-{{ $task->id }}"></p>
                            </td>
                            <td>
                                <p class="total-time-taken" id="total-time-taken-{{ $task->id }}"></p>
                            </td>


                            <td> <button class="start-button btn btn-primary"
                                    data-task-id="{{ $task->id }}">Start</button>
                                <button class="end-button btn btn-danger" data-task-id="{{ $task->id }}">End</button>
                                <button class="complete-button btn btn-success"
                                    data-task-id="{{ $task->id }}">Complete</button>

                            </td>

                        </tr>
                        <tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination-container">
                <ul id="pagination" class="pagination">
                    <!-- Pagination links will be generated here -->
                </ul>
            </div>

        </div>

    </div>
    </div>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            // Determine the number of visible rows
            var visibleRows = $("#myTable tbody tr:visible").length;

            // Check if pagination should be displayed
            if (visibleRows > 0) {
                setupPagination();
            } else {
                $("#pagination-container").empty();
                showPage(1);
                $("#pagination li[data-page='prev']").addClass("disabled");
                $("#pagination li[data-page='next']").addClass("disabled");
            }
        });

        // Function to set up pagination
        function setupPagination() {
            var itemsPerPage = 10;
            var currentPage = 1;

            // Show the first page and hide the rest
            showPage(currentPage);

            // Handle pagination clicks
            $("#pagination li").on("click", function() {
                var page = $(this).data("page");
                if (page === "prev" && currentPage > 1) {
                    showPage(--currentPage);
                } else if (page === "next" && currentPage < totalPages) {
                    showPage(++currentPage);
                } else {
                    showPage(page);
                }
            });

            // Function to show a specific page
            function showPage(page) {
                var rows = $("#myTable tbody tr:visible");
                var startIndex = (page - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;

                // Hide all rows
                rows.hide();

                // Show the rows for the current page
                rows.slice(startIndex, endIndex).show();

                // Update the active state of the pagination links
                $("#pagination li").removeClass("active");
                $("#pagination li[data-page='" + page + "']").addClass("active");
            }

            // Generate pagination links
            var totalItems = $("#myTable tbody tr:visible").length;
            var totalPages = Math.ceil(totalItems / itemsPerPage);

            var paginationHtml = '<li data-page="prev"><a href="#">Previous   </a></li>';
            for (var i = 1; i <= totalPages; i++) {
                paginationHtml += '<li data-page="' + i + '"><a href="#">' + i + '</a></li>';
            }
            paginationHtml += '<li data-page="next"><a href="#">   Next</a></li>';

            $("#pagination").html(paginationHtml);
            $("#pagination li:first").addClass("active");
        }
    </script>
    <script>
        $(document).ready(function() {

            $(".end-button").hide();
            $(".complete-button").hide();

            $('.start-button').click(function() {

                var taskId = $(this).data('task-id');
                var startTimeElement = $(`.start-time#demo1-${taskId}`);
                var endTimeElement = $(`.end-time#demo2-${taskId}`);
                var status = $(`#task-status-${taskId}`);

                $.ajax({
                    url: '/startTask/' + taskId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $(".start-button[data-task-id=" + taskId + "]").hide();
                        $(".end-button[data-task-id=" + taskId + "]").prop('disabled', false);
                        $(".end-button[data-task-id=" + taskId + "]").show();
                        $(".complete-button[data-task-id=" + taskId + "]").show();
                        $(".complete-button[data-task-id=" + taskId + "]").prop('disabled',
                            false);
                        startTimeElement.show();
                        endTimeElement.show();
                        status.text('In Process');


                        var newTimestamp = new Date(response.timestamp.start_time)
                            .toLocaleString();
                        var existingContent = startTimeElement.html()
                            .trim();
                        if (existingContent === "" || existingContent.startsWith("<br>")) {
                            startTimeElement.html(newTimestamp);
                        } else {
                            var newEntry = existingContent + "<br>" + newTimestamp;
                            startTimeElement.html(newEntry);
                        }

                        status.innerHTML = response.status;
                        console.log(response.timestamp.start_time);


                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed: ' + error);
                    }
                });
            });

            $('.end-button').click(function() {
                var taskId = $(this).data('task-id');
                var startTimeElement = $(`.start-time#demo1-${taskId}`);
                var endTimeElement = $(`.end-time#demo2-${taskId}`);
                var totalTimeElement = $(`#total-time-taken-${taskId}`);


                //alert(taskId);
                $.ajax({
                    url: '/stopTask/' + taskId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        //alert(response);
                        if (response.timeTaken !== '00:00:00') {
                            // alert(response.timeTaken);

                            var existingContent = totalTimeElement.html();
                            var timeDifference = response.timeTaken;

                            if (existingContent) {
                                var newEntry = existingContent + '<br>' + timeDifference;
                            } else {
                                var newEntry = timeDifference;
                            }
                            totalTimeElement.html(newEntry);
                        } else {
                            var existingContent = totalTimeElement.html();
                            var timeDifference = "00:00:00";
                            if (existingContent) {
                                var newEntry = existingContent + '<br>' + timeDifference;
                            } else {
                                var newEntry = timeDifference;
                            }
                            totalTimeElement.html(newEntry);
                        }
                        $(".start-button[data-task-id=" + taskId + "]").show();
                        $(".end-button[data-task-id=" + taskId + "]").prop('disabled', true);
                        $(".complete-button[data-task-id=" + taskId + "]").show();
                        startTimeElement.show();
                        endTimeElement.show();


                        var row = $('[data-task-id="' + taskId + '"]');
                        var newTimestamp = new Date(response.timestamp.end_time)
                            .toLocaleString();
                        var existingContent = endTimeElement.html()
                            .trim();
                        if (existingContent === "" || existingContent.startsWith("<br>")) {
                            endTimeElement.html(newTimestamp);
                        } else {
                            var newEntry = existingContent + "<br>" + newTimestamp;
                            endTimeElement.html(newEntry);
                        }


                        console.log(response.timestamp.end_time);

                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed: ' + error);
                    }
                });
            });

            $('.complete-button').click(function() {
                var taskId = $(this).data('task-id');
                var totalTimeElement = $(
                    `#total-time-taken-${taskId}`);
                var status = $(`#task-status-${taskId}`);



                $.ajax({
                    url: '/completeTask/' + taskId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        //alert(response.message);
                        if (response.timeTaken) {
                            totalTimeElement.append('<br>Total Time Taken: ' + response
                                .timeTaken);
                        }
                        $(".start-button[data-task-id=" + taskId + "]").hide();
                        $(".end-button[data-task-id=" + taskId + "]").hide();
                        $(".complete-button[data-task-id=" + taskId + "]").prop('disabled',
                            true);

                        status.text('Complete');

                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed: ' + error);
                    }
                });
            });
        });
    </script>
@endpush
