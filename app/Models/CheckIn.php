<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mood',
        'what_i_did_yesterday',
        'what_i_will_do_today',
        'blockers',
        'checkin_date'
    ];

    protected $casts = [
        'checkin_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}