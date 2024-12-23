<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [ 'progress','projek','progress','description','value','start_date','end_date','priority','status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}