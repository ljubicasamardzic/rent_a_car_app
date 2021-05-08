@extends('layouts.main')

@section('page_title') Availability Check @endsection

@section('content')

    <div class="container-fluid">
        <div class="row ml-2">
                
            <form action="/availability" method="POST" class="form-inline mt-4 row">
                @csrf
                <select name="car_type" id="availability_slt" class="form-control mr-3">
                    <option value="">-- vehicle types --</option>
                    @foreach ($car_types as $car_type)
                        <option value="{{ $car_type->id }}" 
                            {{ old('car_type', ($request ? $request->car_type : '')) == $car_type->id ? 'selected' : ''}}>{{ $car_type->name }}</option>
                    @endforeach
                </select>

                <label for="from_date" class="input-group-text mr-3">From:</label>
                <input type="date" name="from_date" id="from_date" class="form-control mr-3 @error('from_date') is-invalid @enderror" value="{{ old('from_date', $request ? $request->from_date : '') }}">

                <label for="to_date" class="input-group-text mr-3">To:</label>
                <input type="date" name="to_date" id="to_date" class="form-control mr-3 @error('to_date') is-invalid @enderror" value="{{ old('to_date', $request ? $request->to_date : '') }}">
                <button class="btn btn-primary mr-2">Search</button>
                <a class="btn btn-secondary mr-2" id="reset_btn">Reset</a>
                @error('from_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            @error('to_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </form>    
        
            <table class="table table-responsive table-hover table-striped mt-4" id="availability_tb">
                <thead>
                    <th>Plates</th>
                    <th>Production Year</th>
                    <th>Seat Number</th>
                    <th>Vehicle Type</th>
                    <th>Price per Day</th>
                </thead>
                <tbody id="table_body">
                    @if (!empty($available_vehicles)) 
                        @foreach ($available_vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->plate_no }}</td>
                                <td>{{ $vehicle->production_year }}</td>
                                <td>{{ $vehicle->no_of_seats }}</td>
                                <td>{{ $vehicle->carType->name }}</td>
                                <td>{{ $vehicle->price_per_day }} €</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

     @section('scripts')
        <script>
            let reset_btn = document.getElementById('reset_btn');
            reset_btn.addEventListener('click', () => {
                document.getElementById('from_date').value = '';
                document.getElementById('to_date').value = '';
                document.getElementById('availability_slt').selectedIndex = '-1';
                document.getElementById('table_body').innerHTML = '';
            });
        </script> 
     @endsection
@endsection