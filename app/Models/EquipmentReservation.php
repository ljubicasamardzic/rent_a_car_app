<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EquipmentReservation extends Pivot
{
    use HasFactory;

    protected $table = 'equipment_reservations';

    protected $guarded = [];

}
