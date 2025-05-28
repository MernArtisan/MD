@extends('layouts.master')

@section('title', 'Reports')

@section('content')
    <style>
        .report-container {
            max-width: 1400px;
            margin: 0 auto 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
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
            flex-grow: 1;
        }

        .report-filters select,
        .report-filters input[type="number"],
        .report-filters button {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .report-filters select:focus,
        .report-filters input[type="number"]:focus {
            outline: none;
            border-color: #4e66f8;
            box-shadow: 0 0 6px #4e66f8aa;
        }

        .report-filters button {
            background-color: #4e66f8;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .report-filters button:hover {
            background-color: #3a56f5;
        }

        .export-btn {
            background-color: #27ae60 !important;
            color: #fff !important;
            padding: 8px 15px;
            border-color: #27ae60 !important;
            border-radius: 5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            white-space: nowrap;
        }

        .export-btn:hover {
            background-color: #219653 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: middle;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
            position: sticky;
            top: 0;
            z-index: 1;
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
            min-width: 85px;
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

        .status-available {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #664d03;
        }

        .status-rented {
            background-color: #cff4fc;
            color: #055160;
        }

        .status-inactive {
            background-color: #e2e3e5;
            color: #41464b;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
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
            background: white;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .pagination button.active {
            background-color: #4e66f8;
            color: white;
            border-color: #4e66f8;
        }

        .pagination button:hover:not(.active) {
            background-color: #e7e7e7;
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
            text-align: center;
        }

        .summary-card h3 {
            margin-top: 0;
            font-size: 14px;
            color: #7f8c8d;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .summary-card p {
            margin-bottom: 0;
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
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
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-0 fw-semibold">Management Reports</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Real Estate</a></li>
                            <li class="breadcrumb-item active">Add Property</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="report-container">
                <h1>Property Management Reports</h1>
                <div class="summary-cards">
                    <div class="summary-card">
                        <h3>Total Properties</h3>
                        <p>{{ $reports->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h3>Occupied</h3>
                        <p>{{ $reports->where('status', 'occupied')->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h3>Vacant</h3>
                        <p>{{ $reports->where('status', 'vacant')->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h3>Under Maintenance</h3>
                        <p>{{ $reports->where('status', 'under_maintenance')->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h3>Pending</h3>
                        <p>{{ $reports->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
                <div class="report-header">
                    <div class="report-filters">
                        <select id="status-filter">
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
                        <input type="number" id="price-filter" placeholder="Max Price" min="0" step="1000">
                        <button id="filter-btn"><i class="bi bi-funnel"></i> Filter</button>
                        <button id="reset-btn"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                    </div>
                </div>
            </div>
            {{-- <button class="export-btn" id="export-btn" type="button"><i class="bi bi-download"></i> Export</button> --}}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Property ID</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>
                            @if (isset($report->galleries[0]) && $report->galleries[0]->image)
                                <img src="{{ asset($report->galleries[0]->image) }}" alt="Property Image"
                                    class="property-image img-thumbnail" />
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $report->location }}</td>
                        <td>{{ ucfirst($report->type) }}</td>
                        <td>${{ number_format($report->pricing, 0, '.', ',') }}</td>
                        <td>
                            @php
                                $status = strtolower($report->status);
                            @endphp
                            <span
                                class="status
                                @if ($status === 'available') status-available
                                @elseif ($status === 'occupied') status-occupied
                                @elseif ($status === 'pending') status-pending
                                @elseif ($status === 'sold') status-sold
                                @elseif ($status === 'rented') status-rented
                                @elseif ($status === 'under_maintenance') status-maintenance
                                @elseif ($status === 'inactive') status-inactive
                                @elseif ($status === 'vacant') status-vacant
                                @else badge-secondary @endif">
                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a href="{{ route('details', $report->id) }}" class="btn btn-sm btn-info"
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('edit_property', $report->id) }}" class="btn btn-sm btn-primary"
                                    title="Edit Property">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('delete_property', $report->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this property?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination example if $reports is a paginator --}}
        {{-- 
            @if ($reports->hasPages())
            <div class="mt-3">
                {{ $reports->links() }}
            </div>
            @endif 
            --}}

        <div class="pagination" id="pagination"></div>
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
            const selectedStatus = statusFilter.value.toLowerCase();
            const selectedType = typeFilter.value.toLowerCase();
            const maxPrice = parseFloat(priceFilter.value) || Infinity;

            rows.forEach(row => {
                // Get status from the status span's text content
                const statusSpan = row.querySelector('.status');
                const statusText = statusSpan ? statusSpan.textContent.trim().toLowerCase().replace(' ', '_') : '';
                
                // Get type from the type cell (4th column)
                const typeCell = row.querySelector('td:nth-child(4)');
                const typeText = typeCell ? typeCell.textContent.trim().toLowerCase() : '';
                
                // Get price from the price cell (5th column)
                const priceCell = row.querySelector('td:nth-child(5)');
                const priceText = priceCell ? priceCell.textContent.replace(/[^0-9.]/g, '') : '';
                const price = parseFloat(priceText);

                // Check if row matches all selected filters
                const matchesStatus = !selectedStatus || statusText === selectedStatus;
                const matchesType = !selectedType || typeText === selectedType;
                const matchesPrice = price <= maxPrice;

                // Show or hide the row based on filter matches
                row.style.display = (matchesStatus && matchesType && matchesPrice) ? '' : 'none';
            });
        });

        resetBtn.addEventListener('click', function() {
            statusFilter.value = '';
            typeFilter.value = '';
            priceFilter.value = '';

            // Show all rows
            rows.forEach(row => {
                row.style.display = '';
            });
        });

        // Also filter when Enter is pressed in price field
        priceFilter.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                filterBtn.click();
            }
        });
    });

    // Discount functionality remains the same
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.discount-input').forEach(input => {
            input.addEventListener('input', function() {
                const originalPrice = parseFloat(this.dataset.originalPrice);
                const discountPercent = parseFloat(this.value) || 0;
                const discountedPrice = originalPrice * (1 - discountPercent / 100);

                const row = this.closest('tr');
                const discountedPriceSpan = row.querySelector('.discounted-price');

                discountedPriceSpan.textContent = '$' + discountedPrice.toLocaleString('en-US', {
                    maximumFractionDigits: 2,
                    minimumFractionDigits: 2
                });
            });
        });
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
