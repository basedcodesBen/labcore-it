<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type','date','clock_in', 'clock_out'];

    // Relationship with the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
