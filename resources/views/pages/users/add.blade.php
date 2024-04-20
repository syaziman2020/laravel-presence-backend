<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Add User</h5>
                <button type="button" class="close rounded-pill" data-bs-toggle="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="dataForm" class="form form-horizontal" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="first-name-horizontal" class="form-control" name="name"
                                    id="name" placeholder="Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Email<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="first-name-horizontal" class="form-control" name="email"
                                    id="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Password<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="first-name-horizontal" class="form-control" name="password"
                                    id="password" placeholder="Password" type="password" required>
                            </div>
                            <div class="col-md-4">
                                <label for="first-name-horizontal">Phone</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="first-name-horizontal" class="form-control" name="phone"
                                    id="phone" placeholder="Phone">
                            </div>

                            <div class="col-md-4">
                                <label for="role-horizontal">Role<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select id="role" name="role" class="s_edit2 form-select" required
                                    data-placeholder="Pilih Role">
                                    <option value="admin">
                                        Admin
                                    </option>
                                    <option value="user" selected>
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

                <button id="saveBtn" type="button" onclick="addUser(event)" class="btn btn-primary ms-1"
                    data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Submit</span>
                </button>
            </div>
        </div>
    </div>
</div>
