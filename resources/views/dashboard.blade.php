@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- ========== Page Title Start ========== -->
            <!-- Start here.... -->
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-6">
                                    <div class="avatar-md bg-light bg-opacity-50 rounded">
                                        <iconify-icon icon="solar:buildings-2-broken"
                                            class="fs-32 text-primary avatar-title"></iconify-icon>
                                    </div>
                                    <p class="text-muted mb-2 mt-3">No. of Properties</p>
                                    <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">2,854 <span
                                            class="badge text-success bg-success-subtle fs-12"><i
                                                class="ri-arrow-up-line"></i>7.34%</span></h3>
                                </div> <!-- end col -->
                                <div class="col-6">
                                    <div id="total_customers" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-6">
                                    <div class="avatar-md bg-light bg-opacity-50 rounded">
                                        <iconify-icon icon="solar:users-group-two-rounded-broken"
                                            class="fs-32 text-primary avatar-title"></iconify-icon>
                                    </div>
                                    <p class="text-muted mb-2 mt-3">List Property</p>
                                    <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">705 <span
                                            class="badge text-success bg-success-subtle fs-12"><i
                                                class="ri-arrow-up-line"></i>76.89%</span></h3>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <div id="invoiced_customers" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-5">
                                    <div class="avatar-md bg-light bg-opacity-50 rounded">
                                        <iconify-icon icon="solar:shield-user-broken"
                                            class="fs-32 text-primary avatar-title"></iconify-icon>
                                    </div>
                                    <p class="text-muted mb-2 mt-3">Total Property</p>
                                    <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">9,431 <span
                                            class="badge text-danger bg-danger-subtle fs-12"><i
                                                class="ri-arrow-down-line"></i>45.00%</span></h3>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <div id="new_sale" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
            <!-- ========== Page Title End ========== -->

        </div>
        <!-- End Container Fluid -->
        <div class="container mt-10">
            <div class="row text-center">
                <h1 class="mb-4">Our Partners</h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-5">
                                    <div class="plat-logo">
                                        <a href="#" class="logo-dark">
                                            <img src="{{asset('admin/assets/images/platform/airbnb.png')}}" class="logo-sm desh-img"
                                                alt="airbnb"></a>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <div id="new_sale" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-5">
                                    <div class="plat-logo">
                                        <a href="#" class="logo-dark">
                                            <img src="{{asset('admin/assets/images/platform/hotels.png')}}" class="logo-sm desh-img"
                                                alt="airbnb"></a>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <div id="new_sale" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-5">
                                    <div class="plat-logo">
                                        <a href="#" class="logo-dark">
                                            <img src="{{asset('admin/assets/images/platform/expedia.png')}}" class="logo-sm desh-img"
                                                alt="airbnb"></a>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <div id="new_sale" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-5">
                                    <div class="plat-logo">
                                        <a href="#" class="logo-dark">
                                            <img src="{{asset('admin/assets/images/platform/booking.com.png')}}" class="logo-sm desh-img"
                                                alt="airbnb"></a>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <div id="new_sale" class="apex-charts"></div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
        </div>

      

    </div>
@endsection
