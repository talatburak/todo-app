<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'task_desc',
        'creator_id',
        'given_id',
        'time_id',
        'remember',
        "done",
        "unlimited",
        "done_date"
    ];
    
}
