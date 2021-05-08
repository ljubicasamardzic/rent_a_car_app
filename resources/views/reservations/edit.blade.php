@extends('layouts.main')

@section('page_title') Edit a Reservation @endsection

@section('content')
<script> 
    function call(e){
        let id = e.getAttribute('data-id')
        let status = e.checked
        let checkbox = document.querySelector('.equipment-quantity[data-id="' + id + '"]');

        checkbox.disabled = !status;

        checkbox.disabled == false ? checkbox.required = true : checkbox.required = false;

        document.querySelector('.equipment-quantity[data-id="' + id + '"]').value = null;
    }
</script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <h4 class="mt-4">Edit the Reservation with ID {{ $reservation->id }}</h4>
                <form action="/reservations/{{ $reservation->id }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <select type="text" name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                            <option value="">-- choose the client --</option> 
                            @foreach ($clients as $client)     
                                <option value="{{ $client->id }}" 
                                    {{ old('client_id', $reservation->client_id) == $client->id ? 'selected' : ''}}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <select type="text" name="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror">
                            <option value="">-- choose the vehicle --</option> 
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" 
                                    {{ old('vehicle_id', $reservation->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->plate_no }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="rent_date">Start Date:</label>
                        <input type="date" 
                                value="{{ old('rent_date', $reservation->from_date) }}" 
                                name="rent_date" 
                                class="form-control @error('rent_date') is-invalid @enderror">
                        @error('rent_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="return_date">Return Date:</label>
                        <input type="date" 
                                value="{{ old('return_date', $reservation->to_date) }}" 
                                name="return_date" 
                                class="form-control @error('return_date') is-invalid @enderror">
                        @error('return_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <div class="mt-4">
                        <label for="rent_location">Pick-up Location:</label>
                        <select type="text" 
                                name="rent_location" 
                                class="form-control @error('rent_location') is-invalid @enderror">
                            <option value="">-- pick-up options --</option> 
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" 
                                    {{ old('rent_location', $reservation->rent_location_id) == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('rent_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="return_location">Return Location:</label>
                        <select type="text" 
                                name="return_location" 
                                class="form-control @error('return_location') is-invalid @enderror">
                            <option value="">-- return options --</option> 
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" 
                                    {{ old('return_location', $reservation->return_location_id) == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('return_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label class="mt-4" for="equipment">Add Additional Equipment:</label>
                        @foreach ($equipment as $item)
                            <div class="mt-4">
                                <div class="input-group">
                                    <label class="input-group-text mr-2" style="width: 250px">{{ $item->name }}</label>
                                    <select name="e_{{ $item->id }}" class="form-control">
                                        <option value="">select quantity</option>
                                        @for ($i = 1; $i <= $item->max_quantity; $i++)
                                            {{-- calls function to check if equipment id exists in the equipment reservation table --}}
                                            {{-- if so, if the quantity returned by the function equals that of the current dropdown menu option, select it --}}
                                            <option value="{{ $i }}" {{ old("e_$item->id", $reservation->reservationEquipmentQuantity($item->id)) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <div class="mt-4">
                        <button class="btn btn-primary btn-block mt-3 mb-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection