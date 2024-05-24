@extends('layouts.app')

@section('title', 'Permission Detail')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h6>Nama</h6>
                    <p>{{ $permission->user->name }}
                    </p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Email</h6>
                    <p>{{ $permission->user->email }}</p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Position</h6>
                    <p>{{ $permission->user->position }}</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h6>Department</h6>
                    <p>{{ $permission->user->department }}</p>

                </div>

                <div class="col-md-6 mb-4">
                    <h6>Date Permission</h6>
                    <p>{{ $permission->date_permission }}</p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Is Approval</h6>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col">
                                <form id="dataForm" class="form form-horizontal" method="POST"
                                    action="{{ route('permission-approved', $permission->id) }}">
                                    @csrf
                                    <select id="is_approved" name="is_approved" class="s_edit2 form-select"
                                        data-placeholder="Select Approval">
                                        <option value="1" {{ $permission->is_approved ? 'selected' : '' }}>Approved
                                        </option>
                                        <option value="0" {{ !$permission->is_approved ? 'selected' : '' }}>Not
                                            Approved</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col">
                                <button id="saveBtn" type="button" onclick="isApproved(event)"
                                    class="btn btn-primary ms-1">Submit</button>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-6 mb-4">
                    <h6>Supporting Evidence</h6>
                    <img src="{{ $permission->image ? asset('storage/permissions/' . $permission->image) : asset('backend/assets/static/images/logo/no_image.png') }}"
                        alt="Suporting Evidence" width="350rem">

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Reason</h6>
                    <p>{{ $permission->reason }}</p>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('backend/assets/compiled/js/app.js') }}"></script>
        <script src="{{ asset('backend/assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            function isApproved() {
                event.preventDefault();
                // Mengirimkan form menggunakan AJAX
                $.ajax({
                    url: $('#dataForm').attr('action'),
                    type: 'POST',
                    data: $('#dataForm').serialize(),
                    success: function(response) {
                        // Menampilkan SweetAlert untuk sukses
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload(); // Reload the page after Swal completes
                        });
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan SweetAlert untuk error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message,
                            confirmButtonColor: '#435EBE'
                        });
                    }
                });
            }

            $('#dataForm').on('submit', isApproved);
        </script>
    @endpush

@endsection
