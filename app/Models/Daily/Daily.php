<?php

namespace App\Models\Daily;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model {
    use HasFactory;
    
    protected $table = "daily"; 

    protected $primaryKey = "dailyid";
    
    protected $fillable = [
        'user_id',
        'content',
        'ipadress',
        'date',
        "daily_time"
    ];

}
