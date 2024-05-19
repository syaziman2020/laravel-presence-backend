@extends('layouts.app')

@section('title', 'Attendances')

@section('content')
    @include('pages.attendance.edit')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Attendances
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">

                            <div class="col-sm-12 col-md-6">
                                <form action="{{ route('attendances.index') }}" method="GET">
                                    @csrf
                                    <div id="table1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                class="form-control form-control-sm" placeholder="Input name" name="name"
                                                aria-controls="table1"></label>
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class="bi bi-search"></i></button>

                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="row dt-row">
                            <div class="col-sm-12">
                                <table class="table dataTable no-footer" id="table1" aria-describedby="table1_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="table1"
                                                rowspan="1" colspan="1" style="width: 250.8594px;">Name</th>
                                            <th tabindex="0" colspan="1" style="width: 120.344px;">Date</th>
                                            <th tabindex="0" colspan="1" style="width: 120.719px;">Time In</th>
                                            <th tabindex="0" colspan="1" style="width: 127.719px;">Time Out</th>
                                            <th tabindex="0" colspan="1" style="width: 137.609px;">Latlong In</th>
                                            <th tabindex="0" colspan="1" style="width: 137.609px;">Latlong Out</th>
                                            <th tabindex="0" colspan="1" style="width: 11.4688px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->user->name }}</td>
                                                <td>{{ $attendance->date }}</td>
                                                <td>{{ $attendance->time_in ?? '-' }}</td>
                                                <td>{{ $attendance->time_out ?? '-' }}</td>
                                                <td>{{ $attendance->latlon_in ?? '-' }}</td>
                                                <td>{{ $attendance->latlon_out ?? '-' }}</td>
                                                <td>
                                                    <button onclick="edit({{ $attendance->id }})"
                                                        class="btn icon btn-primary"><i class="bi bi-pencil"></i></button>

                                                    <button onclick="confirmDelete('{{ $attendance->id }}')" href=""
                                                        class="btn icon btn-danger "><i class="bi bi-x"></i></button>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
                                    Showing {{ $attendances->firstItem() ?? 0 }} to {{ $attendances->lastItem() ?? 0 }} of
                                    {{ $attendances->total() ?? 0 }}
                                    entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                    <ul class="pagination pagination-primary">
                                        <li class="paginate_button page-item {{ $attendances->onFirstPage() ? 'disabled' : '' }}"
                                            id="table1_previous">
                                            <a href="{{ $attendances->previousPageUrl() }}" aria-controls="table1"
                                                aria-disabled="{{ $attendances->onFirstPage() ? 'true' : 'false' }}"
                                                role="link" tabindex="{{ $attendances->onFirstPage() ? '-1' : '0' }}"
                                                class="page-link">Previous</a>
                                        </li>

                                        @foreach ($attendances->getUrlRange(1, $attendances->lastPage()) as $page => $url)
                                            <li
                                                class="paginate_button page-item {{ $page == $attendances->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $url }}" aria-controls="table1" role="link"
                                                    aria-current="{{ $page == $attendances->currentPage() ? 'page' : '' }}"
                                                    tabindex="0" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        <li class="paginate_button page-item {{ $attendances->hasMorePages() ? '' : 'disabled' }}"
                                            id="table1_next">
                                            <a href="{{ $attendances->nextPageUrl() }}" aria-controls="table1"
                                                aria-disabled="{{ $attendances->hasMorePages() ? 'false' : 'true' }}"
                                                role="link" tabindex="{{ $attendances->hasMorePages() ? '0' : '-1' }}"
                                                class="page-link">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    @push('scripts')
        <script src="{{ asset('backend/assets/compiled/js/app.js') }}"></script>
        <script src="{{ asset('backend/assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('backend/assets/static/js/pages/datatables.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            function confirmDelete(attendanceId) {
                Swal.fire({
                    title: 'Delete',
                    text: 'Are you sure you want to delete this attendance?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#BB2D3B',
                    cancelButtonColor: '#435EBE',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/attendances/' + attendanceId,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Attendance has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: '#435EBE',

                                });
                                location.reload(); // Refresh halaman setelah penghapusan
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!', xhr.responseJSON.message, 'error');
                            }
                        });
                    }
                });
            }

            function edit(id) {
                event.preventDefault();
                var formData = $('#dataForm_edit').serialize();
                $.ajax({
                    url: '/attendances/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Memasukkan data ke dalam input di form edit
                        $('#name_edit').val(response.name);
                        $('#email_edit').val(response.email);
                        $('#phone_edit').val(response.phone ?? '');
                        $('#position_edit').val(response.position ?? '');
                        $('#department_edit').val(response.department ?? '');
                        $('#role_edit').val(response.role);

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
                            url: '/user/' + id,
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
