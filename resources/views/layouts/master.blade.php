<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="A fully responsive premium admin dashboard template, Real Estate Management Admin Template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/md-logo.png') }}">
    <link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">
    <!-- Add these to your head section -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>

    <div class="wrapper">


        @include('layouts.header')

        @include('layouts.sidebar')

        @yield('content')

        <!-- ========== Footer Start ========== -->
        {{-- <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; MD by <iconify-icon icon="solar:hearts-bold-duotone"
                            class="fs-18 align-middle text-danger"></iconify-icon> <a href=""
                            class="fw-bold footer-text" target="_blank">Developer</a>
                    </div>
                </div>
            </div>
        </footer> --}}


    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin/assets/js/config.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('admin/assets/js/vendor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jsvectormap/maps/world.js') }}"></script>

    <script src="{{ asset('admin/assets/js/pages/dashboard-analytics.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2zcZWYTrnjovVYwCR9zwHJwVEtUEufJk&libraries=places">
    </script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('#daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>
    @yield('script')

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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-image-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (!confirm('Are you sure you want to delete this image?')) return;

                    const image = this.dataset.image;
                    const property_id = this.dataset.id;
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const container = this.closest('.position-relative');

                    fetch("{{ url('property/remove-image') }}", {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                image,
                                property_id
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                container.remove(); // Remove image from DOM
                            } else {
                                alert(data.error || 'Something went wrong');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Failed to delete image.');
                        });
                });
            });
        });
    </script>
    <script>
        @if (session('success'))
            var successSound = new Audio('{{ asset('admin/sounds/success.mp3') }}');
            successSound.play();
            toastr.success('{{ session('success') }}', 'Success');
        @endif

        @if (session('error'))
            var errorSound = new Audio('{{ asset('admin/sounds/error.mp3') }}');
            errorSound.play();
            toastr.error('{{ session('error') }}', 'Error');
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("property-photos");
            const previewContainer = document.getElementById("new-image-preview");

            fileInput.addEventListener("change", function() {
                previewContainer.innerHTML = ""; // Clear existing previews

                Array.from(fileInput.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement("div");
                        wrapper.classList.add("position-relative");
                        wrapper.style.width = "120px";
                        wrapper.style.height = "100px";

                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style.width = "100%";
                        img.style.height = "100%";
                        img.style.objectFit = "cover";
                        img.style.borderRadius = "6px";

                        wrapper.appendChild(img);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

</body>

</html>
