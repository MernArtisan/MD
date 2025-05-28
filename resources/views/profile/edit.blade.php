@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 fw-semibold d-flex align-items-center">
                        <i class="ri-user-edit-line me-2"></i>
                        Edit Profile
                    </h4>
                    <a href="{{ route('profile') }}" class="btn btn-link text-decoration-none">
                        <i class="ri-arrow-left-line"></i> Back to Profile
                    </a>
                </div>
                <hr class="mt-3">
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <form action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Avatar Section -->
                            <div class="text-center mb-5">
                                <div class="position-relative d-inline-block avatar-upload">
                                    <div class="avatar-preview rounded-circle shadow-sm">
                                        <img src="{{ asset(Auth::user()->image) }}" id="profileDisplay" 
                                             class="rounded-circle object-cover" width="128" height="128" 
                                             alt="Avatar" style="transition: transform 0.3s ease">
                                    </div>
                                    <label for="profileImage" 
                                           class="btn btn-primary btn-sm avatar-upload-btn rounded-circle p-2">
                                        <i class="ri-camera-fill fs-5"></i>
                                        <input type="file" id="profileImage" name="profile_photo" 
                                               accept="image/*" class="d-none">
                                    </label>
                                </div>
                                @error('profile_photo')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Personal Information Section -->
                            <div class="mb-5">
                                <h5 class="mb-4 fw-semibold text-primary">
                                    <i class="ri-profile-line me-2"></i>Personal Information
                                </h5>
                                <div class="row g-4">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" id="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', Auth::user()->name) }}" 
                                                   placeholder="Enter your name">
                                            <label for="name" class="form-label">
                                                <i class="ri-user-3-line me-2"></i>Full Name
                                            </label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" id="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', Auth::user()->email) }}" 
                                                   placeholder="Enter your email">
                                            <label for="email" class="form-label">
                                                <i class="ri-mail-line me-2"></i>Email Address
                                            </label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Contact -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="contact" id="contact"
                                                   class="form-control @error('contact') is-invalid @enderror"
                                                   value="{{ old('contact', Auth::user()->phone) }}" 
                                                   placeholder="Phone number">
                                            <label for="contact" class="form-label">
                                                <i class="ri-phone-line me-2"></i>Contact Number
                                            </label>
                                            @error('contact')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Information Section -->
                            <div class="mb-5">
                                <h5 class="mb-4 fw-semibold text-primary">
                                    <i class="ri-map-pin-line me-2"></i>Address Information
                                </h5>
                                <div class="row g-4">
                                    <!-- Country -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="country" id="country"
                                                   class="form-control @error('country') is-invalid @enderror"
                                                   value="{{ old('country', Auth::user()->country) }}"
                                                   placeholder="Country">
                                            <label for="country" class="form-label">
                                                <i class="ri-earth-line me-2"></i>Country
                                            </label>
                                            @error('country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="state" id="state"
                                                   class="form-control @error('state') is-invalid @enderror"
                                                   value="{{ old('state', Auth::user()->state) }}"
                                                   placeholder="State">
                                            <label for="state" class="form-label">
                                                <i class="ri-government-line me-2"></i>State
                                            </label>
                                            @error('state')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="city" id="city"
                                                   class="form-control @error('city') is-invalid @enderror"
                                                   value="{{ old('city', Auth::user()->city) }}"
                                                   placeholder="City">
                                            <label for="city" class="form-label">
                                                <i class="ri-building-2-line me-2"></i>City
                                            </label>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- ZIP Code -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="zip" id="zip"
                                                   class="form-control @error('zip') is-invalid @enderror"
                                                   value="{{ old('zip', Auth::user()->zip) }}"
                                                   placeholder="ZIP Code">
                                            <label for="zip" class="form-label">
                                                <i class="ri-map-pin-2-line me-2"></i>ZIP Code
                                            </label>
                                            @error('zip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="address" id="address" 
                                                      class="form-control @error('address') is-invalid @enderror" 
                                                      placeholder="Full Address" 
                                                      style="height: 100px">{{ old('address', Auth::user()->address) }}</textarea>
                                            <label for="address" class="form-label">
                                                <i class="ri-home-4-line me-2"></i>Full Address
                                            </label>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bio Section -->
                            <div class="mb-5">
                                <h5 class="mb-4 fw-semibold text-primary">
                                    <i class="ri-file-text-line me-2"></i>Bio
                                </h5>
                                <div class="form-floating">
                                    <textarea name="bio" id="bio" 
                                              class="form-control @error('bio') is-invalid @enderror" 
                                              placeholder="Write your bio here"
                                              style="height: 120px">{{ old('bio', Auth::user()->bio) }}</textarea>
                                    <label for="bio" class="form-label">
                                        <i class="ri-pencil-line me-2"></i>About Yourself
                                    </label>
                                    <div id="charCounter" class="form-text text-end"></div>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <button type="reset" class="btn btn-light px-4">
                                    <i class="ri-restart-line me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="ri-save-3-line me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-upload {
        position: relative;
        max-width: 128px;
    }
    
    .avatar-upload-btn {
        position: absolute;
        right: 0;
        bottom: 0;
        transform: translate(30%, 30%);
    }
    
    .avatar-preview {
        overflow: hidden;
        width: 128px;
        height: 128px;
        border: 3px solid #fff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        background-color: #f8f9fa;
    }
    
    .avatar-preview img {
        transition: transform 0.3s ease;
    }
    
    .form-floating label {
        transition: all 0.3s ease;
    }
    
    .form-control:focus-within ~ label {
        color: #0d6efd;
    }
    
    .object-cover {
        object-fit: cover;
    }
</style>
@endsection

@section('scripts')
<script>
    // Image Upload Preview
    document.getElementById('profileImage').addEventListener('change', function(e) {
        const [file] = e.target.files;
        const preview = document.getElementById('profileDisplay');
        const errorDiv = document.querySelector('.avatar-upload .text-danger');
        
    });

    // Bio Character Counter
    const bioTextarea = document.getElementById('bio');
    const charCounter = document.getElementById('charCounter');
    
    const updateCounter = () => {
        const maxLength = 250;
        const remaining = maxLength - bioTextarea.value.length;
        charCounter.textContent = `${remaining} characters remaining`;
        charCounter.style.color = remaining < 0 ? '#dc3545' : '#6c757d';
    };

    bioTextarea.addEventListener('input', updateCounter);
    updateCounter(); // Initial call

    // Hover effect for avatar
    const avatarPreview = document.querySelector('.avatar-preview');
    avatarPreview.addEventListener('mouseenter', () => {
        avatarPreview.querySelector('img').style.transform = 'scale(1.1)';
    });
    
    avatarPreview.addEventListener('mouseleave', () => {
        avatarPreview.querySelector('img').style.transform = 'scale(1)';
    });
</script>
@endsection