<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Staff;
use App\Models\User;
use App\Models\Task;
  use App\Models\Notification;

use App\Models\TaskTimestamp;    
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function managerHome()
    {
        return view('managerHome');
    }
    public function staffHome()
    {      
        $user = auth()->user();
        $notifications = Notification::where('user_id', $user->id)->where('read',0)->get();  
        //dd($user,$notifications); 
        return view('staffHome',compact('notifications' ));
    }

     public function taskindex()
    {
       // $tasks = Manager::latest()->paginate(5);
         $tasks = Task::with('user')->get();
        return view('admin.taskindex',compact('tasks'));
    }
   
    // public function appblade(){
    //     $user = auth()->user();

    //         $notifications = Notification::where('user_id', $user->id)->get();    
    //     //dd($user,$notifications);
    //     return view('layouts.app',compact('notifications' ));
    // }
 

    public function admincreate()
    {
        $staffuser=User::where('role',2)->get();
        return view('admin.create',compact('staffuser'));
    }

    public function adminstore(Request $request)
    {
       // dd($request->all());
      
         $task = new Task();
        $task->title = $request->input('title');
        $task->user_id = $request->input('user_id'); 
        $task->save();
         
        return redirect()->route('admin.taskindex')
                        ->with('success','Task created successfully.');
    }

     public function edit(Request $request,$taskId) {
    $task = Task::findOrFail($taskId);
  $staffuser=User::where('role',2)->get();
    return view('admin.edit', ['task' => $task,'staffuser' => $staffuser]);
    }

    public function editTask(Request $request, $taskId) {
        $task = Task::findOrFail($taskId);
    
        $task->title = $request->input('title');        
        $task->user_id = $request->input('user_id');
        
        $task->save();

        return redirect()->route('admin.taskindex')->with('success', 'Task updated successfully.');
    }

    public function deleteTask(Request $request, $taskId) {
        $task = Task::findOrFail($taskId);
        
        $task->delete();

        return redirect()->route('admin.taskindex')->with('success', 'Task deleted successfully.');
    }
   
   
    //    public function taskReport(Request $request) {
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');
        
    //     // $taskReport = Task::whereBetween('start_time', [$start_date, $end_date])
    //     //     ->with('user') 
    //     //     ->get();
    //           $taskReport = Task::where('status','Complete')->with('user')->get();
    //     //dd($taskReport);
        
    //     return view('admin.stafftaskindex', ['taskReport' => $taskReport]);
    // }
    public function stafftaskindex()
    {
        $tasks = Task::where('status','Complete')->with('user')->get();
     
       $taskIds = Task::where('status', 'Complete')->pluck('id')->toArray();
        $timetaken = TaskTimestamp::select('task_id', 'time_taken','start_time','end_time')
        ->whereIn('task_id', $taskIds)
        ->whereNotNull('time_taken') 
        ->get();
        $startTimesByTask = $timetaken->groupBy('task_id');


        // $startTimes = TaskTimestamp::select('task_id', 'start_time')
        //     ->whereIn('task_id', $taskIds)
        //     ->whereNotNull('start_time')
        //     ->get();

        // $startTimesByTask = $startTimes->groupBy('task_id');
//     foreach ($tasks as $task) {
//     $task->start_time = $startTimesByTask->get($task->id, [])->first();
//     $task->end_time = $timetaken->where('task_id', $task->id)->first();    
// }

        return view('admin.stafftaskindex',compact('tasks','timetaken',  'startTimesByTask'));
    }

    
   
    public function editstaffTask(Request $request, $taskId) 
    {
      $task = Task::findOrFail($taskId);

      $task->status = $request->input('status');        
      $task->user_id = $request->input('user_id');
      $task->date = $request->input('date');        
      $task->start_time = $request->input('start_time');
      $task->end_time = $request->input('end_time');
      $task->save();

        return redirect()->route('admin.stafftaskindex')->with('success', 'Task updated successfully.');
    }
     public function deletestaffTask(Request $request, $taskId) {
        $task = Task::findOrFail($taskId);
        
        $task->delete();

        return redirect()->route('admin.stafftaskindex')->with('success', 'Task deleted successfully.');
    }
    
    //  public function edit(Product $product)
    // {
    //     return view('products.edit',compact('product'));
    // }
    // public function update(Request $request, Product $product)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'detail' => 'required',
    //     ]);
    
    //     $product->update($request->all());
    
    //     return redirect()->route('products.index')
    //                     ->with('success','Product updated successfully');
    // }
}