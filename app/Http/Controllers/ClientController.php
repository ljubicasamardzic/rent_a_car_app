<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Country;
use App\Models\EquipmentReservation;
use App\Models\Reservation;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::query()->orderByDesc('created_at')->paginate(Client::PER_PAGE);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $countries = Country::all();

        return view('clients.create', compact('countries'));
    }

    public function store(ClientRequest $request)
    {
        $full_name = $request->first_name.' '.$request->last_name;

        // dd($request);
        $data = [
            'name' => $full_name,
            'country_id' => $request->country_id,
            'identification_document_no' => $request->identification_document_no,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'date_of_first_reservation' => $request->date_of_first_reservation, 
            'date_of_last_reservation' => $request->date_of_last_reservation,
            'remarks' => $request->remarks
        ];

        $new_client = Client::query()->create($data);
        return redirect("/clients/$new_client->id");
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        // dd($client);
        $countries = Country::all();

        return view('clients.edit', compact('client', 'countries'));

    }

    public function update(ClientRequest $request, Client $client)
    {
        // unique rule used to make issues when updating clients 
        // this solves it by giving instructions to ignore the unique role for this same id
        $validated = $request->validate([
            'email'=> "required|email|unique:clients,email, $client->id",
            'identification_document_no' => "bail|required|unique:clients,identification_document_no, $client->id",
        ]);

        $client->update(
            [ 
                'name' => $request->full_name,
                'country_id' => $request->country_id,
                'identification_document_no' => $validated['identification_document_no'],
                'phone_no' => $request->phone_no,
                'email' => $validated['email'],
                'date_of_first_reservation' => $request->date_of_first_reservation,
                'date_of_last_reservation' => $request->date_of_last_reservation,
                'remarks' => $request->remarks
            ]);

        return redirect("/clients/$client->id");
    }

    public function destroy(Client $client)
    {
        // dd($client);
        $reservations = Reservation::where('client_id', $client->id)->get();

        if ($reservations) {
            foreach ($reservations as $reservation) {
                EquipmentReservation::where('reservation_id', $reservation->id)->delete(); 
                $reservation->delete();
            }
        }

        // dd($reservations);
        $client->delete();
        return redirect('/clients');
    }
}
