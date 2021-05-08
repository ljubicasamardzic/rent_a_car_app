<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    const PER_PAGE = 10;

    protected $guarded = [];

    public function carType(){
        return $this->belongsTo(CarType::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }

}
