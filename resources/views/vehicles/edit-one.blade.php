@extends('layouts.main')

@section('page_title') Vehicles @endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-3 col-5 mt-4" style="border: 2px solid lightgray">
            <div>
                <h4 class="mt-3">Edit Step One</h4>
            </div>
            <form action="/vehicles/{{ $vehicle ? $vehicle->id : $ed_vehicle['id'] }}/post-edit-one" method="POST" class="mt-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $vehicle ? $vehicle->id : $ed_vehicle['id'] }}">
                <div class="pl-0">
                    <label for="plate_number">Plate number:</label>
                    <input type="text" 
                            value="{{ old('plate_number', $ed_vehicle ? $ed_vehicle['plate_number'] : $vehicle->plate_no) }}" 
                            name="plate_number" 
                            class="form-control @error('plate_number') is-invalid @enderror">
                    @error('plate_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="pl-0 mt-4">
                    <label for="production_year">Production year:</label>
                    <input type="text" 
                            value="{{ old('production_year', $ed_vehicle ? $ed_vehicle['production_year'] : $vehicle->production_year) }}" 
                            name="production_year" 
                            class="form-control @error('production_year') is-invalid @enderror">
                    @error('production_year')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="pl-0 mt-4">
                    <label for="car_type">Vehicle type:</label>
                    <select name="car_type" 
                            class="form-control @error('car_type') is-invalid @enderror">
                        <option value="">-- vehicle types --</option> 
                        @foreach ($vehicle_types as $type)
                            <option value="{{ $type->id }}" {{ old('car_type', $ed_vehicle ? $ed_vehicle['car_type'] : $vehicle->car_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>

                    @error('car_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                    
                <div class="pl-0 mt-4">
                    <label for="number_of_seats">Number of seats:</label>
                    <input type="number" 
                            value="{{ old('number_of_seats', $ed_vehicle ? $ed_vehicle['number_of_seats'] : $vehicle->no_of_seats) }}" 
                            class="form-control @error('number_of_seats') is-invalid @enderror" 
                            name="number_of_seats">
                    @error('number_of_seats')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="pl-0 mt-4">
                    <label for="price_per_day">Price per day:</label>
                    <input type="number" value="{{ old('price_per_day', $ed_vehicle ? $ed_vehicle['price_per_day'] : $vehicle->price_per_day) }}" class="form-control @error('price_per_day') is-invalid @enderror" name="price_per_day">
                    @error('price_per_day')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="pl-0 mt-4">
                    <label for="remarks">Additional remarks:</label>
                    <textarea type="text" 
                                class="form-control @error('remarks') is-invalid @enderror" 
                                name="remarks" 
                                rows="4">{{ old('remarks', $ed_vehicle ? $ed_vehicle['remarks'] : $vehicle->remarks) }}</textarea>
                    @error('remarks')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="pl-0 mt-4 float-right">
                    <button type="submit" class="btn btn-primary mb-2">Next</button>
                </div>
            </form>
    </div>
    </div>
</div>
@endsection