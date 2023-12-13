<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create() {
     
        return view('create_task');
    }

    public function store(Request $request) {
        // Manager: Store the newly created task in the database
        $task = new Task();
        $task->title = $request->input('title');
        $task->user_id = $request->input('staff_id'); 
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task created and assigned.');
    }

    public function update(Request $request, $taskId) {
        // Staff: Update the status, start time, and end time of a task
        $task = Task::findOrFail($taskId);

        // Ensure the task belongs to the logged-in staff member
        if ($task->user_id !== auth()->user()->id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to update this task.');
        }

        $task->status = $request->input('status');
        $task->start_time = $request->input('start_time');
        $task->end_time = $request->input('end_time');
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }
}