@extends('layouts.app')

@section('title', 'Company Details')

@section('content')
    @include('pages.company.edit')
    <div class="card">
        <div class="card-body">
            <button onclick="edit({{ $company->id }})" class="btn btn-primary rounded-pill mb-4"
                data-bs-target="#default">Edit
                Company</button>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h6>Nama Perusahaan</h6>
                    <p>{{ $company->name }}
                    </p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Email Perusahaan</h6>
                    <p>{{ $company->email }}</p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Address</h6>
                    <p>{{ $company->address }}</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h6>Latitude</h6>
                    <p>{{ $company->latitude }}</p>

                </div>

                <div class="col-md-6 mb-4">
                    <h6>Longitude</h6>
                    <p>{{ $company->longitude }}</p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Radius KM</h6>
                    <p>{{ $company->radius_km }}</p>

                </div>


                <div class="col-md-6 mb-4">
                    <h6>Waktu Masuk</h6>
                    <p>{{ $company->time_in }}</p>

                </div>
                <div class="col-md-6 mb-4">
                    <h6>Waktu Keluar</h6>
                    <p>{{ $company->time_out }}</p>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('backend/assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            function edit(id) {
                console.log("test edit");
                event.preventDefault();
                var formData = $('#dataForm_edit').serialize();
                $.ajax({
                    url: '/companies/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        // Memasukkan data ke dalam input di form edit
                        $('#name_edit').val(response.name);
                        $('#email_edit').val(response.email);
                        $('#address_edit').val(response.address);
                        $('#latitude_edit').val(response.latitude);
                        $('#longitude_edit').val(response.longitude);
                        $('#radius_edit').val(response.radius_km);
                        $('#timein_edit').val(response.time_in);
                        $('#timeout_edit').val(response.time_out);
                        // Anda dapat menambahkan baris kode serupa untuk setiap input yang perlu diisi
                        $('#modal_edit').modal('show');

                        // Jika Anda memiliki data lain yang perlu diisi dalam form, sesuaikan kode di atas sesuai dengan kunci respons JSON-nya
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika permintaan Ajax gagal
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message,
                            confirmButtonColor: '#435EBE'
                        });
                    }
                });

                $(document).ready(function() {
                    // Event listener untuk tombol submit
                    $('#saveBtnEdit').click(function(event) {
                        event.preventDefault(); // Mencegah tindakan default tombol submit

                        // Serialize data form
                        var formData = $('#dataForm_edit').serialize();

                        // Kirim data form menggunakan AJAX
                        $.ajax({
                            url: '/companies/' + id,
                            method: 'POST',
                            data: formData,

                            success: function(response) {
                                // Tangani respons sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                window.location.reload();
                                // Tambahkan kode untuk menampilkan pesan sukses atau melakukan tindakan lain yang diperlukan
                            },
                            error: function(xhr, status, error) {

                                // Tangani kesalahan jika permintaan Ajax gagal
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    confirmButtonColor: '#435EBE'
                                });
                            }
                        });
                    });
                });
            }
        </script>
    @endpush

@endsection
