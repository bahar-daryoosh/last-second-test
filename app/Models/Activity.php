<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'price', 'available_slots', 'start_date'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
