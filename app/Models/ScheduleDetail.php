<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['schedule_id', 'date', 'employee_id'];

    protected $dates = ['date'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}