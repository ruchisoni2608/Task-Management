<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskTimestamp extends Model
{
    use HasFactory;
    protected $table="task_timestamps";
    protected $fillable=[
        'task_id','start_time','end_time','time_taken',
    ];

    public function task() 
    {
    return $this->belongsTo(Task::class,'task_id');
    }
}