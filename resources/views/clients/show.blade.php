@extends('layouts.main')
@section('page_title') View a Client @endsection

@section('content') 

    <div class="container-fluid">            
        <h4 class="mt-4">Client with ID {{ $client->id }}</h4>
        <div class="row">
            <div class="col-6">
                <p>Full name: {{ $client->name }}</p>
                <p>Country: {{ $client->country->name }}</p>
                <p>Passport/ID: {{ $client->identification_document_no }}</p>
                <p>Phone: {{ $client->phone_no }} </p>
                <p>Email: {{ $client->email }}</p>
                <p>Date of first reservation: {{ $client->date_of_first_reservation }}</p>
                <p>Date of last reservation: {{ $client->date_of_last_reservation }}</p>
                <p>Additional remarks: {{ $client->remarks }}</p>
            </div>
        </div>
    </div>


@endsection