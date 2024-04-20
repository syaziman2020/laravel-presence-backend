@extends('layouts.app')

@section('title', 'User Settings')

@section('content')

    @include('pages.users.add')
    @include('sweetalert::alert')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    User
                </h5>
                <button class="btn btn-primary rounded-pill mt-4" data-bs-toggle="modal" data-bs-target="#default">Add
                    user</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">

                            <div class="col-sm-12 col-md-6">
                                <form action="{{ route('user.index') }}" method="GET">
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
                                            <th tabindex="0" colspan="1" style="width: 250.344px;">Email</th>
                                            <th tabindex="0" colspan="1" style="width: 127.719px;">Phone</th>
                                            <th tabindex="0" colspan="1" style="width: 137.609px;">Role</th>
                                            <th tabindex="0" colspan="1" style="width: 11.4688px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone ?? '-' }}</td>
                                                <td><span class="badge bg-success">{{ $user->role }}</span></td>
                                                <td>
                                                    <button href="" class="btn icon btn-primary"><i
                                                            class="bi bi-pencil"></i></button>

                                                    <button onclick="confirmDelete('{{ $user->id }}')" href=""
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
                                    Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of
                                    {{ $users->total() ?? 0 }}
                                    entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                    <ul class="pagination pagination-primary">
                                        <li class="paginate_button page-item {{ $users->onFirstPage() ? 'disabled' : '' }}"
                                            id="table1_previous">
                                            <a href="{{ $users->previousPageUrl() }}" aria-controls="table1"
                                                aria-disabled="{{ $users->onFirstPage() ? 'true' : 'false' }}"
                                                role="link" tabindex="{{ $users->onFirstPage() ? '-1' : '0' }}"
                                                class="page-link">Previous</a>
                                        </li>

                                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                            <li
                                                class="paginate_button page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $url }}" aria-controls="table1" role="link"
                                                    aria-current="{{ $page == $users->currentPage() ? 'page' : '' }}"
                                                    tabindex="0" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        <li class="paginate_button page-item {{ $users->hasMorePages() ? '' : 'disabled' }}"
                                            id="table1_next">
                                            <a href="{{ $users->nextPageUrl() }}" aria-controls="table1"
                                                aria-disabled="{{ $users->hasMorePages() ? 'false' : 'true' }}"
                                                role="link" tabindex="{{ $users->hasMorePages() ? '0' : '-1' }}"
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
            function addUser() {
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
                            title: 'User added successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan SweetAlert untuk error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error,
                            confirmButtonColor: '#435EBE'
                        });
                    }
                });
            }

            $('#dataForm').on('submit', addUser);

            function confirmDelete(userId) {
                Swal.fire({
                    title: 'Delete',
                    text: 'Are you sure you want to delete this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#BB2D3B',
                    cancelButtonColor: '#435EBE',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/user/' + userId,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'User has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: '#435EBE',

                                });
                                location.reload(); // Refresh halaman setelah penghapusan
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!', error, 'error');
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
