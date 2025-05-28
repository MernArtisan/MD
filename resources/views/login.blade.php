<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Mario Davidson</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="A fully responsive premium admin dashboard template, Real Estate Management Admin Template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('admin/assets/images/md-logo.png') }}">
    <link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/assets/js/config.min.js') }}"></script>
</head>

<body class="authentication-bg">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card auth-card">
                        <div class="card-body px-3 py-5">
                            <div class="mx-auto mb-4 text-center auth-logo">
                                <a href="#" class="logo-dark">
                                    <img src="{{ asset('admin/assets/images/md-logo.png') }}" height="32"
                                        alt="logo dark">
                                </a>
                                <a href="#" class="logo-light">
                                    <img src="{{ asset('admin/assets/images/md-logo.png') }}" height="28"
                                        alt="logo light">
                                </a>
                            </div>

                            <h2 class="fw-bold text-uppercase text-center fs-18">Sign In</h2>
                            <p class="text-muted text-center mt-1 mb-4">Enter your email address and password to access
                                admin panel.</p>

                            <div class="px-4">
                                <form action="{{ route('login.submit') }}" method="POST" class="authentication-form">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="example-email">Email</label>
                                        <input type="email" id="example-email" name="email"
                                            class="form-control bg-light bg-opacity-50 border-light py-2"
                                            placeholder="Enter your email" required>
                                        @error('email')
                                            <div class="text-danger small mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        {{-- <a href="{{ route('password') }}" class="float-end text-muted text-unline-dashed ms-1">Reset password</a> --}}
                                        <label class="form-label" for="example-password">Password</label>
                                        <input type="password" id="example-password" name="password"
                                            class="form-control bg-light bg-opacity-50 border-light py-2"
                                            placeholder="Enter your password" required>
                                        @error('password')
                                            <div class="text-danger small mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-3">
                                                  <div class="form-check">
                                                       <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                                                       <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                                  </div>
                                             </div> --}}

                                    <div class="mb-1 text-center d-grid">
                                        <button class="btn btn-danger py-2 fw-medium" type="submit">Sign In</button>
                                    </div>
                                </form>

                                {{-- <p class="mt-3 fw-semibold no-span">OR sign with</p>
                                        <div class="text-center">
                                             <a href="javascript:void(0);" class="btn btn-outline-light shadow-none"><i class='bx bxl-google fs-20'></i></a>
                                             <a href="javascript:void(0);" class="btn btn-outline-light shadow-none"><i class='ri-facebook-fill fs-20'></i></a>
                                             <a href="javascript:void(0);" class="btn btn-outline-light shadow-none"><i class='bx bxl-github fs-20'></i></a>
                                        </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>

</html>
