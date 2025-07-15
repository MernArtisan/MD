@extends('layouts.master')
@section('title', 'Add Property')

@section('content')
    <style>
        :root {
            --airbnb-pink: #604ae3;
            --airbnb-dark: #222222;
            --airbnb-light: #F7F7F7;
            --airbnb-gray: #717171;
            --airbnb-border: #EBEBEB;
        }

        * {
            box-sizing: border-box;
            font-family: 'Circular', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: white;
            color: var(--airbnb-dark);
        }

        .property-form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .progress-bar {
            height: 6px;
            background-color: var(--airbnb-light);
            margin-bottom: 40px;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: var(--airbnb-pink);
            width: 0%;
            transition: width 0.4s ease;
        }

        .form-step {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-step.active {
            display: block;
        }

        .step-header {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .step-subheader {
            font-size: 18px;
            color: var(--airbnb-gray);
            margin-bottom: 30px;
        }

        .option-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .option-card {
            border: 1px solid var(--airbnb-border);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .option-card:hover {
            border-color: var(--airbnb-dark);
        }

        .option-card.selected {
            border: 2px solid var(--airbnb-dark);
        }

        .option-icon {
            font-size: 24px;
            margin-bottom: 12px;
            color: var(--airbnb-pink);
        }

        .option-title {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--airbnb-border);
        }

        .btn {
            padding: 14px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--airbnb-pink);
            color: white;
        }

        .btn-primary:hover {
            background-color: #604ae3;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: white;
            border: 1px solid var(--airbnb-dark);
            color: var(--airbnb-dark);
        }

        .btn-outline:hover {
            background-color: var(--airbnb-light);
        }

        .location-map {
            height: 300px;
            background-color: var(--airbnb-light);
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .location-map img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--airbnb-border);
            border-radius: 8px;
            font-size: 16px;
        }

        .counter-control {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .counter-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: 1px solid var(--airbnb-border);
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .counter-value {
            font-size: 18px;
            font-weight: 600;
            min-width: 30px;
            text-align: center;
        }

        .checkbox-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .photo-upload {
            border: 2px dashed var(--airbnb-border);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .photo-upload-icon {
            font-size: 48px;
            color: var(--airbnb-pink);
            margin-bottom: 16px;
        }

        .photo-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .photo-thumbnail {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        .price-input {
            position: relative;
        }

        .price-input .currency {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 600;
        }

        .price-input input {
            padding-left: 30px;
        }

        .highlight-card {
            border: 1px solid var(--airbnb-border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .highlight-icon {
            font-size: 24px;
            color: var(--airbnb-pink);
        }

        .highlight-content {
            flex: 1;
        }

        .highlight-title {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .highlight-text {
            color: var(--airbnb-gray);
        }

        @media (max-width: 768px) {
            .option-grid {
                grid-template-columns: 1fr 1fr;
            }

            .step-header {
                font-size: 24px;
            }
        }

        /* Points Input Style */
        .price-input .fa-coins {
            color: #FFD700;
            /* Gold color for points */
        }

        /* Distribution Options */
        .distribution-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }

        .distribution-option {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 1px solid #EBEBEB;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .distribution-option:hover {
            border-color: #DDDDDD;
        }

        .distribution-option input {
            position: absolute;
            opacity: 0;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 1px solid #DDDDDD;
            border-radius: 4px;
            margin-right: 12px;
            position: relative;
        }

        .distribution-option input:checked~.checkmark {
            background-color: #FF385C;
            border-color: #FF385C;
        }

        .distribution-option input:checked~.checkmark:after {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 12px;
        }

        .platform-logo {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            object-fit: contain;
        }

        /* Success Details */
        .success-details {
            margin: 25px 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
        }

        .detail-item i {
            color: #FF385C;
            font-size: 20px;
        }

        * Location Search */ .location-search {
            display: flex;
            margin-bottom: 20px;
            position: relative;
        }

        .location-search input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid var(--airbnb-border);
            border-radius: 8px 0 0 8px;
            font-size: 16px;
        }

        .location-search button {
            padding: 12px 16px;
            background-color: var(--airbnb-pink);
            color: white;
            border: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            font-weight: 600;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title… -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-0 fw-semibold">Add Property</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('property') }}">Real Estate</a></li>
                            <li class="breadcrumb-item active">Add Property</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="property-form-container">
                    <div class="progress-bar">
                        <div class="progress" id="form-progress"></div>
                    </div>

                    <form method="POST" action="{{ route('add_property') }}" enctype="multipart/form-data"
                        id="propertyForm">
                        @csrf

                        <!-- STEP 1 -->
                        <div class="form-step active" id="step1">
                            <h1 class="step-header">Which of these best describes your place?</h1>
                            <div class="option-grid">
                                <div class="option-card" data-value="home">
                                    <div class="option-icon"><i class="fas fa-home"></i></div>
                                    <div class="option-title">House</div>
                                </div>
                                <div class="option-card" data-value="apartment">
                                    <div class="option-icon"><i class="fas fa-building"></i></div>
                                    <div class="option-title">Apartment</div>
                                </div>
                                <div class="option-card" data-value="barn">
                                    <div class="option-icon"><i class="fas fa-tractor"></i></div>
                                    <div class="option-title">Barn</div>
                                </div>
                                <div class="option-card" data-value="bed-breakfast">
                                    <div class="option-icon"><i class="fas fa-bed"></i></div>
                                    <div class="option-title">Bed &amp; Breakfast</div>
                                </div>
                                <div class="option-card" data-value="boat">
                                    <div class="option-icon"><i class="fas fa-ship"></i></div>
                                    <div class="option-title">Boat</div>
                                </div>
                                <div class="option-card" data-value="cabin">
                                    <div class="option-icon"><i class="fas fa-mountain"></i></div>
                                    <div class="option-title">Cabin</div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <div></div>
                                <button type="button" class="btn btn-primary next-step" data-next="step2">Continue</button>
                            </div>
                        </div>


                        <!-- STEP 2 -->
                        <div class="form-step" id="step2">
                            <h1 class="step-header">What type of place will guests have?</h1>
                            <div class="option-grid">
                                <div class="option-card" data-value="entire-place">
                                    <div class="option-icon"><i class="fas fa-door-open"></i></div>
                                    <div class="option-title">An entire place</div>
                                    <p class="option-description">
                                        Guests have the whole place to themselves
                                    </p>
                                </div>
                                <div class="option-card" data-value="private-room">
                                    <div class="option-icon"><i class="fas fa-bed"></i></div>
                                    <div class="option-title">A private room</div>
                                    <p class="option-description">
                                        Guests have their own room in a home, plus access to shared spaces
                                    </p>
                                </div>
                                <div class="option-card" data-value="shared-room">
                                    <div class="option-icon"><i class="fas fa-users"></i></div>
                                    <div class="option-title">A shared room</div>
                                    <p class="option-description">
                                        Guests sleep in a room or common area that may be shared with you or others
                                    </p>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step1">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step3">Continue</button>
                            </div>
                        </div>


                        <!-- STEP 3 -->
                        <div class="form-step" id="step3">
                            <h1 class="step-header">Where's your place located?</h1>
                            <div class="location-map">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?center=40.7128,-74.0060&zoom=13&size=800x300&maptype=roadmap"
                                    alt="Map">
                                <div class="map-overlay">
                                    <div class="location-search">
                                        <input type="text" id="location-input" placeholder="Enter your address">
                                        <button type="button" id="location-search-btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step2">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step4">Continue</button>
                            </div>
                        </div>

                        <!-- STEP 4 -->
                        <div class="form-step" id="step4">
                            <h1 class="step-header">Let's start with the basics</h1>
                            <div class="form-group">
                                <label class="form-label">How many guests can stay?</label>
                                <div class="counter-control">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="counter-value">1</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">How many bedrooms?</label>
                                <div class="counter-control">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="counter-value">1</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">How many beds?</label>
                                <div class="counter-control">
                                    <button type="button" class="counter-btn minus">-</button>
                                    <span class="counter-value">1</span>
                                    <button type="button" class="counter-btn plus">+</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Does every bedroom have a lock?</label>
                                <div class="checkbox-group">
                                    <label class="checkbox-label"><input type="radio" name="bedroom-lock" value="yes">
                                        Yes</label>
                                    <label class="checkbox-label"><input type="radio" name="bedroom-lock" value="no">
                                        No</label>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step3">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step5">Continue</button>
                            </div>
                        </div>

                        <!-- STEP 5 -->
                        <div class="form-step" id="step5">
                            <div class="highlight-card">
                                <div class="highlight-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="highlight-content">
                                    <div class="highlight-title">Make your place stand out</div>
                                    <div class="highlight-text">
                                        A great title and description help guests imagine staying at your place.
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step4">
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary next-step" data-next="step6">
                                    Continue
                                </button>
                            </div>
                        </div>

                        <!-- STEP 6 -->
                        <div class="form-step" id="step6">
                            <h1 class="step-header">Tell guests what your place has to offer</h1>

                            <!-- Guest favorites -->
                            <h3 class="step-subheader">What about these guest favorites?</h3>
                            <div class="option-grid">
                                <div class="option-card" data-value="wifi">
                                    <div class="option-icon"><i class="fas fa-wifi"></i></div>
                                    <div class="option-title">Wifi</div>
                                </div>
                                <div class="option-card" data-value="tv">
                                    <div class="option-icon"><i class="fas fa-tv"></i></div>
                                    <div class="option-title">TV</div>
                                </div>
                                <div class="option-card" data-value="kitchen">
                                    <div class="option-icon"><i class="fas fa-utensils"></i></div>
                                    <div class="option-title">Kitchen</div>
                                </div>
                                <div class="option-card" data-value="washer">
                                    <div class="option-icon"><i class="fas fa-washer"></i></div>
                                    <div class="option-title">Washer</div>
                                </div>
                                <div class="option-card" data-value="parking">
                                    <div class="option-icon"><i class="fas fa-car"></i></div>
                                    <div class="option-title">Free parking</div>
                                </div>
                                <div class="option-card" data-value="ac">
                                    <div class="option-icon"><i class="fas fa-snowflake"></i></div>
                                    <div class="option-title">Air conditioning</div>
                                </div>
                            </div>

                            <!-- Standout amenities -->
                            <h3 class="step-subheader">Do you have any standout amenities?</h3>
                            <div class="option-grid">
                                <div class="option-card" data-value="pool">
                                    <div class="option-icon"><i class="fas fa-swimming-pool"></i></div>
                                    <div class="option-title">Pool</div>
                                </div>
                                <div class="option-card" data-value="hot-tub">
                                    <div class="option-icon"><i class="fas fa-hot-tub"></i></div>
                                    <div class="option-title">Hot tub</div>
                                </div>
                                <div class="option-card" data-value="patio">
                                    <div class="option-icon"><i class="fas fa-umbrella-beach"></i></div>
                                    <div class="option-title">Patio</div>
                                </div>
                                <div class="option-card" data-value="bbq">
                                    <div class="option-icon"><i class="fas fa-fire"></i></div>
                                    <div class="option-title">BBQ grill</div>
                                </div>
                            </div>

                            <!-- Safety items -->
                            <h3 class="step-subheader">Do you have any of these safety items?</h3>
                            <div class="option-grid">
                                <div class="option-card" data-value="smoke-alarm">
                                    <div class="option-icon"><i class="fas fa-bell"></i></div>
                                    <div class="option-title">Smoke alarm</div>
                                </div>
                                <div class="option-card" data-value="first-aid">
                                    <div class="option-icon"><i class="fas fa-first-aid"></i></div>
                                    <div class="option-title">First aid kit</div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step5">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step7">Continue</button>
                            </div>
                        </div>


                        <!-- STEP 7 -->
                        <div class="form-step" id="step7">
                            <h1 class="step-header">Add some photos of your apartment</h1>
                            <p class="step-subheader">You'll need 5 photos to get started. You can add more or make changes
                                later.</p>

                            <div class="photo-upload" id="photo-upload-area">
                                <div class="photo-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <h3>Drag your photos here</h3>
                                <p>Choose at least 5 photos</p>
                                <input type="file" id="photo-upload-input" name="photos[]" multiple accept="image/*"
                                    style="display: none;">
                            </div>

                            <div class="photo-preview" id="photo-preview"></div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step6">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step8">Continue</button>
                            </div>
                        </div>


                        <!-- STEP 8 -->
                        <div class="form-step" id="step8">
                            <h1 class="step-header">Now, let's give your apartment a title</h1>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control"
                                    placeholder="Modern apartment with city views">
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step7">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step9">Continue</button>
                            </div>
                        </div>

                        <!-- STEP 9 -->
                        <div class="form-step" id="step9">
                            <h1 class="step-header">Create your description</h1>
                            <div class="form-group">
                                <textarea name="description" class="form-control" rows="8"
                                    placeholder="Tell guests what makes your place unique..."></textarea>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step8">Back</button>
                                <button type="button" class="btn btn-primary next-step" data-next="step10">Continue</button>
                            </div>
                        </div>

                        <!-- STEP 10 -->
                        <div class="form-step" id="step10">
                            <h1 class="step-header">Set your pricing and points</h1>

                            <!-- Weekday Pricing -->
                            <div class="form-group">
                                <label class="form-label">Weekday base price</label>
                                <div class="price-input">
                                    <span class="currency">$</span>
                                    <input type="number" name="weekday_price" id="weekday-price" class="form-control"
                                        placeholder="0.00" min="0" step="0.01">
                                </div>
                            </div>

                            <!-- Weekend Pricing -->
                            <div class="form-group">
                                <label class="form-label">Weekend price</label>
                                <div class="price-input">
                                    <span class="currency">$</span>
                                    <input type="number" name="weekend_price" id="weekend-price" class="form-control"
                                        placeholder="0.00" min="0" step="0.01">
                                </div>
                            </div>

                            <!-- Points System -->
                            <div class="form-group">
                                <label class="form-label">Allocate points</label>
                                <div class="price-input">
                                    <span class="currency"><i class="fas fa-coins"></i></span>
                                    <input type="number" name="property_points" id="property-points" class="form-control"
                                        placeholder="0" min="0">
                                </div>
                                <p class="highlight-text">Points determine visibility and ranking.</p>
                            </div>

                            <!-- Distribution Channels -->
                            <div class="form-group">
                                <label class="form-label">Post to:</label>
                                <div class="distribution-options">
                                    <label class="distribution-option">
                                        <input type="checkbox" name="distribution[]" value="airbnb">
                                        <span class="checkmark"></span> Airbnb
                                    </label>
                                    <label class="distribution-option">
                                        <input type="checkbox" name="distribution[]" value="booking">
                                        <span class="checkmark"></span> Booking.com
                                    </label>
                                    <label class="distribution-option">
                                        <input type="checkbox" name="distribution[]" value="vrbo">
                                        <span class="checkmark"></span> VRBO
                                    </label>
                                    <label class="distribution-option">
                                        <input type="checkbox" name="distribution[]" value="agoda">
                                        <span class="checkmark"></span> Agoda
                                    </label>
                                </div>
                            </div>

                            <!-- Footer Buttons -->
                            <div class="form-footer">
                                <button type="button" class="btn btn-outline prev-step" data-prev="step9">Back</button>
                                <button type="submit" class="btn btn-primary" id="finish-btn">Finish & Publish</button>
                            </div>
                        </div>


                        <!-- hidden fields -->
                        <input type="hidden" name="property_type" id="property_type">
                        <input type="hidden" name="guest_space_type" id="guest_space_type">
                        <input type="hidden" name="location_address" id="location_address">
                        <input type="hidden" name="guests" id="guests" value="1">
                        <input type="hidden" name="bedrooms" id="bedrooms" value="1">
                        <input type="hidden" name="beds" id="beds" value="1">
                        <input type="hidden" name="bedroom_lock" id="bedroom_lock">
                        <input type="hidden" name="amenities" id="amenities">
                        <input type="hidden" name="standout_amenities" id="standout_amenities">
                        <input type="hidden" name="safety_items" id="safety_items">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Navigation
        document.querySelectorAll('.next-step').forEach(btn => btn.addEventListener('click', function () {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById(this.dataset.next).classList.add('active');
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7', 'step8', 'step9', 'step10'];
            document.getElementById('form-progress').style.width =
                (steps.indexOf(this.dataset.next) / (steps.length - 1)) * 100 + '%';
        }));
        document.querySelectorAll('.prev-step').forEach(btn => btn.addEventListener('click', function () {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById(this.dataset.prev).classList.add('active');
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7', 'step8', 'step9', 'step10'];
            document.getElementById('form-progress').style.width =
                (steps.indexOf(this.dataset.prev) / (steps.length - 1)) * 100 + '%';
        }));

        // Option selection
        document.querySelectorAll('.option-card').forEach(card => card.addEventListener('click', function () {
            this.parentElement.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
        }));

        // Counters
        document.querySelectorAll('.counter-btn').forEach(btn => btn.addEventListener('click', function () {
            const valEl = this.parentElement.querySelector('.counter-value');
            let val = parseInt(valEl.textContent) + (this.classList.contains('plus') ? 1 : -1);
            valEl.textContent = Math.max(0, val);
        }));

        // Photo upload preview
        const uploadArea = document.getElementById('photo-upload-area'),
            inputFile = document.getElementById('photo-upload-input'),
            preview = document.getElementById('photo-preview');
        uploadArea.addEventListener('click', () => inputFile.click());
        inputFile.addEventListener('change', e => {
            preview.innerHTML = '';
            Array.from(e.target.files).forEach(f => {
                if (f.type.startsWith('image/')) {
                    const r = new FileReader();
                    r.onload = ev => {
                        const img = document.createElement('img');
                        img.src = ev.target.result;
                        img.classList.add('photo-thumbnail');
                        preview.appendChild(img);
                    };
                    r.readAsDataURL(f);
                }
            });
        });
        ['dragover', 'dragleave', 'drop'].forEach(evt => {
            uploadArea.addEventListener(evt, e => {
                e.preventDefault();
                uploadArea.style.borderColor = evt === 'dragover' ? 'var(--airbnb-pink)' : 'var(--airbnb-border)';
                if (evt === 'drop') {
                    inputFile.files = e.dataTransfer.files;
                    inputFile.dispatchEvent(new Event('change'));
                }
            });
        });

        // On submit: fill hidden inputs
        document.getElementById('propertyForm').addEventListener('submit', function () {
            document.getElementById('property_type').value = document.querySelector('#step1 .option-card.selected')?.dataset.value || '';
            document.getElementById('guest_space_type').value = document.querySelector('#step2 .option-card.selected')?.dataset.value || '';
            document.getElementById('location_address').value = document.getElementById('location-input').value;
            const ctr = document.querySelectorAll('#step4 .counter-value');
            document.getElementById('guests').value = ctr[0].textContent;
            document.getElementById('bedrooms').value = ctr[1].textContent;
            document.getElementById('beds').value = ctr[2].textContent;
            document.getElementById('bedroom_lock').value = document.querySelector('input[name="bedroom-lock"]:checked')?.value || '';
            const sel = arr => arr.filter(el => el.classList.contains('selected')).map(el => el.dataset.value).join(',');
            document.getElementById('amenities').value = sel([...document.querySelectorAll('#step6 .option-grid:nth-of-type(1) .option-card')]);
            document.getElementById('standout_amenities').value = sel([...document.querySelectorAll('#step6 .option-grid:nth-of-type(2) .option-card')]);
            document.getElementById('safety_items').value = sel([...document.querySelectorAll('#step6 .option-grid:nth-of-type(3) .option-card')]);
        });
    </script>
@endsection