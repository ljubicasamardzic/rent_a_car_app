<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Equipment;
use App\Models\Vehicle;
use App\Models\Client;
use App\Models\EquipmentReservation;



class Reservation extends Model
{
    use HasFactory;
    const PER_PAGE = 10;

    protected $guarded = [];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function rentLocation() {
        return $this->belongsTo(Location::class);
    }

    public function returnLocation() {
        return $this->belongsTo(Location::class);
    }

    public function equipment() {
        return $this->belongsToMany(Equipment::class, 'equipment_reservations', 'reservation_id', 'equipment_id')->withPivot(['quantity']);
    }

    // function checks if reservation contains equipment based on equipment id 
    // returns quantity, which is used to give 'selected' property to correct items in the select menu
    public function reservationEquipmentQuantity($id){
        $query = EquipmentReservation::query()
                                        ->where('reservation_id', '=', $this->id)
                                        ->where('equipment_id', '=', $id)
                                        ->first();

        $query == null ? $quantity = 0 : $quantity=$query->quantity;
        return $quantity;
    }
}
