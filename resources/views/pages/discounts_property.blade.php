@extends('layouts.master')

@section('title', 'Discounts')

@section('content')
    <style>
        .report-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .report-filters {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .report-filters select,
        .report-filters input,
        .report-filters button {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .report-filters button {
            background-color: #4e66f8;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .report-filters button:hover {
            background-color: #3a56f5;
        }

        .export-btn {
            background-color: #27ae60 !important;
        }

        .export-btn:hover {
            background-color: #219653 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }

        .status-occupied {
            background-color: #d4edda;
            color: #155724;
        }

        .status-vacant {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-maintenance {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-sold {
            background-color: #f8d7da;
            color: #721c24;
        }

        .amount-positive {
            color: #27ae60;
            font-weight: 500;
        }

        .amount-negative {
            color: #e74c3c;
            font-weight: 500;
        }

        .property-type {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .type-villa {
            background-color: #e8f4fd;
            color: #0d6efd;
            border: 1px solid #0d6efd;
        }

        .type-apartment {
            background-color: #e7faf0;
            color: #198754;
            border: 1px solid #198754;
        }

        .type-condo {
            background-color: #f8f3fc;
            color: #6f42c1;
            border: 1px solid #6f42c1;
        }

        .type-townhouse {
            background-color: #fff9e6;
            color: #fd7e14;
            border: 1px solid #fd7e14;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .pagination button {
            padding: 8px 12px;
            border: 1px solid #ddd;

            border-radius: 5px;
            cursor: pointer;
        }

        .pagination button.active {
            background-color: #4e66f8;
            color: white;
            border-color: #4e66f8;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .summary-card h3 {
            margin-top: 0;
            font-size: 14px;
            color: #7f8c8d;
        }

        .summary-card p {
            margin-bottom: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .summary-card .positive {
            color: #27ae60;
        }

        .summary-card .negative {
            color: #e74c3c;
        }

        .property-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        @media (max-width: 768px) {

            th,
            td {
                padding: 8px 10px;
                font-size: 14px;
            }

            .report-filters {
                flex-direction: column;
                width: 100%;
            }

            .report-filters select,
            .report-filters input,
            .report-filters button {
                width: 100%;
            }

            .summary-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        button {
            background: #604ae3;
            color: #fff;
            border: #604ae3;
            padding: 10px;
        }
    </style>
    <!-- ========== App Menu End ========== -->

    <!-- ==================================================== -->
    <!-- Start right Content here -->
    <!-- ==================================================== -->
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- ========== Page Title Start ========== -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-0 fw-semibold">Discounts Available</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                            <li class="breadcrumb-item active">Add Property</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- ========== Page Title End ========== -->

            <!-- ========== My Code Start ========== -->
            <div class="report-container">
                <h1>Discounts Available Property</h1>

                <div class="summary-cards">
                    <div class="summary-card">
                        <h3>Total Properties</h3>
                        <p>{{ $discounts->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h3>Occupied</h3>
                        <p>{{ $discounts->where('status', 'occupied')->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h3>Vacant</h3>
                        <p>{{ $discounts->where('status', 'vacant')->count() }}</p>

                    </div>
                    <div class="summary-card">
                        <h3>Under Maintenance</h3>
                        <p>{{ $discounts->where('status', 'under_maintenance')->count() }}</p>

                    </div>
                </div>

                <!-- Filter UI -->
                <div class="report-header">
                    <div class="report-filters">
                        <select id="status-filter" style="display: none">
                            <option value="">All Statuses</option>
                            <option value="occupied">Occupied</option>
                            <option value="vacant">Vacant</option>
                            <option value="under_maintenance">Under Maintenance</option>
                            <option value="sold">Sold</option>
                            <option value="available">Available</option>
                            <option value="rented">Rented</option>
                            <option value="booking">Booking</option>
                        </select>
                        <select id="type-filter">
                            <option value="">All Types</option>
                            <option value="villas">Villas</option>
                            <option value="residences">Residences</option>
                            <option value="bungalow">Bungalow</option>
                            <option value="apartment">Apartment</option>
                            <option value="penthouse">Penthouse</option>
                            <option value="condo">Condo</option>
                            <option value="resort">Resort</option>
                        </select>
                        <input type="number" id="price-filter" placeholder="Max Price">
                        <button id="filter-btn"><i class="bi bi-funnel"></i> Filter</button>
                        <button id="reset-btn"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                    </div>
                </div>

                <!-- Property Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Property ID</th>
                            <th>Image</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Discount (%)</th>
                            <th>Discounted Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $property)
                            <tr data-id="{{ $property->id }}">
                                <td>{{ $property->id }}</td>
                                <td>
                                    @if (isset($property->galleries[0]) && $property->galleries[0]->image)
                                        <img src="{{ asset($property->galleries[0]->image) }}" alt="Property Image"
                                            class="property-image img-thumbnail" />
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $property->location }}</td>
                                <td>
                                    <span class="property-type">
                                        {{ ucfirst($property->type) }}
                                    </span>
                                </td>
                                <td>${{ $property->pricing }}</td>
                                <td>
                                    <input type="number" class="discount-input" min="0" max="100"
                                        step="1" value="{{ $property->disc_percent ?? 0 }}" style="width: 80px;"
                                        data-original-price="{{ $property->pricing }}"
                                        data-property-id="{{ $property->id }}" />
                                </td>
                                <td>
                                    <span class="discounted-price">
                                        ${{ $property->discounted ?? $property->pricing }}
                                    </span>
                                </td>
                                <td>
                                    <button class="apply-discount btn btn-sm btn-primary"
                                        data-property-id="{{ $property->id }}">
                                        Apply
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- JavaScript for Filter and Reset -->


                <div class="pagination">
                    {{ $discounts->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtn = document.getElementById('filter-btn');
            const resetBtn = document.getElementById('reset-btn');
            const statusFilter = document.getElementById('status-filter');
            const typeFilter = document.getElementById('type-filter');
            const priceFilter = document.getElementById('price-filter');
            const rows = document.querySelectorAll('table tbody tr');

            filterBtn.addEventListener('click', function() {
                const selectedType = typeFilter.value.toLowerCase();
                const maxPrice = parseFloat(priceFilter.value);

                rows.forEach(row => {
                    const typeText = row.querySelector('.property-type')?.textContent.trim()
                        .toLowerCase();
                    const priceText = row.querySelector('td:nth-child(5)')?.textContent.replace(
                        /[^0-9.]/g, '');
                    const price = parseFloat(priceText);

                    const matchesType = !selectedType || typeText === selectedType;
                    const matchesPrice = isNaN(maxPrice) || price <= maxPrice;

                    row.style.display = (matchesType && matchesPrice) ? '' : 'none';
                });
            });

            resetBtn.addEventListener('click', function() {
                statusFilter.value = '';
                typeFilter.value = '';
                priceFilter.value = '';

                rows.forEach(row => {
                    row.style.display = '';
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Calculate and update discounted price when discount input changes
            document.querySelectorAll('.discount-input').forEach(input => {
                input.addEventListener('input', function() {
                    const originalPrice = parseFloat(this.dataset.originalPrice);
                    const discountPercent = parseFloat(this.value) || 0;
                    const discountedPrice = originalPrice * (1 - discountPercent / 100);

                    // Find the corresponding discounted price span
                    const row = this.closest('tr');
                    const discountedPriceSpan = row.querySelector('.discounted-price');

                    // Update the displayed price
                    discountedPriceSpan.textContent = '$' + discountedPrice.toLocaleString(
                        'en-US', {
                            maximumFractionDigits: 2,
                            minimumFractionDigits: 2
                        });
                });
            });

            // Handle apply discount button click

        });

        $(document).ready(function() {
            $('.apply-discount').on('click', function() {
                const $button = $(this);
                const propertyId = $button.data('property-id');
                const $row = $button.closest('tr');
                const $discountInput = $row.find('.discount-input');
                const discountPercent = parseFloat($discountInput.val()) || 0;
                const discountedPrice = parseFloat(
                    $row.find('.discounted-price').text().replace(/[^0-9.-]+/g, "")
                );

                // Show loading state
                const originalText = $button.html();
                $button.html('<i class="fas fa-spinner fa-spin"></i> Applying...');
                $button.prop('disabled', true);

                // Send AJAX request to save the discount
                $.ajax({
                    url: `/property/${propertyId}/apply-discount`,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'PUT',
                        discount_percent: discountPercent,
                        discount_price: discountedPrice
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success('Discount applied successfully!');
                        } else {
                            toastr.error('Failed to apply discount');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred');
                        console.error('Error:', error);
                    },
                    complete: function() {
                        $button.html(originalText);
                        $button.prop('disabled', false);
                    }
                });

            });

        });
    </script>
@endsection
