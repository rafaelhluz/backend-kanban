<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'title',
        'description',
        'id_users',
        'id_positions',
        'dt_start',
        'dt_end',
        'asign_users'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }   

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_positions');
    }

}
