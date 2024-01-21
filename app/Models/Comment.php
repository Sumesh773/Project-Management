<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }

    protected $fillable = ['comment', 'user_id', 'task_id', 'is_read'];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
