@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card shadow rounded-4 border-0">
                        <div class="card-body p-4">
                            <div class="text-center position-relative mb-4">
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset(Auth::user()->image) }}" alt="Profile Photo"
                                        class="avatar-xl rounded-circle border border-3 border-light shadow">
                                    <span
                                        class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-white"></span>
                                </div>
                                <h4 class="mt-3 mb-1 fw-bold">{{ Auth::user()->name }}</h4>
                                <span class="text-muted">{{ Auth::user()->email }}</span>
                            </div>

                            <div class="row g-3 mt-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="phone" class="me-2 text-primary"></i>
                                        <span class="fw-medium text-dark">Contact:</span>
                                        <span class="ms-2 text-muted">{{ Auth::user()->phone ?? '-' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="home" class="me-2 text-primary"></i>
                                        <span class="fw-medium text-dark">Address:</span>
                                        <span class="ms-2 text-muted text-wrap"
                                            style="word-break: break-word; white-space: normal;">
                                            {{ Auth::user()->address ?? '-' }}
                                        </span>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="flag" class="me-2 text-primary"></i>
                                        <span class="fw-medium text-dark">Country:</span>
                                        <span class="ms-2 text-muted">{{ Auth::user()->country ?? '-' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="map-pin" class="me-2 text-primary"></i>
                                        <span class="fw-medium text-dark">State:</span>
                                        <span class="ms-2 text-muted">{{ Auth::user()->state ?? '-' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="navigation" class="me-2 text-primary"></i>
                                        <span class="fw-medium text-dark">City:</span>
                                        <span class="ms-2 text-muted">{{ Auth::user()->city ?? '-' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="hash" class="me-2 text-primary"></i>
                                        <span class="fw-medium text-dark">Zip:</span>
                                        <span class="ms-2 text-muted">{{ Auth::user()->zip ?? '-' }}</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-start">
                                        <i data-feather="file-text" class="me-2 text-primary mt-1"></i>
                                        <div>
                                            <span class="fw-medium text-dark">Bio:</span>
                                            <p class="text-muted mt-1 mb-0">{{ Auth::user()->bio ?? 'No bio provided.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sample tag for property type -->
                                {{-- <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i data-feather="star" class="me-2 text-warning"></i>
                                    <span class="fw-medium text-dark">Interest Type:</span>
                                    <span class="badge bg-primary ms-2">Luxury Villas</span>
                                </div>
                            </div> --}}
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                    <i data-feather="edit" class="me-1"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
