@extends('layouts.master')
@section('title', 'Add Property')

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
    </style>
    <style>
        #image-preview img {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active">Add Property</li>
                        </ol>
                    </div>
                </div>
            </div>

            <form action="{{ route('add_property') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Property Photos --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Property Photos</h4>
                    </div>
                    <div id="image-preview" style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;"></div>

                    <div class="card-body">
                        <div class="col-lg-6 mb-3">
                            <label for="property-photos" class="form-label">Upload Photos</label>
                            <div class="file-upload-box">
                                <input type="file" id="property-photos" name="images[]" multiple accept="image/*"
                                    style="display: none;">
                                <label for="property-photos" class="file-upload-label"
                                    style="cursor:pointer; display: inline-block;">
                                    <div class="file-upload-content">
                                        <div class="upload-icon">📁</div>
                                        <div class="upload-text">
                                            <h5>Drop or Click to Upload</h5>
                                            <p class="upload-hint">1600x1200 recommended (JPG, PNG, GIF)</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Basic Information --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Basic Information</h4>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Property Name</label>
                            <input type="text" name="property_name" value="{{ old('property_name') }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-control" name="type" required>
                                <option value="">Select Category</option>
                                @foreach (['Villas', 'Residences', 'Bungalow', 'Apartment', 'Penthouse', 'Condo', 'Resort'] as $category)
                                    <option {{ old('type') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                {{-- Pricing & Dates --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Pricing & Dates</h4>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="pricing" value="{{ old('pricing') }}" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Range</label>
                            <input type="text" name="date_range" value="{{ old('date_range') }}" class="form-control"
                                id="daterange" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Airbnb</label>
                            <input type="number" name="airbnb" value="{{ old('airbnb') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Capital Vacation</label>
                            <input type="number" name="capitalvac" value="{{ old('capitalvac') }}" class="form-control"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Property For</label>
                            <select class="form-control" name="property_type" required>
                                <option value="">Select Type</option>
                                <option value="rent" {{ old('property_type') == 'rent' ? 'selected' : '' }}>Rent</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Property Specs --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Specifications</h4>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Bedrooms</label>
                            <input type="number" name="beds" value="{{ old('beds') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Bathrooms</label>
                            <input type="number" name="baths" value="{{ old('baths') }}" class="form-control"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Details --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Interests (comma separated)</label>
                            <input type="text" name="interest[]" value="{{ old('interest.0') }}"
                                class="form-control" placeholder="music, sports, reading" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rules and Regulation</label>
                            <textarea name="rules_and_regulations" class="form-control" rows="2">{{ old('rules_and_regulations') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Location --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Location</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                value="{{ old('location') }}" required>
                        </div>
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                        <div id="map-container" style="display: none;">
                            <label for="map">Map</label>
                            <div id="map" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="row justify-content-end mt-3">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-outline-primary w-100">Submit</button>
                    </div>
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-danger w-100">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function initialize() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                document.getElementById('map-container').style.display = 'block';

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: place.geometry.location
                });

                var marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map
                });
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script>
        const imagePreview = document.getElementById('image-preview');
        const fileInput = document.getElementById('property-photos');

        fileInput.addEventListener('change', function() {
            imagePreview.innerHTML = ''; // clear previous previews
            const files = this.files;

            if (files.length === 0) return;

            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.onload = () => URL.revokeObjectURL(img.src); // free memory

                imagePreview.appendChild(img);
            });
        });
    </script>

@endsection
