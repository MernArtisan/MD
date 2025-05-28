<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Change Password | Maria Davidson</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Change your account password" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/md-logo.png') }}">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('admin/assets/js/config.min.js') }}"></script>

    <!-- Custom CSS for Password Toggle -->
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .form-group {
            position: relative;
        }

        .password-strength {
            height: 3px;
            background: #e9ecef;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body class="authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card auth-card">
                        <div class="card-body px-3 py-5">
                            <div class="mx-auto mb-4 text-center auth-logo">
                                <a href="/" class="logo-dark">
                                    <img src="{{ asset('admin/assets/images/md-logo.png') }}" height="32"
                                        alt="logo dark">
                                </a>
                                <a href="/" class="logo-light">
                                    <img src="{{ asset('admin/assets/images/md-logo.png') }}" height="28"
                                        alt="logo light">
                                </a>
                            </div>

                            <div class="text-center mb-2">
                                <img class="rounded-circle avatar-lg img-thumbnail"
                                    src="{{ asset(Auth::user()->image) }}" alt="avatar">
                            </div>
                            <h2 class="fw-bold text-uppercase text-center fs-18">Change Password</h2>
                            <p class="text-muted text-center mt-1 mb-4">Secure your account with a new password</p>

                            <form id="changePasswordForm" class="authentication-form" method="POST"
                                action="{{ route('password.reset') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="password">New Password</label>
                                    <input type="password" id="new-password" name="password"
                                        class="form-control bg-light bg-opacity-50 border-light py-2"
                                        placeholder="Enter new password" required>
                                    <i class="fas fa-eye-slash password-toggle"
                                        onclick="togglePassword('new-password')"></i>
                                    <div class="password-strength">
                                        <div class="strength-meter" id="password-strength-meter"></div>
                                    </div>
                                    <small class="text-muted">Minimum 8 characters with at least 1 number</small>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="confirm-password" name="password_confirmation"
                                        class="form-control bg-light bg-opacity-50 border-light py-2"
                                        placeholder="Confirm new password" required>
                                    <i class="fas fa-eye-slash password-toggle"
                                        onclick="togglePassword('confirm-password')"></i>
                                </div>

                                <div class="mb-1 text-center d-grid">
                                    <button class="btn btn-danger py-2" type="submit">Update Password</button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('admin/assets/js/vendor.js') }}"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <!-- Custom JavaScript for Password Toggle -->
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        // Password strength indicator
        document.getElementById('new-password').addEventListener('input', function() {
            const password = this.value;
            const meter = document.getElementById('password-strength-meter');
            let strength = 0;

            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

            // Update meter
            const width = strength * 20;
            meter.style.width = width + '%';

            // Update color
            if (width <= 40) {
                meter.style.backgroundColor = '#dc3545'; // Red
            } else if (width <= 80) {
                meter.style.backgroundColor = '#ffc107'; // Yellow
            } else {
                meter.style.backgroundColor = '#28a745'; // Green
            }
        });
    </script>
</body>

</html>
