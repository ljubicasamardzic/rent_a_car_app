@extends('layouts.main')

@section('page_title') Clients @endsection

@section('subtitle') Clients @endsection
@section('btn_text') Add a New Client @endsection
@section('create_route'){{ 'clients/create' }}@endsection

@section('content')

@include('partials.navigation')

    <div class="container-fluid">
        <div class="row">
            <table class="table table-responsive-sm table-hover table-striped mt-3 w-85">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Passport/ID</th>
                        <th>Phone</th>                    
                        <th>Email</th>
                        <th>First Reservation</th>
                        <th>Last Reservation</th>
                        <th>Remarks</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                       
                        {{-- @section('modal')@endsection
                        @section('id') {{ $client->id }} @endsection --}}

                         <!-- Modal -->
                        {{-- <div class="modal fade" id="dlt_modal{{ $client->id }}" tabindex="-1" aria-labelledby="dlt_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dlt_modalLabel">Delete a Client</h5>
                                        <button type="button" class="btn" onclick="closeModal({{ $client->id }});"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deleting a client will delete all reservations connected to them.</p>
                                        <p>Are you sure you want to delete this client?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-primary" onclick="closeModal({{ $client->id }});">Cancel</a>
                                        <form action="/clients/{{ $client->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @section('modal_id'){{ 'dlt_modal'.$client->id }}@endsection
                        @section('close_func'){{ 'closeModal('.$client->id.')' }}@endsection
                        @section('delete_route'){{ '/clients/'.$client->id }}@endsection
                            
                        @include('partials.modal')

                        <tr>
                            <td>{{ $client->id}}</td>
                            <td><a href="/clients/{{ $client->id }}">{{ $client->name }}</a></td>
                            <td>{{ $client->country->name }}</td>
                            <td>{{ $client->identification_document_no }}</td>
                            <td>{{ $client->phone_no }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->date_of_first_reservation }}</td>
                            <td>{{ $client->date_of_last_reservation }}</td>
                            <td>{{ $client->remarks }}</td>
                            <td><a href="/clients/{{ $client->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
                            <td>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#dlt_modal" onclick="showModal({{ $client->id }});"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>            
        <div class="d-flex flex-row justify-content-center">{{ $clients->links() }}</div>
    
    </div>

    @section('scripts')

    <script type="text/javascript">
        function showModal(id) {
            $('#dlt_modal' + id).modal('show');
        }

        function closeModal(id) {
            $('#dlt_modal' + id).modal('hide');
        }
    </script>
    
    @endsection
@endsection