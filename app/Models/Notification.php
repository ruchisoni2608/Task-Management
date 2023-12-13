<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
       'id', 'user_id','message','task_id','read_at',
    ];
    protected $table="notifications";

     public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
      public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}