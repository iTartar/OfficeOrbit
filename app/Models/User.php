<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    protected $fillable = [
        'nama', 'email', 'role', 'ttl', 'gender', 'notelp','namalengkap','agama','joindate','enddate', 'schedule_id'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function shifts()
    {
        return $this->hasMany(ScheduleDetail::class);
    }
}
