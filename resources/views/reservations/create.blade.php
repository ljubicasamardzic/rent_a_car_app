@extends('layouts.main')

@section('page_title') New Reservation @endsection

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
                <h4 class="mt-4">Make a New Reservation</h4>
                <form action="/reservations" method="POST" class="mt-3">
                    @csrf
                    <div class="mt-4">
                        <select type="text" name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                            <option value="">-- choose the client --</option> 
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
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
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate_no }}</option>
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
                                value="{{ old('rent_date') }}" 
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
                                value="{{ old('return_date') }}" 
                                name="return_date" 
                                class="form-control @error('return_date') is-invalid @enderror"
                        >
                        @error('return_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   
                    <div class="mt-4">
                        <select type="text" name="rent_location" class="form-control @error('rent_location') is-invalid @enderror">
                            <option value="">-- pick-up options --</option> 
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ old('rent_location') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('rent_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <select type="text" name="return_location" class="form-control @error('return_location') is-invalid @enderror">
                            <option value="">-- return options --</option> 
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ old('return_location') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('return_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                        {{-- <table class="mt-2" id="table">
                                <label class="mt-4" for="equipment">Add Additional Equipment:</label>
                                @foreach ($equipment as $item)
                                    <tr>
                                        <td>
                                            <input class="mr-2" name="check[{{ $item->id }}]" {{ (old('check.'.$item->id) == true) ? 'checked': '' }} type="checkbox" data-id="{{ $item->id }}" onclick="call(this);">
                                        </td>
                                        <td>
                                            <label class="form-check-label">{{ $item->name }}</label>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                    data-id="{{ $item->id }}"  
                                                    value="{{ old('equipment.'.$item->id) }}" 
                                                    name="equipment[{{ $item->id }}]" 
                                                    placeholder="Quantity (max {{ $item->max_quantity }})" 
                                                    class="form-control ml-3 equipment-quantity @error('equipment.'.$item->id) is-invalid @enderror" 
                                                    {{ (old('check.'.$item->id) == true) ?  '' : 'disabled' }}>
                                        </td>
                                        
                                    </tr> 
                                    @error('equipment.'.$item->id)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endforeach
                        </table> --}}

                    <div class="mt-2">
                        <label class="mt-4" for="equipment">Add Additional Equipment:</label>
                        @foreach ($equipment as $item)
                            <div class="mt-4">
                                <div class="input-group">
                                    <label class="input-group-text mr-2" style="width: 250px">{{ $item->name }}</label>
                                    <select name="e_{{ $item->id }}" class="form-control">
                                        <option value="">select quantity</option>
                                        @for ($i = 1; $i <= $item->max_quantity; $i++)
                                            <option value="{{ $i }}" {{ old("e_$item->id") == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <div class="mt-4">
                        <button class="btn btn-primary btn-block mt-3 mb-4">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
@endsection 