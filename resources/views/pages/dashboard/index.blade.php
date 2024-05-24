@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Attendances Today</h6>
                                    <h6 class="font-extrabold mb-0">{{ $attendancesCount ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Permissions Approved</h6>
                                    <h6 class="font-extrabold mb-0">{{ $permissionApproved->count() ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Permissions Not Approved</h6>
                                    <h6 class="font-extrabold mb-0">{{ $permissionNotApproved->count() ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $usersCount ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Users who are not present today</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">

                                    <tbody>
                                        @forelse ($attendances as $attendance)
                                            <tr>
                                                <td class="col-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img
                                                                src="{{ $attendance->image_url ? asset('storage/images/' . $attendance->image_url) : asset('backend/assets/static/images/logo/no_image.png') }}">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">{{ $attendance->name ?? '-' }}</p>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="col-1">
                                                    <div class="d-flex align-items-center">

                                                        <p class="font-bold ms-3 mb-0">all present</p>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ auth()->user()->image_url ? asset('storage/images/' . auth()->user()->image_url) : asset('backend/assets/static/images/logo/no_image.png') }}"
                                alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ auth()->user()->name ?? '-' }}</h5>
                            <h6 class="text-muted mb-0">{{ auth()->user()->email ?? '-' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Permission Not Approved</h4>
                </div>
                <div class="card-content pb-4">
                    @forelse ($permissionNotApproved as $item)
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img
                                    src="{{ $item->user->image_url ? asset('storage/images/' . $item->user->image_url) : asset('backend/assets/static/images/logo/no_image.png') }}">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">{{ $item->user->name }}</h5>
                                <h6 class="text-muted mb-0">{{ $item->date_permission }}</h6>
                            </div>
                        </div>
                    @empty
                        <div class="recent-message d-flex px-4 py-3">

                            <div class="name ms-4">
                                <h5 class="mb-1">Empty</h5>

                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </section>
@endsection
