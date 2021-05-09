@extends('layouts.main')

@section('page_title') Edit a Client @endsection

@section('content')

    <div class="container-fluid">
        <div>
            <h3 class="mt-3">Edit a Client</h3>
        </div>

        <form action="/clients/{{ $client->id }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="col-md-4 pl-0">
                <label for="full_name">Full name:</label>
                <input type="text" value="{{ $client->name }}" name="full_name" class="form-control @error('full_name') is-invlid @enderror">
                @error('full_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
 
            <div class="col-md-4 pl-0 mt-4">
                <label for="country_id">Country:</label>
                <select name="country_id" class="form-control @error('country_id') is-invalid @enderror">
                    <option value="">-- countries --</option> 
                    @foreach ($countries as $country)
                        <option value="{{ old('country_id', $country->id) }}" 
                            {{ $client->country_id == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>

                @error('country_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
                
            <div class="col-md-4 pl-0 mt-4">
                <label for="identification_document_no">Passport/ID:</label>
                <input value="{{ old('identification_document_no', $client->identification_document_no) }}" 
                        class="form-control @error('identification_document_no') is-invalid @enderror" 
                        name="identification_document_no">
                
                @error('identification_document_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 pl-0 mt-4">
                <label for="phone_no">Phone:</label>
                <input type="text" 
                        value="{{ old('phone_no', $client->phone_no) }}" 
                        class="form-control @error('phone_no') is-invalid @enderror" 
                        name="phone_no">
                
                @error('phone_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 pl-0 mt-4">
                <label for="email">Email:</label>
                <input type="email" 
                        value="{{ old('email', $client->email) }}" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email">
                </input>
                
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 pl-0 mt-4">
                <label for="date_of_first_reservation">Date of first reservation:</label>
                <input type="date" 
                        value="{{ old('date_of_first_reservation', $client->date_of_first_reservation) }}" 
                        class="form-control @error('date_of_first_reservation') is-invalid @enderror" 
                        name="date_of_first_reservation">
                </input>
                
                @error('date_of_first_reservation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 pl-0 mt-4">
                <label for="date_of_last_reservation">Date of last reservation:</label>
                <input type="date" 
                        value="{{ old('date_of_last_reservation', $client->date_of_last_reservation) }}" 
                        class="form-control @error('date_of_last_reservation') is-invalid @enderror" 
                        name="date_of_last_reservation">
                </input>
                
                @error('date_of_last_reservation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-4 pl-0 mt-4">
                <label for="remarks">Additional remarks:</label>
                <textarea name="remarks" rows="4" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks', $client->remarks) }}</textarea>
            </div>

            <div class="col-md-4 pl-0 mt-4">
                <button class="btn btn-primary btn-block mt-3 mb-4">Update</button>
            </div>
        </form>

    </div>
    
@endsection