<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Equipment extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function reservations() {
        return $this->belongsToMany(Reservation::class, 'equipment_reservations', 'equipment_id', 'reservation_id')->withPivot('quantity');
    }
}
