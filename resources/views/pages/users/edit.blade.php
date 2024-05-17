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
                                <label for="first-name-horizontal">Password Change</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password" type="password">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Phone</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="phone" id="phone_edit"
                                    placeholder="Phone">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Position</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="position" id="position_edit"
                                    placeholder="Position">
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Department</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="department" id="department_edit"
                                    placeholder="Department">
                            </div>
                            <div class="col-md-4">
                                <label for="role-horizontal">Role<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select id="role_edit" name="role" class="s_edit2 form-select" required
                                    data-placeholder="Pilih Role">
                                    <option value="admin">
                                        Admin
                                    </option>
                                    <option value="user">
                                        User
                                    </option>
                                </select>

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
