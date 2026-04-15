<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'yesterday',
        'today',
        'blockers'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}