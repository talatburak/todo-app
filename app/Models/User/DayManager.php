<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayManager extends Model
{
    use HasFactory;
    protected $table = "in_out_log";

    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "created_date",
        "start_time",
        "end_time",
        "year",
        "mounth"
    ];
}
