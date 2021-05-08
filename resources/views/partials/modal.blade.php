<!-- Modal -->
<div class="modal fade" id="@yield('modal_id')" tabindex="-1" aria-labelledby="dlt_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dlt_modalLabel">Delete a Client</h5>
                <button type="button" class="btn" onclick="@yield('close_func')"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p>Deleting a client will delete all reservations connected to them.</p>
                <p>Are you sure you want to delete this client?</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" onclick="@yield('close_func')">Cancel</a>
                <form action="@yield('delete_route')" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>