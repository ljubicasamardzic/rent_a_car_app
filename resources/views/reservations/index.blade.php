@extends('layouts.main')

@section('page_title') Premium Car Rent @endsection

@section('subtitle') Reservations @endsection
@section('btn_text') Add a New Reservation @endsection
@section('create_route'){{'reservations/create'}}@endsection

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
            <table class="table table-responsive-sm table-hover table-striped mt-3 w-85">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Vehicle Plates</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Rent Location</th>
                        <th>Return Location</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $res)
                        <!-- Modal -->
                        {{-- <div class="modal fade" id="dlt_modal{{ $res->id }}" tabindex="-1" aria-labelledby="dlt_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dlt_modalLabel">Delete a Reservation</h5>
                                        <button type="button" class="btn" onclick="closeModal({{ $res->id }});"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>If you delete this reservation you will lose all data related to it.</p>
                                        <p>Are you sure you want to proceed?</p>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-primary" onclick="closeModal({{ $res->id }});">Cancel</a>
                                        <form action="/reservations/{{ $res->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        @section('modal_id'){{ 'dlt_modal'.$res->id }}@endsection
                        @section('close_func'){{ 'closeModal('.$res->id.')' }}@endsection
                        @section('delete_route'){{ '/reservations/'.$res->id }}@endsection
                            
                        @include('partials.modal')

                        <tr>
                            <td>{{ $res->id }}</td>
                            <td>{{ $res->client->name }}</td>
                            <td>{{ $res->vehicle->plate_no }}</td>
                            <td>{{ date("d M Y", strtotime($res->from_date)) }}</></td>
                            <td>{{ date("d M Y", strtotime($res->to_date)) }}</td>
                            <td>{{ $res->rentLocation->name }}</td>
                            <td>{{ $res->returnLocation->name }}</td>
                            <td>{{ $res->total_price }} €</td>
                            <td><a href="/reservations/{{ $res->id }}" class="btn btn-dark btn-sm"><i class="fas fa-search-plus"></i></a></td>
                            <td><a href="/reservations/{{ $res->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="showModal({{ $res->id }})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row justify-content-center">{{ $reservations->links() }}</div>
    </div>


@endsection