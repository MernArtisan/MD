@extends('layouts.master')
@section('title', 'Edit Property')

@section('content')
    <style>
        .file-upload-container {
            margin-top: 0.5rem;
        }

        .file-upload-box {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .file-upload-box:hover {
            border-color: #999;
            background-color: #f0f0f0;
        }

        .file-upload-label {
            cursor: pointer;
            display: block;
        }

        .file-upload-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .upload-icon {
            color: #6c757d;
        }

        .upload-icon svg {
            width: 48px;
            height: 48px;
        }

        .upload-text h5 {
            margin: 0;
            font-size: 1.25rem;
            color: #212529;
        }

        .upload-text p {
            margin: 0.5rem 0 0;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .upload-hint {
            font-size: 0.75rem;
            color: #adb5bd;
            margin-top: 1rem !important;
        }

        .existing-images {
            margin-bottom: 1rem;
        }

        .existing-images img {
            max-width: 100px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .interest-input {
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active">Edit Property</li>
                        </ol>
                    </div>
                </div>
            </div>

            <form action="{{ route('update_property', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Property Photos</h4>
                    </div>
                    <div class="card-body">
                        <div class="existing-images">
                            @if ($property->galleries && $property->galleries->count())
                                <label class="form-label">Existing Photos</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($property->galleries as $gallery)
                                        <div class="position-relative" style="width: 120px; height: 100px;">
                                            <img src="{{ asset($gallery->image) }}" alt="Property Image"
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                            <button
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 delete-image-btn"
                                                data-image="{{ $gallery->image }}" data-id="{{ $property->id }}"
                                                style="padding: 2px 6px; font-size: 12px; border-radius: 50%;">
                                                ✕
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-lg-6 mb-3">
                            <label for="property-photos" class="form-label">Add More Photos (optional)</label>
                    <div id="new-image-preview" class="d-flex flex-wrap gap-2"></div>

                            <div class="file-upload-container">
                                <div class="file-upload-box">
                                    <input type="file" id="property-photos" name="images[]" multiple
                                        accept="image/png, image/jpeg, image/gif" style="display: none;">
                                    <label for="property-photos" class="file-upload-label">
                                        <div class="file-upload-content">
                                            <div class="upload-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-upload">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                    <polyline points="17 8 12 3 7 8" />
                                                    <line x1="12" y1="3" x2="12" y2="15" />
                                                </svg>
                                            </div>
                                            <div class="upload-text">
                                                <h5>Add More Property Photos</h5>
                                                <p>Drop your images here, or click to browse</p>
                                                <p class="upload-hint">1600 x 1200 (4:3) recommended. PNG, JPG and GIF files
                                                    are allowed</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">Property Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Property Name</label>
                                <input type="text" name="property_name" class="form-control"
                                    value="{{ old('property_name', $property->property_name) }}" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Property Category</label>
                                <select class="form-control" name="type" required>
                                    <option value="">Select Category</option>
                                    @php
                                        $categories = ['Villas', 'Residences', 'Bungalow', 'Apartment', 'Condo' , 'Resort' , 'Penthouse'];
                                    @endphp
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}"
                                            {{ old('type', $property->type) == $cat ? 'selected' : '' }}>
                                            {{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="pricing" class="form-control"
                                    value="{{ old('pricing', $property->pricing) }}" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $property->phone) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date Range</label>
                                <input type="text" name="date_range" class="form-control" id="daterange"
                                    value="{{ old('date_range', $property->date_range) }}" required>
                            </div>

                            <div class="card-body row">
                                <div class="col-lg-4 mb-3">
                                    <label class="form-label">AirBnB</label>
                                    <input type="number" name="airbnb" class="form-control"
                                        value="{{ old('airbnb', $property->airbnb) }}" required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="form-label">Capital Vacation</label>
                                    <input type="number" name="capitalvac" class="form-control"
                                        value="{{ old('capitalvac', $property->capitalvac) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Property For</label>
                                <select class="form-control" name="property_type" required>
                                    <option value="">Select Property Type</option>
                                    <option value="sell"
                                        {{ old('property_type', $property->property_type) == 'sell' ? 'selected' : '' }}>
                                        Sell</option>
                                    <option value="rent"
                                        {{ old('property_type', $property->property_type) == 'rent' ? 'selected' : '' }}>
                                        Rent</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Property Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Property Status</option>
                                    <option value="available"
                                        {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>Available
                                    </option>
                                    <option value="occupied"
                                        {{ old('status', $property->status) == 'occupied' ? 'selected' : '' }}>Occupied
                                    </option>
                                    <option value="booking"
                                        {{ old('status', $property->status) == 'booking' ? 'selected' : '' }}>Booking
                                    </option>
                                    <option value="pending"
                                        {{ old('status', $property->status) == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="sold"
                                        {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="rented"
                                        {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>Rented
                                    </option>
                                    <option value="under_maintenance"
                                        {{ old('status', $property->status) == 'under_maintenance' ? 'selected' : '' }}>
                                        Under Maintenance</option>
                                    <option value="inactive"
                                        {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                    <option value="vacant"
                                        {{ old('status', $property->status) == 'vacant' ? 'selected' : '' }}>Vacant
                                    </option>
                                </select>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Bedrooms</label>
                                <input type="number" name="beds" class="form-control"
                                    value="{{ old('beds', $property->beds) }}" required>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Bathrooms</label>
                                <input type="number" name="baths" class="form-control"
                                    value="{{ old('baths', $property->baths) }}" required>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label" for="interest">Interest</label>
                                <div id="interest-wrapper">
                                    @php
                                        $interests = old('interest', $property->interest ?? []);
                                        if (is_string($interests)) {
                                            $interests = json_decode($interests, true) ?: [];
                                        }
                                    @endphp

                                    @if (count($interests) > 0)
                                        @foreach ($interests as $interest)
                                            <input type="text" name="interest[]" class="form-control interest-input"
                                                value="{{ $interest }}" placeholder="music, sports, reading">
                                        @endforeach
                                    @else
                                        <input type="text" name="interest[]" class="form-control interest-input"
                                            placeholder="music, sports, reading">
                                    @endif
                                </div>
                                <!--<small><button type="button" id="add-interest" class="btn btn-link p-0">+ Add More-->
                                <!--        Interest</button></small>-->
                            </div>

                            {{-- <div class="col-lg-4 mb-3">
                                <label class="form-label">Square Foot</label>
                                <input type="number" name="area" class="form-control"
                                    value="{{ old('area', $property->area) }}" required>
                            </div> --}}
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Rules and Regulation</label>
                                <textarea name="rules_and_regulations" class="form-control" rows="3">{{ old('rules_and_regulations', $property->rules_and_regulations) }}</textarea>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $property->description) }}</textarea>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" name="location" id="location"
                                            required placeholder="Enter Location"
                                            value="{{ old('location', $property->location) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" style="display: none">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        </div>
                                        <input type="number" step="any" class="form-control" name="latitude"
                                            id="latitude" placeholder="Enter Latitude"
                                            value="{{ old('latitude', $property->latitude) }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" style="display: none">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        </div>
                                        <input type="number" step="any" class="form-control" name="longitude"
                                            id="longitude" placeholder="Enter Longitude"
                                            value="{{ old('longitude', $property->longitude) }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12" id="map-container" style="display: none;">
                                <div class="form-group">
                                    <label for="map">Location Map</label>
                                    <div id="map" style="width: 100%; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-outline-primary w-100">Update</button>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{ route('property') }}" class="btn btn-danger w-100">Cancel</a>
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="container mt-10">
            <div class="row text-center">
                <h1 class="mb-4">Our Partners</h1>
            </div>
            <div class="row gx-4 gy-4">
                <!-- Airbnb -->
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <a href="https://www.airbnb.com/" class="logo-dark" target="_blank" rel="noopener">
                                <img src="{{ asset('admin/assets/images/platform/airbnb.png') }}" class="logo-sm pro-img"
                                    alt="Airbnb">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Hotels.com -->
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <a href="https://www.hotels.com/" class="logo-dark" target="_blank" rel="noopener">
                                <img src="{{ asset('admin/assets/images/platform/hotels.png') }}" class="logo-sm pro-img"
                                    alt="Hotels.com">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Expedia -->
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <a href="https://www.expedia.com/" class="logo-dark" target="_blank" rel="noopener">
                                <img src="{{ asset('admin/assets/images/platform/expedia.png') }}"
                                    class="logo-sm pro-img" alt="Expedia">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Booking.com -->
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <a href="https://www.booking.com/" class="logo-dark" target="_blank" rel="noopener">
                                <img src="{{ asset('admin/assets/images/platform/booking.com.png') }}"
                                    class="logo-sm pro-img" alt="Booking.com">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const latInput = document.getElementById("latitude");
            const lngInput = document.getElementById("longitude");
            const mapContainer = document.getElementById("map-container");

            if (latInput && lngInput && mapContainer) {
                const latitude = parseFloat(latInput.value);
                const longitude = parseFloat(lngInput.value);

                if (!isNaN(latitude) && !isNaN(longitude)) {
                    mapContainer.style.display = "block";
                    initializeMap(latitude, longitude);
                }
            }
        });

        function initializeMap(latitude, longitude) {
            const map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map);
        }
    </script>

@endsection
