<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'check_in_time', 'check_out_time'];

    // Relationship with the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
