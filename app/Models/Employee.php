<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_hour', 'end_hour'];

    public function shifts()
    {
        return $this->hasMany(ScheduleDetail::class);
    }
}