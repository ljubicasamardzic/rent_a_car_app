@extends('layouts.main')

@section('page_title') Vehicles @endsection

@section('subtitle') Vehicles @endsection
@section('btn_text') Add a New Vehicle @endsection
@section('create_route'){{ 'vehicles/create-one' }}@endsection

@section('content')

@include('partials.navigation')

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

    <div class="container-fluid">
        <div class="row">
            <table class="table table-responsive-sm table-hover table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Plates</th>
                        <th>Production Year</th>
                        <th>Vehicle Type</th>
                        <th>Seats</th>
                        <th>Price/Day</th>
                        <th>Additional Remarks</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)

                         <!-- Modal -->
                         {{-- <div class="modal fade" id="dlt_modal{{ $vehicle->id }}" tabindex="-1" aria-labelledby="dlt_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dlt_modalLabel">Delete a Vehicle</h5>
                                        <button type="button" class="btn" onclick="closeModal({{ $vehicle->id }});"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deleting a vehicle will delete all reservations and photos related to it.</p>
                                        <p>Are you sure you want to delete this vehicle?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-primary" onclick="closeModal({{ $vehicle->id }});">Cancel</a>
                                        <form action="/vehicles/{{ $vehicle->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        @section('modal_id'){{ 'dlt_modal'.$vehicle->id }}@endsection
                        @section('close_func'){{ 'closeModal('.$vehicle->id.')' }}@endsection
                        @section('delete_route'){{ '/vehicles/'.$vehicle->id }}@endsection
                            
                        @include('partials.modal')

                        <tr>
                            <td>{{ $vehicle->id}}</td>
                            <td><a href="/vehicles/{{ $vehicle->id }}">{{ $vehicle->plate_no }}</a></td>
                            <td>{{ $vehicle->production_year }}</td>
                            <td>{{ $vehicle->carType->name }}</td>
                            <td>{{ $vehicle->no_of_seats }}</td>
                            <td>{{ $vehicle->price_per_day }} €</td>
                            <td>{{ $vehicle->remarks }}</td>
                            <td><a href="/vehicles/{{ $vehicle->id }}/edit-one" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="showModal({{ $vehicle->id }})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row justify-content-center">{{ $vehicles->links() }}</div>
    </div>

@endsection