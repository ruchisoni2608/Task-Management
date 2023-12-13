<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth', 'user-access:Admin'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('admin')->group(function () {
    Route::get('/taskindex', [HomeController::class, 'taskindex'])->name('admin.taskindex');      
    Route::get('/stafftaskindex', [HomeController::class, 'stafftaskindex'])->name('admin.stafftaskindex');      
    Route::get('/create', [HomeController::class, 'admincreate'])->name('admin.create');
    Route::post('/store', [HomeController::class, 'adminstore'])->name('admin.store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('admin.edit');
    
  Route::get('edit/{taskId}', [HomeController::class,'edit'])->name('admin.edit');
  Route::post('/edit-task/{taskId}', [HomeController::class,'editTask'])->name('admin.editTask');
  Route::delete('/delete-task/{taskId}', [HomeController::class,'deleteTask'])->name('admin.deleteTask');

  Route::get('/edit-stafftask/{taskId}', [HomeController::class,'editstaffTask'])->name('admin.editstaffTask');
  Route::delete('/delete-stafftask/{taskId}', [HomeController::class,'deletestaffTask'])->name('admin.deletestaffTask');

 

     });
});
  


Route::middleware(['auth', 'user-access:Manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

    Route::prefix('manager')->group(function () {
    Route::get('/', [ManagerController::class, 'index'])->name('manager.index');      
    Route::get('/create', [ManagerController::class, 'create'])->name('manager.create');
    Route::post('/store', [ManagerController::class, 'store'])->name('manager.store');
    
    Route::get('edit/{taskId}', [ManagerController::class,'edit'])->name('manager.edit');
  Route::post('/edit-task/{taskId}', [ManagerController::class,'editTask'])->name('manager.editTask');
Route::delete('/delete-task/{taskId}', [ManagerController::class,'deleteTask'])->name('manager.deleteTask');

  });

      
});

    

  

Route::middleware(['auth', 'user-access:Staff'])->group(function () {
  
    Route::get('/staff/home', [HomeController::class, 'staffHome'])->name('staff.home');
    
     Route::prefix('staff')->group(function () {
    Route::get('/staffindex', [StaffController::class, 'staffindex'])->name('staff.index');      
    // Route::get('/create', [StaffController::class, 'create'])->name('staff.create');
    // Route::post('/store', [StaffController::class, 'store'])->name('staff.store');
     Route::get('/edit-task/{taskId}', [StaffController::class,'editTask'])->name('staff.editTask');

   
  });
  // Route::post('/task/start/{taskId}', [StaffController::class,'startTask']);
//Route::post('/task/end/{taskId}', [StaffController::class,'endTask']);

//Route::get('/tasks', [StaffController::class,'index']);

Route::post('/startTask/{taskId}', [StaffController::class,'startTask']);
Route::post('/stopTask/{taskId}', [StaffController::class,'stopTask']);
Route::post('/completeTask/{taskId}', [StaffController::class,'completeTask']);

});

//Route::get('/notifications', [NotificationController::class,'index'])->name('notifications.index');

Route::get('/notifications', [NotificationController::class,'index'])->name('notifications.index');
Route::get('/notifications/mark-as-read/{id}', [NotificationController::class,'markAsRead'])->name('notifications.mark-as-read');


Route::get('/show',[StaffController::class,'show'])->name('show');

Route::get('/chat',[ChatController::class,'chat'])->name('show');
Route::post('/chat',[ChatController::class,'chat']);

Route::get('open-ai', [ChatController::class, 'openai']);