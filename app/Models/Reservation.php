<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reservable_type', 'reservable_id', 'start_time', 'end_time', 'status'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Polymorphic relationship to either a Room or other reservable types
    public function reservable()
    {
        return $this->morphTo();
    }

    // Relationship with the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

