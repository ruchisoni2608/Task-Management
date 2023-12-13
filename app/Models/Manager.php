<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Manager extends Model
{
    use HasFactory;
    protected $table="manager";
    protected $fillable=[
        'taskname','assign','assignstaff',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'assign');
    }
     
}