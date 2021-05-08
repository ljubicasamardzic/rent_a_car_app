@extends('layouts.main')

@section('page_title') Step 1 Create @endsection

@section('content')
    
    <div class="container-fluid">

        <div class="row">

            <div class="offset-3 col-5 mt-4" style="border: 2px solid lightgray">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="mt-3">Vehicle Create</h4>
                    <p class="mt-3">Step 1</p>
                </div>
                
                <form action="/vehicles/post-one" method="POST" class="mt-3" enctype="multipart/form-data">
                    @csrf

                    <div class="pl-0">
                        <label for="plate_number">Plate number:</label>
                        <input type="text" 
                                placeholder="Plate number" 
                                value="{{ old('plate_number', $vehicle ? $vehicle['plate_number'] : '') }}" 
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
                        <input type="number" 
                                placeholder="Production year" 
                                value="{{ old('production_year', $vehicle ? $vehicle['production_year'] : '') }}" 
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
                        <select type="text" 
                                name="car_type" 
                                class="form-control @error('car_type') is-invalid @enderror">
                            <option value="">-- choose vehicle type --</option> 
                            @foreach ($vehicle_types as $type)
                                <option value="{{ $type->id }}" @if (old('car_type', $vehicle ? $vehicle['car_type'] : '') == $type->id) selected @endif >{{ $type->name }}</option>
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
                                placeholder="Number of seats" 
                                value="{{ old('number_of_seats', $vehicle ? $vehicle['number_of_seats'] : '') }}" 
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
                        <input type="text" 
                                placeholder="Price per day (€)" 
                                value="{{ old('price_per_day', $vehicle ? $vehicle['price_per_day'] : '') }}" 
                                class="form-control @error('price_per_day') is-invalid @enderror" 
                                name="price_per_day">
                        @error('price_per_day')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="pl-0 mt-4">
                        <label for="remarks">Additional remarks:</label>
                        <textarea type="text" 
                                    placeholder="Additional remarks" 
                                    class="form-control @error('remarks') is-invalid @enderror" 
                                    name="remarks" 
                                    rows="4">{{ old('remarks', $vehicle ? $vehicle['remarks'] : '') }}</textarea>
                        @error('remarks')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mt-3 float-right">
                        <button type="submit" class="btn btn-primary mb-2">Next</button>
                    </div>
                </form>
                        
            </div>
        </div>
    </div>
@endsection