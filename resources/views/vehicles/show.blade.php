@extends('layouts.main')

@section('page_title') View a Vehicle @endsection

@section('content')

    <div class="container-fluid">            
        <h4 class="mt-4">Vehicle with ID {{ $vehicle->id }}</h4>
        <div class="row">
            <div class="col-6">
                <p>Plate numbers: {{ $vehicle->plate_no }}</p>
                <p>Production year: {{ $vehicle->production_year }}</p>
                <p>Car type: {{ $vehicle->carType->name }}</p>
                <p>Number of seats: {{ $vehicle->no_of_seats }} </p>
                <p>Price per day: {{ $vehicle->price_per_day }} €</p>
                <p>Additional remarks: {{ $vehicle->remarks }}</p>
            </div>
            <div class="col-6">
                @if (!empty($photos))
                    @foreach ($photos as $photo)
                        <img src="{{ asset($photo->photo) }}" width="260" height="200" class="img-fluid" alt="">
                    @endforeach    
                @endif
            </div>
        </div>
    </div>
@endsection