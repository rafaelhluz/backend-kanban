<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attach extends Model
{
    protected $fillable = [
        'id_users',
        'id_tasks',
        'file_url',
    ];
    
    public function user() 
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class, 'id_attachs', 'id');
    }

    protected $table = 'attaches';
}
