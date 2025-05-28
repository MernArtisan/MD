@extends('layouts.master')

@section('title', 'Calendar')

@section('content')
    <style>
        /* Styles kept exactly as you provided */
        .calendar-property {
            font-family: 'Arial', sans-serif;
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .calendar-property .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: #2c3e50;
            color: white;
        }
        .calendar-property .calendar-nav {
            display: flex;
            gap: 15px;
        }
        .calendar-property .calendar-nav button {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .calendar-property .calendar-nav button:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .calendar-property .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #eee;
        }
        .calendar-property .calendar-day-header {
            padding: 12px 5px;
            text-align: center;
            background: #34495e;
            color: white;
            font-weight: bold;
        }
        .calendar-property .calendar-day {
            padding: 10px 15px;
            min-height: 85px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .calendar-property .calendar-day:hover {
            background: #f8f9fa;
        }
        .calendar-property .calendar-day .date {
            font-weight: bold;
            margin-bottom: 3px;
        }
        .calendar-property .calendar-day.empty {
            background: #f0f0f0;
            cursor: default;
        }
        .calendar-property .booking-slots {
            display: none;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #eee;
        }
        .calendar-property .selected-date {
            font-size: 18px;
            margin-bottom: 15px;
            color: #2c3e50;
            font-weight: bold;
        }
        .calendar-property .property-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .calendar-property .property-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            align-items: center;
            gap: 10px;
        }
        .calendar-property .property-name {
            font-weight: bold;
            color: #2c3e50;
        }
        .calendar-property .price-label {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 3px;
        }
        .calendar-property .price-value {
            font-weight: bold;
            color: #27ae60;
        }
        .calendar-property .platform {
            text-align: center;
        }
        .calendar-property .platform-name {
            font-size: 14px;
            color: #7f8c8d;
        }
        @media (max-width: 768px) {
            .calendar-property .property-card {
                grid-template-columns: 1fr;
            }
            .calendar-property .platform {
                text-align: left;
                display: flex;
                justify-content: space-between;
            }
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-0 fw-semibold">Calendar</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('property')}}">Real Estate</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="calendar-property">
                <div class="calendar-header">
                    <div class="calendar-nav">
                        <button class="prev-month">Previous</button>
                        <h2 class="month-year">Month Year</h2>
                        <button class="next-month">Next</button>
                    </div>
                </div>

                <div class="calendar-grid">
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                </div>

                <div class="booking-slots" id="bookingSlots">
                    <div class="selected-date" id="selectedDate">Selected Date</div>
                    <div class="property-list" id="propertyList"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        function generateCalendar(month, year) {
            const calendarGrid = document.querySelector('.calendar-property .calendar-grid');
            const monthYearDisplay = document.querySelector('.calendar-property .month-year');

            while (calendarGrid.children.length > 7) {
                calendarGrid.removeChild(calendarGrid.lastChild);
            }

            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            monthYearDisplay.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day empty';
                calendarGrid.appendChild(emptyDay);
            }

            for (let i = 1; i <= daysInMonth; i++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';

                const dateElement = document.createElement('div');
                dateElement.className = 'date';
                dateElement.textContent = i;
                dayElement.appendChild(dateElement);

                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                dayElement.addEventListener('click', function() {
                    fetchPropertiesForDate(dateStr);
                });
                calendarGrid.appendChild(dayElement);
            }
        }

        function fetchPropertiesForDate(dateStr) {
            fetch(`/property/calendar/properties?date=${dateStr}`)
                .then(response => response.json())
                .then(properties => {
                    const bookingSlots = document.getElementById('bookingSlots');
                    const selectedDate = document.getElementById('selectedDate');
                    const propertyList = document.getElementById('propertyList');

                    const dateObj = new Date(dateStr);
                    const formattedDate = dateObj.toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    selectedDate.textContent = `Selected Date: ${formattedDate}`;
                    propertyList.innerHTML = '';

                    if (properties.length === 0) {
                        propertyList.innerHTML =
                            '<div style="text-align:center; color:#7f8c8d;">No properties available for this date</div>';
                    } else {
                        properties.forEach(property => {
                            const propertyCard = document.createElement('div');
                            propertyCard.className = 'property-card';
                            propertyCard.innerHTML = `
                                <div class="property-name">${property.property_name}</div>
                                <div class="platform">
                                    <div class="platform-name">Our Price</div>
                                    <div class="price-value">${property.pricing}</div>
                                </div>
                                <div class="platform">
                                    <div class="platform-name">AirBnB</div>
                                    <div class="price-value">${property.airbnb}</div>
                                </div>
                                <div class="platform">
                                    <div class="platform-name">Capital Vacation</div>
                                    <div class="price-value">${property.capitalvac}</div>
                                </div>
                            `;
                            propertyList.appendChild(propertyCard);
                        });
                    }

                    bookingSlots.style.display = 'block';
                    bookingSlots.scrollIntoView({ behavior: 'smooth' });
                })
                .catch(error => {
                    console.error('Error fetching properties:', error);
                });
        }

        generateCalendar(currentMonth, currentYear);

        document.querySelector('.prev-month').addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentMonth, currentYear);
        });

        document.querySelector('.next-month').addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentMonth, currentYear);
        });
    </script>
@endsection
