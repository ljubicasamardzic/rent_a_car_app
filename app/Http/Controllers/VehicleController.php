<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\AvailabilityRequest;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\CarType;
use App\Models\EquipmentReservation;
use App\Models\Photo;
use App\Models\Reservation;
use ErrorException;
use Illuminate\Support\Facades\DB;


class VehicleController extends Controller
{

    public function index()
    {
        $vehicles = Vehicle::query()->orderByDesc('created_at')->paginate(Vehicle::PER_PAGE);
        return view('vehicles.index', compact('vehicles'));
    }

    // ADD NEW
    public function createStepOne(Request $request) {
        $vehicle_types = CarType::all();
        $vehicle = $request->session()->get('vehicle');
        return view('vehicles.create-one', compact('vehicle_types', 'vehicle'));
    }

    public function postStepOne(VehicleRequest $request) {
        $validated = [
            // 'plate_number' => $request->plate_number,
            'production_year' => $request->production_year,
            'car_type' => $request->car_type,
            'number_of_seats' => $request->number_of_seats,
            'price_per_day' => $request->price_per_day,
            'remarks' => $request->remarks
        ];

        $validated += $request->validate(['plate_number' => 'bail|required|unique:vehicles,plate_no']);

        $request->session()->put('vehicle', $validated);
        
        return redirect('vehicles/create-two');
    }

    public function createStepTwo(Request $request) {
        $vehicle = $request->session()->get('vehicle');
        return view('vehicles.create-two', compact('vehicle'));
    }

    public function postStepTwo(PhotoRequest $request) {

        $vehicle = $request->session()->get('vehicle');

        DB::beginTransaction();
        try {
            $new_vehicle = Vehicle::create([
                'plate_no' => $vehicle['plate_number'],
                'production_year' => $vehicle['production_year'],
                'car_type_id' => $vehicle['car_type'],
                'no_of_seats' => $vehicle['number_of_seats'],
                'price_per_day' => $vehicle['price_per_day'],
                'remarks' => $vehicle['remarks']
            ]);

            if ($request->file('photo')) {
                    $photos = $request->file('photo');
                    
                    foreach ($photos as $photo) {
                        $img_path = 'storage/' . $photo->store('vehicle-images');
                        Photo::create([
                            'photo' => $img_path,
                            'vehicle_id' => $new_vehicle->id
                        ]);
                    }             
            }
            DB::commit();
            
            $request->session()->forget('vehicle');

            return redirect("/vehicles/$new_vehicle->id");
        } catch (ErrorException $error) {
            DB::rollBack();
            return redirect()->back();
        }

        return redirect("/vehicles/$new_vehicle->id");
    }

    // EDITING 
    public function editStepOne(Request $request) {
        $vehicle = Vehicle::find($request->id);
        $vehicle_types = CarType::all();

        $ed_vehicle = [];

        if (!empty($request->session()->get('vehicle'))) {
            $ed_vehicle = $request->session()->get('vehicle');
        }

        return view('vehicles.edit-one', compact('vehicle_types', 'vehicle', 'ed_vehicle'));
    }

    public function postEditStepOne(VehicleRequest $request) {
        
        $ed_vehicle = [
            'id' => $request->id,
            // 'plate_number' => $request->plate_number,
            'production_year' => $request->production_year,
            'car_type' => $request->car_type,
            'number_of_seats' => $request->number_of_seats,
            'price_per_day' => $request->price_per_day,
            'remarks' => $request->remarks
        ];

        $id = $ed_vehicle['id'];

        $ed_vehicle += $request->validate(['plate_number' => "bail|required|unique:vehicles,plate_no, $id"]);

        $request->session()->put('vehicle', $ed_vehicle);
 
        return redirect()->route('vehicles.edit.two');
    }

    public function editStepTwo(PhotoRequest $request) {
        
        $ed_vehicle = $request->session()->get('vehicle');
        $photos = Photo::where('vehicle_id', $ed_vehicle['id'])->get();
        return view('vehicles.edit-two', compact('ed_vehicle', 'photos'));
    }

    public function postEditStepTwo(PhotoRequest $request) {

        $vehicle_data = session()->get('vehicle');

        $new_photos = $request->file('photo');

        // ids of old photos to be removed
        $remove_photo_ids = $request->hidden_img_ids;
        $vehicle = Vehicle::find($vehicle_data['id']);
        DB::beginTransaction();

        try {
            $updated_vehicle = $vehicle->update([
                'plate_no' => $vehicle_data['plate_number'],
                'production_year' => $vehicle_data['production_year'],
                'car_type_id' => $vehicle_data['car_type'],
                'no_of_seats' => $vehicle_data['number_of_seats'],
                'price_per_day' => $vehicle_data['price_per_day'],
                'remarks' => $vehicle_data['remarks']
            ]);
           
            // Case 1: new photos added and no old removed

            if ($new_photos != null && $remove_photo_ids == null) {
                foreach ($new_photos as $photo) {
                    $img_path = 'storage/' . $photo->store('vehicle-images');

                    Photo::create([
                        'photo' => $img_path,
                        'vehicle_id' => $vehicle_data['id']
                    ]);
                }
            // Case 2: new photos added and some old removed
            } else if ($new_photos != null && $remove_photo_ids != null) {
                foreach ($new_photos as $photo) {
                    $img_path = 'storage/' . $photo->store('vehicle-images');

                    Photo::create([
                        'photo' => $img_path,
                        'vehicle_id' => $vehicle_data['id']
                    ]);
                }

                $remove_arr = json_decode($remove_photo_ids);

                foreach($remove_arr as $key => $val) {
                    Photo::query()->where('id', $val)->delete();
                }
            } else if (!$new_photos && $remove_photo_ids != null) {
            // Case 3: No new photos added but some old removed     
                $remove_arr = json_decode($remove_photo_ids);

                foreach($remove_arr as $key => $val) {
                    Photo::query()->where('id', $val)->delete();
                } 
            } 


            DB::commit();

            $request->session()->forget('vehicle');

            $id = $vehicle_data['id'];

            return redirect("/vehicles/$id");

        } catch (ErrorException $error) {
            DB::rollBack();
            // dd($error);
            return redirect('/vehicles');
        }

    }  

    public function show(Vehicle $vehicle)
    {
        $photos = Photo::query()->where('vehicle_id', '=', $vehicle->id)
                        ->get();
        return view('vehicles.show', compact('vehicle', 'photos'));
    }
    
    public function destroy(Vehicle $vehicle)
    {
        $reservations = Reservation::where('vehicle_id', $vehicle->id)->get();

        if ($reservations) {
            foreach ($reservations as $reservation) {
                EquipmentReservation::where('reservation_id', $reservation->id)->delete();
                $reservation->delete();
            }
        }

        $photos = Photo::where('vehicle_id', $vehicle->id)->get();
        if ($photos) {
            foreach ($photos as $photo) {
                $photo->delete();
            }
        }

        $vehicle->delete();
        return redirect('/vehicles');
    }

    public function availability(Request $request) 
    {
        $car_types = CarType::all();
        return view('vehicles.availability', compact('car_types', 'request'));
    }

    public function checkAvailability(AvailabilityRequest $request) 
    {
        // dd($request);

        // if the car type filter is on, pick only cars that correspond to it
        // else take all
        if ($request->car_type) {
            $vehicles = Vehicle::query()
                    ->when($request->car_type, function($query) use ($request) {
                        $query->where('car_type_id', '=', $request->car_type);
                    })
                    ->get();
        } else {
            $vehicles = Vehicle::all();
        }

        // init the array where we will store info about already booked cars
        $booked_cars = [];
        
        // check if there are cars that are taken within the requested time period 
        foreach ($vehicles as $vehicle) {
            $found = $vehicle->reservations() 
                                ->where('from_date', '<=', $request->to_date)
                                ->where('to_date', '>', $request->from_date)
                                ->first();
            if($found != null) {
                $booked_cars[] = $found;
            }    
        }
        // ids of booked cars
        $booked_cars_ids = [];

        // if there are booked cars, we take their ids and place them in an arbooked_cars_idsy
        if (!empty($booked_cars)) {
            foreach ($booked_cars as $booked_car) {
                $booked_cars_ids[] = $booked_car['vehicle_id'];
            }
        }
        
        //dd($booked_cars_ids);
        $available_vehicles = Vehicle::query()
                                        ->when($request->car_type, function($query) use ($request) {
                                                $query->where('car_type_id', '=', $request->car_type);
                                            })
                                        ->whereNotIn('id', $booked_cars_ids)
                                        ->get();
        
        $car_types = CarType::all();

        return view('vehicles.availability', compact('available_vehicles', 'car_types', 'request'));
    }
}