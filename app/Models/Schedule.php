<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'effective_date'];

    public function shifts()
    {
        return $this->hasMany(ScheduleDetail::class);
    }
}
