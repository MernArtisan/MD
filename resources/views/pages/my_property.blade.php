@extends('layouts.master')

@section('title', 'My Property')

@section('content')
    <style>
        .property-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .property-fixed-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .property-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .property-card-body {
            flex-grow: 1;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        @foreach ($properties as $property)
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="card overflow-hidden property-card w-100">
                                    <div class="property-image-container">
                                        <img src="{{ asset($property->galleries[0]->image ??'') }}" alt=""
                                            class="img-fluid rounded-top property-fixed-image">
                                        <span class="position-absolute top-0 end-0 p-1">
                                            @if ($property->property_type == 'sell')
                                                <span class="badge bg-success text-white fs-13">
                                                    For {{ $property->property_type }} Available
                                                </span>
                                            @elseif ($property->property_type == 'rent')
                                                <span class="badge bg-danger text-white fs-13">
                                                    For {{ $property->property_type }} Available
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="card-body property-card-body">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar bg-light rounded">
                                                <iconify-icon icon="solar:home-bold-duotone"
                                                    class="fs-24 text-primary avatar-title"></iconify-icon>
                                            </div>
                                            <div>
                                                <a href="{{ route('details', $property->id) }}"
                                                    class="text-dark fw-medium fs-13">
                                                    {{ $property->property_name }}
                                                </a>
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
                                        class="card-footer bg-light-subtle border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <p class="fw-medium text-dark fs-13 mb-0">Price:
                                            ${{ number_format($property->pricing) }}</p>

                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit_property', $property->id) }}"
                                                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                                                <iconify-icon icon="ri-pencil-line" class="fs-13"></iconify-icon>
                                                Edit Property
                                            </a>

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
                    </div>

                    <div class="p-3 border-top">
                        {{ $properties->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
