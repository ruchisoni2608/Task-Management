<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Task;;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

 
    public function index()
    { 
        $unreadNotifications = Notification::where('user_id', auth()->user()->id)
        ->where('read', 0)
        ->with('task') 
        ->get();

        return view('notifications.index', ['notifications' => $unreadNotifications]);

    }
   



public function markAsRead($id)
{
    $notification = Notification::findOrFail($id);
    //$notification->read = 1;
    $notification->save();
    return redirect()->route('show');
}






}