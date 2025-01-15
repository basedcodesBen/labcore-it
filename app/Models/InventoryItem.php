<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description', 'quantity', 'available'];

    // Define the inverse of the polymorphic relationship
    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservable');
    }
}
