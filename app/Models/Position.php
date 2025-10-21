<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'title',
        'boards_id',
        'position_order', 
    ];
    
    public function board()
    {
        return $this->belongsTo(Board::class, 'boards_id', 'id');
    }
}
