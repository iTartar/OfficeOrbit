<?php
// app/Models/Schedule_user.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleUser extends Model
{
    protected $table = 'schedule_users';
    
    protected $fillable = [
        'nama',
        'schedule_name'
    ];
}