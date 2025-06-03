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
                                <th   style=" background-color: #5a5e61; color: #fff;" class="text-nowrap">{{ \Carbon\Carbon::parse($date)->format('d M') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <!-- Sticky Room Column -->
                                <td class="fw-bold bg-light text-start" style="position: sticky; left: 0; z-index: 10;">
                                    {{ $room->name }}
                                </td>

                                <!-- Dates -->
                                @foreach ($dateRange as $date)
                                    @php
                                        $isBooked = in_array($date, $room->booked_dates);
                                    @endphp
                                    <td class="{{ $isBooked ? 'bg-danger text-white' : 'bg-success text-white' }}">
                                        {{ $isBooked ? 'Booked' : 'Available' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>
