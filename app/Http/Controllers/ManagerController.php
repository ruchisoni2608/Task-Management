<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Notification;
use App\Models\User;
use App\Models\Task;
use App\Notifications\TaskAssignedNotification;

 
class ManagerController extends Controller
{
    
    public function index()
    {
       // $tasks = Manager::latest()->paginate(5);
        $tasks = Task::with('user')->orderBy('created_at','desc')->get();
        return view('manager.index',compact('tasks')) ;
      
    }
    public function create()
    {
        $staffuser=User::where('role',2)->get();
//        dd($staffuser);
        return view('manager.create',compact('staffuser'));
    }

    public function store(Request $request)
    {
      // dd($request->all());
      
        $task = new Task();
        $task->title = $request->input('title');
        $task->user_id = $request->input('user_id');    
        $task->save();

        $notification = new Notification();
        $notification->user_id = $request->input('user_id'); 
        $notification->message = 'You have a new task: ' . $task->title;
        $notification->task_id = $task->id;
        $notification->save();
       
        return redirect()->route('manager.index')
                        ->with('success','Task created successfully.');
    }

   



    public function edit(Request $request,$taskId) {
    $task = Task::findOrFail($taskId);
  $staffuser=User::where('role',2)->get();
    return view('manager.edit', ['task' => $task,'staffuser' => $staffuser]);
    }

    public function editTask(Request $request, $taskId) {
        $task = Task::findOrFail($taskId);
    
        $task->title = $request->input('title');        
        $task->user_id = $request->input('user_id');
        
        $task->save();

        return redirect()->route('manager.index')->with('success', 'Task updated successfully.');
    }

    public function deleteTask(Request $request, $taskId) {
        $task = Task::findOrFail($taskId);
        
        $task->delete();

        return redirect()->route('manager.index')->with('success', 'Task deleted successfully.');
    }












    //  public function index()
    // {
    //     $tasks = Manager::latest()->paginate(5);
    
    //     //$assign= Manager::all();
        
    //     // $name='';
    //     // foreach($assign as $asignname){
    //     //     $name .= $asignname->users->name;         
    //     // }
    //    // dd($name);
    // //    $assi=Manager::pluck('assign');
    // //    $username= User::where('id',$assi)->with('name')->get();
    // //    dd($username);
    //   // dd($assi);

    // //    $user = User::where('id', $assi)->first();
    // //    $name = $user->name;
    // //    dd($name);
    
    //     return view('manager.index',compact('tasks'));
    // }
}