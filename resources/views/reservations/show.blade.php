@extends('layouts.main')

@section('page_title') View a Reservation @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
               <h4 class="mt-4">Reservation with ID {{ $reservation->id }}</h4>
                <p>From: {{ date("d M Y", strtotime($reservation->from_date)) }}</p>
                <p>To: {{ date("d M Y", strtotime($reservation->to_date)) }}</p>
                <p>Rent Location: {{ $reservation->rentLocation->name }}</p>
                <p>Return Location: {{ $reservation->returnLocation->name }}</p>
                <p>Price: {{ $reservation->total_price }} €</p> 
            </div>
            
            <div class="col-4">
                <h4 class="mt-4">Client Info</h4>
                <p>Full Name: <a href="/clients/{{ $reservation->client->id }}">{{ $reservation->client->name }}</a></p>
                <p>Country: {{ $reservation->client->country->name }}</p>
                <p>Passport/ID: {{ $reservation->client->identification_document_no }}</p>
                <p>Phone: {{ $reservation->client->phone_no }}</p>
                <p>Email: {{ $reservation->client->email }}</p>
            </div>
           
            <div class="col-4">
                <h4 class="mt-4">Vehicle Info</h4>
                <p>Plate Number: <a href="/vehicles/{{ $reservation->vehicle->id }}">{{ $reservation->vehicle->plate_no }}</a></p>
                <p>Production Year: {{ $reservation->vehicle->production_year }}</p>
                <p>Vehicle Type: {{ $reservation->vehicle->carType->name }}</p>
                <p>Seat Number: {{ $reservation->vehicle->no_of_seats }}</p>
                <p>Price per Day: {{ $reservation->vehicle->price_per_day }} €</p>
            </div>
            <div class="col-6">
                <h4 class="mt-4">Additional Equipment</h4>
            
                @if ($reservation->equipment != "[]")
                    <table class="table table-responsive-sm table-hover mt-4 w-85">
                            <tr>
                                <th>Equipment Name</th>
                                <th>Quantity</th>
                            </tr>
                        <tbody>
                            @foreach ($reservation->equipment as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pivot->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else  <p>No additional equipment has been added.</p>  
                @endif

            
            
        </div>
    </div>
@endsection