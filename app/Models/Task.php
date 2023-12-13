<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

  protected $table="Task";
    protected $fillable = [
        'title', 'status', 'user_id' ,'start_time', 'end_time'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
   
    public function timestamps()
    {
        return $this->hasMany(TaskTimestamp::class);
    }
    public function taskTimestamps()
{
    return $this->hasMany(TaskTimestamp::class);
}


}