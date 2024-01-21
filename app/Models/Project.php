<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}