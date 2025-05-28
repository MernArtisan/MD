@extends('layouts.master')

@section('title', 'List')

@section('content')
    <style>
        .property-image-container {
            width: 100%;
            height: 200px;
            /* Fixed height */
            overflow: hidden;
            position: relative;
        }

        .property-fixed-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Maintains aspect ratio while filling container */
            object-position: center;
            /* Centers the image */
        }
    </style>
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- ========== Page Title Start ========== -->

            <!-- ========== Page Title End ========== -->

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                       @if ($properties->count() > 0)
                            @foreach ($properties as $property)
                            <div class="col-lg-4 col-md-6">
                                <div class="card overflow-hidden">
                                    <div class="property-image-container">
                                        <img src="{{ asset($property->galleries[0]->image) }}" alt=""
                                            class="img-fluid rounded-top property-fixed-image">
                                        <!--<span class="position-absolute top-0 start-0 p-1">-->
                                        <!--    <button type="button"-->
                                        <!--        class="btn btn-warning avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-light"><iconify-icon-->
                                        <!--            icon="solar:bookmark-broken"></iconify-icon></button>-->
                                        <!--</span>-->
                                        <span class="position-absolute top-0 end-0 p-1">
                                            <span class="badge bg-success text-white fs-13">For
                                                {{ $property->status }}</span>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar bg-light rounded">
                                                <iconify-icon icon="solar:home-bold-duotone"
                                                    class="fs-24 text-primary avatar-title"></iconify-icon>
                                            </div>
                                            <div>
                                                <a href="{{ route('details', $property->id) }}"
                                                    class="text-dark fw-medium fs-13">{{ $property->property_name }}</a>
                                                <p class="text-muted mb-0">{{ $property->location }}</p>
                                            </div>
                                        </div>
                                        <div class="row mt-2 g-2">
                                            <div class="col-lg-4 col-4">
                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                    <span class="fs-13"><iconify-icon icon="solar:bed-broken"
                                                            class="align-middle"></iconify-icon></span>
                                                    Beds {{ $property->beds }}
                                                </span>
                                            </div>
                                            <div class="col-lg-4 col-4">
                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                    <span class="fs-13"><iconify-icon icon="solar:bath-broken"
                                                            class="align-middle"></iconify-icon></span>
                                                    Baths {{ $property->baths }}
                                                </span>
                                            </div>
                                            <div class="col-lg-4 col-4">
                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                    <span class="fs-13"><iconify-icon icon="solar:phone-bold"
                                                            class="align-middle"></iconify-icon></span>
                                                    {{ $property->phone }} 
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="card-footer bg-light-subtle d-flex align-items-center justify-content-between border-top">
                                        <p class="fw-medium text-dark fs-13 mb-0">Price:
                                            ${{ number_format($property->pricing) }}</p>

                                        <div class="d-flex gap-2">
                                            {{-- Edit button, small size, no w-100 --}}
                                            <a href="{{ route('edit_property', $property->id) }}"
                                                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                                                <iconify-icon icon="ri-pencil-line" class="fs-13"></iconify-icon>
                                                Edit Property
                                            </a>

                                            {{-- More Inquiry link --}}
                                            <a href="{{ route('details', $property->id) }}"
                                                class="link-primary fw-medium d-flex align-items-center gap-1">
                                                More Inquiry
                                                <iconify-icon icon="ri-arrow-right-line" class="fs-13"></iconify-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                       @else
                           <p class="text-center">No Booking Properties Here</p>
                       @endif
                    </div>

                    {{-- <div class="p-3 border-top">
                        <div class="p-3 border-top">
                            {{ $properties->links() }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
