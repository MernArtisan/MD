@extends('layouts.master')
@section('title', 'Details')

@section('content')
    {{-- {{dd($property)}} --}}
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- ========== Page Title Start ========== -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-0 fw-semibold">Property Overview</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                            <li class="breadcrumb-item active">Property Overview</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- ========== Page Title End ========== -->

            <div class="row">
                {{-- <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header bg-light-subtle">
                            <h4 class="card-title">Property Owner Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}" alt=""
                                    class="avatar-xl rounded-circle border border-2 border-light mx-auto">
                                <div class="mt-2">
                                    <a href="#!" class="fw-medium text-dark fs-16">Gaston Lapierre</a>
                                    <p class="mb-0">(Owner)</p>
                                </div>
                                <div class="mt-3">
                                    <ul class="list-inline justify-content-center d-flex gap-1 mb-0 align-items-center">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-primary fs-20">
                                                <i class='ri-facebook-fill'></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-danger fs-20">
                                                <i class='ri-instagram-fill'></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-info fs-20">
                                                <i class='ri-twitter-fill'></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-success fs-20">
                                                <i class='ri-whatsapp-fill'></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light-subtle">
                            <div class="row g-2">
                                <div class="col-lg-6">
                                    <a href="#!" class="btn btn-primary w-100"><iconify-icon
                                            icon="solar:phone-calling-bold-duotone"
                                            class="align-middle fs-18"></iconify-icon> Call Us</a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#!" class="btn btn-success w-100"><iconify-icon
                                            icon="solar:chat-round-dots-bold-duotone"
                                            class="align-middle fs-16"></iconify-icon> Message</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-light-subtle">
                            <h4 class="card-title">Schedule A Tour</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <input type="text" id="schedule-date" class="form-control" placeholder="dd-mm-yyyy">
                                </div>
                                <div class="mb-3">
                                    <input type="text" id="schedule-time" class="form-control" placeholder="12:00 PM">
                                </div>
                                <div class="mb-3">
                                    <input type="text" id="schedule-name" name="schedule-name" class="form-control"
                                        placeholder="Your Full Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" id="schedule-email" name="schedule-email" class="form-control"
                                        placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="number" id="schedule-number" name="schedule-number" class="form-control"
                                        placeholder="Number">
                                </div>
                                <div>
                                    <textarea class="form-control" id="schedule-textarea" rows="5" placeholder="Message"></textarea>
                                </div>
                            </form>

                        </div>
                        <div class="card-footer bg-light-subtle">
                            <a href="#!" class="btn btn-primary w-100">Send Information</a>
                        </div>
                    </div>
                </div> --}}

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="propertyCarousel-{{ $property->id }}" class="carousel slide position-relative"
                                data-bs-ride="carousel">
                                <div class="carousel-inner rounded">
                                    @foreach ($property->galleries as $index => $gallery)
                                        <div class="carousel-item @if ($index === 0) active @endif">
                                            <img src="{{ asset($gallery->image) }}" alt="Gallery Image {{ $index + 1 }}"
                                                class="img-fluid w-100 rounded" style="height: 300px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                {{-- Navigation Arrows --}}
                                @if (count($property->galleries) > 1)
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#propertyCarousel-{{ $property->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#propertyCarousel-{{ $property->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                @endif

                                {{-- Top Left Badge --}}
                                <span class="position-absolute top-0 start-0 p-2">
                                    <span class="badge bg-warning text-light px-2 py-1 fs-13">For
                                        {{ $property->property_type }}</span>
                                </span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-between my-3 gap-2">
                                <div>
                                    <a href="#!" class="fs-18 text-dark fw-medium">{{ $property->property_name }}</a>
                                    <p class="d-flex align-items-center gap-1 mt-1 mb-0"><iconify-icon
                                            icon="solar:map-point-wave-bold-duotone"
                                            class="fs-18 text-primary"></iconify-icon>{{ $property->location }}</p>
                                </div>
                                <div>
                                    <ul class="list-inline float-end d-flex gap-1 mb-0 align-items-center">
                                        <li class="list-inline-item fs-20 dropdown">
                                            <a href="javascript: void(0);"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-dark fs-20"
                                                data-bs-toggle="modal" data-bs-target="#videocall">
                                                <iconify-icon icon="solar:share-bold-duotone"></iconify-icon>
                                            </a>
                                        </li>

                                        <li class="list-inline-item fs-20 dropdown">
                                            <a href="javascript: void(0);"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-danger fs-20"
                                                data-bs-toggle="modal" data-bs-target="#voicecall">
                                                <iconify-icon icon="solar:heart-angle-bold-duotone"></iconify-icon>
                                            </a>
                                        </li>

                                        <li class="list-inline-item fs-20 dropdown">
                                            <a data-bs-toggle="offcanvas" href="#user-profile"
                                                class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-warning fs-20">
                                                <iconify-icon icon="solar:star-bold-duotone"></iconify-icon>
                                            </a>
                                        </li>

                                        <li class="list-inline-item fs-20 dropdown d-none d-md-flex">
                                            <a href="javascript: void(0);" class="dropdown-toggle arrow-none text-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript: void(0);"><i
                                                        class="ri-user-6-line me-2"></i>View Profile</a>
                                                <a class="dropdown-item" href="javascript: void(0);"><i
                                                        class="ri-music-2-line me-2"></i>Media, Links and Docs</a>
                                                <a class="dropdown-item" href="javascript: void(0);"><i
                                                        class="ri-search-2-line me-2"></i>Search</a>
                                                <a class="dropdown-item" href="javascript: void(0);"><i
                                                        class="ri-image-line me-2"></i>Wallpaper</a>
                                                <a class="dropdown-item" href="javascript: void(0);"><i
                                                        class="ri-arrow-right-circle-line me-2"></i>More</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm bg-success-subtle rounded">
                                    <iconify-icon icon="solar:wallet-money-bold-duotone"
                                        class="fs-24 text-success avatar-title"></iconify-icon>
                                </div>
                                <p class="fw-medium text-dark fs-18 mb-0">{{ $property->pricing }}</p>
                                <div class="avatar-sm bg-success-subtle rounded">
                                    <iconify-icon icon="solar:phone-calling-bold-duotone"
                                        class="fs-24 text-success avatar-title"></iconify-icon>
                                </div>
                                <p class="fw-medium text-dark fs-18 mb-0">{{ $property->phone }}</p>
                            </div>
                            <div class="bg-light-subtle p-2 mt-3 rounded border border-dashed">
                                <div class="row align-items-center text-center g-2">
                                    <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                        <p
                                            class="text-muted mb-0 fs-15 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="mdi:bed" class="fs-18 text-primary"></iconify-icon>
                                            {{ $property->beds }} Bedroom
                                        </p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                        <p
                                            class="text-muted mb-0 fs-15 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="mdi:shower" class="fs-18 text-primary"></iconify-icon>
                                            {{ $property->baths }} Bathrooms
                                        </p>
                                    </div>
                                    
                                    <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                        <p
                                            class="text-muted mb-0 fs-15 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="mdi:home-city-outline"
                                                class="fs-18 text-primary"></iconify-icon>
                                            For {{ $property->property_type }}
                                        </p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                        <p
                                            class="text-muted mb-0 fs-15 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="mdi:home-outline"
                                                class="fs-18 text-primary"></iconify-icon>
                                            {{ $property->type }}
                                        </p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-6 col-6">
                                        <p
                                            class="text-muted mb-0 fs-15 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="mdi:check-decagram"
                                                class="fs-18 text-primary"></iconify-icon>
                                            {{ $property->status }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-dark fw-medium mt-3">Some Interests :</h5>
                            <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                                @if (!empty($property->interest))
                                    @php
                                        $interests = json_decode($property->interest, true);
                                    @endphp
                                    <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                                        @foreach ($interests as $interest)
                                            <span
                                                class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">
                                                {{ $interest }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <h5 class="text-dark fw-medium mt-3">Property Description :</h5>
                            <p class="mt-2">{{ $property->description }}</p>
                            <h5 class="text-dark fw-medium mt-3">Property Rules and Regulations :</h5>
                            <p class="mt-2">{{ $property->rules_and_regulations }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <!--<a href="#!" class="link-primary fw-medium">View More Detail <i-->
                                <!--        class="ri-arrow-right-line"></i></a>-->
                                <!--<div>-->
                                <p class="mb-0 d-flex align-items-center gap-1"><iconify-icon
                                        icon="solar:calendar-date-broken" class="fs-18 text-primary"></iconify-icon>
                                    {{ $property->created_at }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row " style="display:none;">
            <div class="col-lg-12">
                <div class="mapouter">
                    <div class="gmap_canvas mb-2"><iframe class="gmap_iframe rounded" width="100%"
                            style="height: 400px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
