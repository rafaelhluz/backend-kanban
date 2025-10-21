<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'description',
        'id_users',
        'id_tasks',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_tasks', 'id');
    }
}
