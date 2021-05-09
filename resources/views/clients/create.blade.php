@extends('layouts.main')

@section('page_title') Add a Client @endsection

@section('content')

<div class="container-fluid">
    <div>
        <h3 class="mt-3">Add a New Client</h3>
    </div>

    <form action="/clients" method="POST" class="mt-3">
        @csrf

        <div class="col-md-4 pl-0">
            <input type="text" 
                    placeholder="First Name" 
                    value="{{ old('first_name') }}" 
                    name="first_name" 
                    class="form-control @error('first_name') is-invalid @enderror">

            @error('first_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <input type="text" 
                    placeholder="Last Name" 
                    value="{{ old('last_name') }}" 
                    name="last_name" 
                    class="form-control @error('last_name') is-invalid @enderror">

            @error('last_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="col-md-4 pl-0 mt-4">
            <select type="text" 
                    placeholder="Country" 
                    name="country_id" 
                    class="form-control 
                    @error('country_id') is-invalid @enderror">

                <option value="">-- choose the country --</option> 
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>

            @error('country_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
            
        <div class="col-md-4 pl-0 mt-4">
            <input type="text" 
                    placeholder="Passport/ID" 
                    value="{{ old('identification_document_no') }}" 
                    class="form-control @error('identification_document_no') is-invalid @enderror" 
                    name="identification_document_no">

            @error('identification_document_no')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <input type="text" 
                    placeholder="Phone Number" 
                    value="{{ old('phone_no') }}" 
                    class="form-control @error('phone_no') is-invalid @enderror" 
                    name="phone_no">

            @error('phone_no')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <input type="email" 
                    placeholder="Email" 
                    value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    name="email">

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <label for="date_of_first_reservation">Choose date of first reservation:</label>
            <input type="date" 
                    placeholder="Date of first reservation" 
                    value="{{ old('date_of_first_reservation') }}" 
                    class="form-control @error('date_of_first_reservation') is-invalid @enderror" 
                    name="date_of_first_reservation">

            @error('date_of_first_reservation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <label for="date_of_first_reservation">Choose date of last reservation:</label>
            <input type="date" 
                    placeholder="Date of last reservation" 
                    value="{{ old('date_of_last_reservation') }}" 
                    class="form-control @error('date_of_last_reservation') is-invalid @enderror" 
                    name="date_of_last_reservation">

            @error('date_of_last_reservation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <textarea type="text" 
                        placeholder="Additional Remarks" 
                        class="form-control @error('remarks') is-invalid @enderror" 
                        name="remarks" 
                        rows="4">{{ old('remarks') }}</textarea>

            @error('remarks')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-4 pl-0 mt-4">
            <button class="btn btn-primary btn-block mt-3 mb-4">Create</button>
        </div>
    </form>

</div>
 
@endsection