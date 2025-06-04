<x-app-layout>

    <style>
        <style>td,
        th {
            white-space: nowrap;
            vertical-align: middle !important;
        }

        td.bg-success {
            background-color: #198754 !important;
        }

        td.bg-danger {
            background-color: #dc3545 !important;
        }

        table.table-bordered td,
        table.table-bordered th {
            border: 1px solid #dee2e6;
        }

        tr:hover td {
            background-color: #f9f9f9;
        }
    </style>
    </style>
    <div class="container py-4">

        <!-- 🟦 Step 1: Filter Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('room-calendar') }}">
                    <div class="row align-items-end">
                        <!-- Select Ashram -->
                        <div class="col-md-3">
                            <label class="form-label">Select Ashram</label>
                            <select name="ashram_id" class="form-select" required>
                                <option value="">Select Ashram</option>
                                @foreach ($ashrams as $ashram)
                                    <option value="{{ $ashram->id }}"
                                        {{ ($ashramId ?? '') == $ashram->id ? 'selected' : '' }}>
                                        {{ $ashram->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}"
                                required>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ $endDate ?? '' }}" min="{{ $startDate ?? '' }}" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-3 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Check Availability</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        @if (isset($rooms))
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" style="min-width: max-content;">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start"
                                style="position: sticky; left: 0; z-index: 11; background-color: #343a40; color: #fff;">
                                Room Name
                            </th>
                            @foreach ($dateRange as $date)
                                <th style=" background-color: #5a5e61; color: #fff;" class="text-nowrap">
                                    {{ \Carbon\Carbon::parse($date)->format('d M') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td class="fw-bold bg-light text-start" style="position: sticky; left: 0; z-index: 10;">
                                    <strong>Name:</strong> {{ $room->name }} <br> <strong>Type:</strong>
                                    {{ $room->room_type }}
                                </td>

                                @foreach ($dateRange as $date)
                                    @php
                                        $isBooked = in_array($date, $room->booked_dates);
                                    @endphp
                                    @if ($isBooked)
                                        <td class="bg-danger text-white" data-bs-toggle="modal"
                                            data-bs-target="#bookingModal{{ $room->id }}{{ \Carbon\Carbon::parse($date)->format('Ymd') }}">
                                            Booked
                                        </td>
                                    @else
                                        <td class="bg-success text-white">Available</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Modals inside each booked cell --}}
                @foreach ($rooms as $room)
                    @foreach ($dateRange as $date)
                        @php
                            $isBooked = in_array($date, $room->booked_dates);
                            $info = $room->booking_details_by_date[$date] ?? null;
                        @endphp

                        @if ($isBooked && $info)
                            <div class="modal fade"
                                id="bookingModal{{ $room->id }}{{ \Carbon\Carbon::parse($date)->format('Ymd') }}"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title text-white">Booking Details - {{ $room->name }} on
                                                {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3 text-danger fw-bold">
                                                Booking ID:
                                                <a href="{{ route('room-bookings.invoice', $info['booking_id']) }}"
                                                    class="text-danger text-decoration-underline">
                                                    {{ $info['booking_id'] }}
                                                </a>
                                            </h6>

                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Name:</strong></div>
                                                <div class="col-6">{{ $info['name'] }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Phone:</strong></div>
                                                <div class="col-6">{{ $info['phone'] }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Aadhar:</strong></div>
                                                <div class="col-6">{{ $info['aadhar'] }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Status:</strong></div>
                                                <div class="col-6">{{ ucfirst($info['status']) }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Amount:</strong></div>
                                                <div class="col-6">₹{{ $info['amount'] }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Room:</strong></div>
                                                <div class="col-6">{{ $info['room_name'] }}
                                                    ({{ $info['room_type'] }})</div>
                                            </div>

                                            <div class="text-end mt-4">
                                                <a href="{{ route('room-bookings.invoice', $info['booking_id']) }}"
                                                    class="btn btn-outline-primary btn-sm" target="_blank" download>
                                                    <i class="bi bi-download"></i> Download Invoice
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach


            </div>
        @endif

    </div>
</x-app-layout>
