<div id="modal_edit" class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Edit User</h5>
                <button type="button" class="close rounded-pill" data-bs-toggle="modal_edit" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="dataForm_edit" class="form form-horizontal" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-body">
                        <div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="name" id="name_edit"
                                    placeholder="Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Email<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="email" id="email_edit"
                                    placeholder="Email" required>
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Address<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="address" id="address_edit"
                                    placeholder="Address" required>
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Latitude<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="number" class="form-control" name="latitude" id="latitude_edit"
                                    placeholder="Latitude">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Longitude<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="number" class="form-control" name="longitude" id="longitude_edit"
                                    placeholder="Position">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Radius KM<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="number" class="form-control" name="radius_km" id="radius_edit"
                                    placeholder="Radius KM">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Time In<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="time" class="form-control" name="time_in" id="timein_edit"
                                    placeholder="Time In" step="1">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Time Out<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="time" class="form-control" name="time_out" id="timeout_edit"
                                    placeholder="Time Out" step="1">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cancel</span>
                </button>

                <button id="saveBtnEdit" type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Submit</span>
                </button>
            </div>
        </div>
    </div>
</div>
