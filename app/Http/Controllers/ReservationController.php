<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Reservation;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Equipment;
use App\Models\EquipmentReservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use Database\Seeders\ReservationSeeder;
use ErrorException;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    protected $dates = ['to_date', 'from_date'];

    public function index()
    {
        $reservations = Reservation::query()->orderByDesc('created_at')->paginate(Reservation::PER_PAGE);
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $locations = Location::all();
        $clients = Client::all();
        $vehicles = Vehicle::all();
        $equipment = Equipment::all();
        return view('reservations.create', compact('locations', 'clients', 'vehicles', 'equipment'));
    }

    public function store(ReservationRequest $request)
    {
        // dd($request);
        // information for the reservation 
        $data = [
            'client_id' => $request->client_id,
            'vehicle_id' => $request->vehicle_id,
            'from_date' => $request->rent_date,
            'to_date' => $request->return_date,
            'rent_location_id' => $request->rent_location, 
            'return_location_id' => $request->return_location
        ];

        // make the date format right for using Carbon 
        $data['to_date'] .= ' 00:00:00'; 
        $data['from_date'] .= ' 00:00:00';

        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data['to_date']);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data['from_date']);
        $diff_in_days = $to->diffInDays($from);

        // calculate the price of reservation using the price of the chosen vehicle
        $price = $diff_in_days * Vehicle::find($data['vehicle_id'])->price_per_day;
        $data['total_price'] = $price;

        DB::beginTransaction();
 
        try {
            // save the reservation in a variable so that we can get its id
            // and use it for saving date in the equipment_reservations table
            $new_reservation = Reservation::query()->create($data);
            
            $equipment = Equipment::all();

            foreach($equipment as $item) {
                $equip_id = $item->id;
    
                $name = 'e_'.$equip_id;
    
                // amount chosen for this equipment item
                $chosen_value = $request->$name;
                if ($chosen_value != null) {
                    EquipmentReservation::create(
                        [
                            'reservation_id' => $new_reservation->id,
                            'equipment_id' => $equip_id,
                            'quantity' => $chosen_value
                        ]
                    );                           
                } 
            }

            DB::commit();
            return redirect("/reservations/$new_reservation->id");

        } catch (ErrorException $error) {
            DB::rollBack();
            return redirect()->back();
        }

    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $locations = Location::all();
        $clients = Client::all();
        $vehicles = Vehicle::all();
        $equipment = Equipment::all();
        return view('reservations.edit', compact('locations', 'clients', 'vehicles', 'equipment', 'reservation'));
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {

        // equipment 
        $equipment = Equipment::all();

        DB::beginTransaction();
        try {
            foreach($equipment as $item) {
                $equip_id = $item->id;
    
                $name = 'e_'.$equip_id;
    
                // amount chosen for this equipment item
                // dd($request->$name);
                $chosen_value = $request->$name;
                // dd($chosen_value);
                if ($chosen_value != null) {
                    EquipmentReservation::updateOrCreate(
                        [
                            'reservation_id' => $reservation->id,
                            'equipment_id' => $equip_id 
                        ], 
                        [ 'quantity' => $chosen_value ]
                    );                           
                } else if ($chosen_value == null) {
                    // if the current value is null check if the record existed before and delete it
                    // if it did not, do nothing 
                    $query = EquipmentReservation::query()
                                            ->where('reservation_id', $reservation->id)
                                            ->where('equipment_id', $equip_id);
                    if ($query->first() != null) {
                        $query->delete();
                    }   
                }
            }
    
            // information for the reservation 
            $data = [
                'client_id' => $request->client_id,
                'vehicle_id' => $request->vehicle_id,
                'from_date' => $request->rent_date,
                'to_date' => $request->return_date,
                'rent_location_id' => $request->rent_location, 
                'return_location_id' => $request->return_location
            ];
    
            // make the date format right for using Carbon 
            $data['to_date'] .= ' 00:00:00'; 
            $data['from_date'] .= ' 00:00:00';
    
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data['to_date']);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data['from_date']);
            $diff_in_days = $to->diffInDays($from);
    
            // calculate the price of reservation using the price of the chosen vehicle
            $price = $diff_in_days * Vehicle::find($data['vehicle_id'])->price_per_day;
            $data['total_price'] = $price;
    
            $reservation->update($data);

            DB::commit();
            return redirect("/reservations/$reservation->id");

        } catch(ErrorException $error) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function destroy(Reservation $reservation)
    {
        EquipmentReservation::where('reservation_id', $reservation->id)->delete();
        $reservation->delete();
        return redirect('/reservations');
    }
}
