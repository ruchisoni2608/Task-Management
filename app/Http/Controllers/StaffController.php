<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskTimestamp;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function staffindex()
    {
        $username=Auth::user()->id;
       //dd($username);
        $tasks=Task::where('user_id',$username)->with('timestamps')->get();   
        // dd($tasks);
          $user = auth()->user();
        $notifications = Notification::where('user_id', $user->id)->get();  
          return view('staff.index', ['tasks' => $tasks,'notifications' => $notifications]);
    }
    // public function editTask(Request $request, $taskId) 
    // {
    //  // dd($request->all());
    //   $task = Task::findOrFail($taskId);

    //   $task->status = $request->input('status');        
    //   $task->user_id = $request->input('user_id');
    //   $task->date = $request->input('date');        
    //   $task->start_time = $request->input('start_time');
    //   $task->end_time = $request->input('end_time');
    //   $task->save();

    //     return redirect()->route('staff.index')->with('success', 'Task updated successfully.');
    // }

// public function show()
// {
//     $user = auth()->user();
//    $notification = Notification::where('read',0)->where('user_id', $user->id)->get('task_id');
//    //dd($notification);
//     $lastAssignedTasks = Task::select('id','title')->where('user_id', $user->id)->where('id',$notification)
//         ->orderBy('created_at', 'desc')
//         ->get();
// //dd($lastAssignedTasks);
//     return view('staff.show', ['lastAssignedTasks' => $lastAssignedTasks]);
// }

public function show()
{
    $user = auth()->user();

  
    $unreadNotifications = Notification::where('user_id', $user->id)
        ->where('read', 0)
        ->get();

  
    $unreadTasks = [];
    foreach ($unreadNotifications as $notification) {
        $task = Task::find($notification->task_id);
        if ($task) {
            $unreadTasks[] = $task;
        }
    }
// dd($unreadNotifications);
    // Mark the notifications as read
    foreach ($unreadNotifications as $notification) {
      Notification::where('id',$notification->id)->update(['read'=> 1]);
       //$notification->update('read' , 1);
    }

    return view('staff.show', ['unreadTasks' => $unreadTasks]);
}


    public function startTask($taskId) 
    {
      //dd("start");
      $task = Task::find($taskId);
    // dd($task);
      $timestamps = new TaskTimestamp(['start_time' => now()]);
      $task->timestamps()->save($timestamps);
      $task->status = 'In Progress';
      $task->save();
      return response()->json(['message' => 'Task started successfully', 'status' => 'In Process', 'timestamp' => $timestamps]);
    }

      public function stopTask($taskId, Request $request)
     {

        $task = Task::find($taskId);
        if ($task) {   
        //   dd($task);
            $starttime=$task->timestamps()->where('start_time','<>' ,null)->latest()->first();
             
            $endtime= new TaskTimestamp(['end_time' => now()]);
            
            $timediffernce= $endtime->end_time->diffInSeconds($starttime->start_time);
              
            $formattedTimeDifference = gmdate("H:i:s", $timediffernce);
        
          if ($timediffernce < 60) {
            $formattedTimeDifference = '00:00:00';
        }
        
          $endtime->time_taken = $formattedTimeDifference;


            $task->timestamps()->save($endtime);    
            $task->status = 'In Progress';
            $task->save();            
            return response()->json(['message' => 'Task stopped successfully', 'status' => 'In Process', 'timestamp' => $endtime, 'timeTaken' => $formattedTimeDifference]);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    public function completeTask($taskId) {
        $task = Task::find($taskId);
    //dd($task);
        if ($task) {
            $task->status = 'Complete';
            $task->save();
          
            $totalTimeTaken = $this->calculateTotalTimeTaken($task);

            $timestamps = new TaskTimestamp([
            'end_time' => now(),
            'time_taken' => $totalTimeTaken
        ]);
        $task->timestamps()->save($timestamps);

            return response()->json(['message' => 'Task completed successfully','status' => 'Complete', 'timeTaken' => $totalTimeTaken]);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

  private function calculateTotalTimeTaken($task) {
      $totalTime = 0;
      $timestamps = $task->taskTimestamps;
      $startTime = null;
      foreach ($timestamps as $timestamp) {
          if ($timestamp->start_time) {
              $startTime = Carbon::parse($timestamp->start_time);
          } elseif ($timestamp->end_time && $startTime !== null) {
              $endTime = Carbon::parse($timestamp->end_time);

            $timeDifference = $endTime->diffInSeconds($startTime);            
             if ($timeDifference >= 60) {
                $totalTime += $timeDifference;
            }         
              $startTime = null;
            // dd($endTime,$startTime);
          }
      }
      return gmdate("H:i:s", $totalTime);
  }

 




// private function calculateTotalTimeTaken($task) {
//     $totalTime = 0;

//        foreach ($task->taskTimestamps as $timestamp) {
//         if ($timestamp->start_time && $timestamp->end_time) {
//             $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp->start_time);
//             $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp->end_time);
//             $totalTime += $endTime->diffInSeconds($startTime);

//         }
//       }


//     //$totalTime = max(60, $totalTime); 

//     return gmdate("H:i:s", $totalTime);
// }
// private function calculateTotalTimeTaken($task) {
//     $totalTime = 0;

//     foreach ($task->taskTimestamps as $timestamp) {
//         if ($timestamp->start_time && $timestamp->end_time) {
//             $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp->start_time);
//             $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp->end_time);
            
//             // Log the values to help with debugging
//             \Log::info('StartTime1: ' . $startTime);
//             \Log::info('EndTime1: ' . $endTime);


//             $totalTime += $endTime->diffInSeconds($startTime);
//         }
//     }

//     return gmdate("H:i:s", $totalTime);
// }



// private function calculateTotalTimeTaken($task) {
//     $totalTime = 0;
//     $timestamps = $task->taskTimestamps;

//     $startTime = null;
    
//     foreach ($timestamps as $timestamp) {
//         if ($timestamp->start_time) {
            
//             $startTime = $timestamp->start_time;
//         } elseif ($timestamp->end_time) {
         
//             if ($startTime) {
//                 $endTime = $timestamp->end_time;
//                 $totalTime += strtotime($endTime) - strtotime($startTime);
//                 $startTime = null; 
//             }
//         }
//     }  
//     return gmdate("H:i:s", $totalTime);
// }

// private function calculateTotalTimeTaken($task) {
//     $totalTime = 0;
//     $startTime = null;

//     foreach ($task->taskTimestamps as $timestamp) {
//         if ($timestamp->start_time) {
//             $startTime = $timestamp->start_time;
//         } elseif ($timestamp->end_time && $startTime !== null) {
//             $endTime = $timestamp->end_time;
//             $totalTime += strtotime($endTime) - strtotime($startTime);
//             $startTime = null;
//         }
//     }

//     return gmdate("H:i:s", $totalTime);
// }








  // public function stopTask($taskId) {
  //   //dd("stop");
  //     $task = Task::find($taskId);
  //    // dd($task);
  //     $timestamps = new TaskTimestamp(['end_time' => now()]);
  //     //$lastHistoryEntry = $task->timestamps()->last();
  //     //$lastHistoryEntry->end_time = now();
  //     $task->timestamps()->save($timestamps);
  //     $task->status = 'in_progress';
  //     $task->save();
  //     return response()->json(['message' => 'Task stopped successfully']);
  // }

  // public function stopTask($taskId) {
  //   $task = Task::find($taskId);
  //  $lastHistoryEntry = $task->timestamps->last();   
  //   $lastHistoryEntry->end_time = now();
  //   $lastHistoryEntry->save();
  //   $task->task_status = 'in_progress';
  //   $task->save();
  //        return response()->json(['message' => 'Task stopped successfully']);
  // }






  // public function completeTask($taskId) {
  //     $task = Task::find($taskId);
  //     $task->status = 'completed';
  //     $task->save();
  //     $totalTimeTaken = $this->calculateTotalTimeTaken($task);
  //     return response()->json(['message' => 'Task completed successfully', 'timeTaken' => $totalTimeTaken]);
  // }


// private function calculateTotalTimeTaken($task) {
//     $startTimes = $task->taskTimestamps->pluck('start_time')->all();
//     $endTimes = $task->taskTimestamps->pluck('end_time')->all();
//    // dd($startTimes,$endTimes);
//     $totalTime = 0;

//     for ($i = 0; $i < count($startTimes); $i++) {
//         if ($endTimes[$i]) {
//             $totalTime += $endTimes[$i]->diffInSeconds($startTimes[$i]);
//          //   dd($totalTime);
//         }
//     }

//     return gmdate("H:i:s", $totalTime); // Format as HH:MM:SS
// }

//     public function startTask($taskId)
// {
//     $task = Task::find($taskId);
    
//     $timestamp = new TaskTimestamp();
//     $timestamp->start_time = now();
//     $task->timestamps()->save($timestamp);

//     return response()->json(['message' => 'Task started']);
// }

// public function endTask($taskId)
// {
//   dd("end");
//     $task = Task::find($taskId);
//     $timestamp = new TaskTimestamp();
//     $timestamp->end_time = now();
//     $task->timestamps()->save($timestamp);

//     return response()->json(['message' => 'Task ended']);
// }





    // public function create()
    // {
    //      $stafftask = Staff::pluck('task_id');
      
    //      $id = Auth::id();
  
    //     $username=Auth::user()->name;
    //     $stafftaskn=Manager::where('assignstaff',$username)->pluck('taskname');
        
    //     return view('staff.create',compact('id','stafftask','stafftaskn'));
    // }

    // public function store(Request $request)
    // {
    //   //  dd($request->all());
    //     // $request->validate([
    //     //     //'task_id' => 'required',
    //     //     'status	' => 'required',
    //     //     'date' => 'required',
    //     //     'starttime	' => 'required',
    //     //     'endtime ' => 'required',
    //     // ]);
    
    //     Staff::create($request->all());
     
    //     return redirect()->route('staff.index')
    //                     ->with('success','Task status Updated successfully.');
    // }
     
}