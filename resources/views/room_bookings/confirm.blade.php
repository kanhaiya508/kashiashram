<x-app-layout>
    <div class="container-xxl py-4">
        <h4 class="fw-bold mb-4">Finalize Your Booking</h4>

        <form action="{{ route('room-bookings.confirm.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-12">
                    <div class="card shadow border-0 bg-light mb-4">
                        <div class="card-header mb-3 bg-primary text-white fw-bold">
                            <i class="fas fa-bed me-2"></i> Selected Rooms Summary
                        </div>
                        <div class="card-body bg-white">
                            {{-- Booking Date Info --}}
                            <div class="row mb-4">
                                @php
                                    $checkin = \Carbon\Carbon::parse(session('booking_from'));
                                    $checkout = \Carbon\Carbon::parse(session('booking_to'));
                                @endphp

                                <div class="col-md-4">
                                    <div class="bg-success text-white p-3 rounded shadow-sm">
                                        <strong>Check-in:</strong><br>
                                        {{ $checkin->format('d M Y') }} <br>
                                        <small>Time: {{ $checkin->format('h:i A') }}</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-danger text-white p-3 rounded shadow-sm">
                                        <strong>Check-out:</strong><br>
                                        {{ $checkout->format('d M Y') }} <br>
                                        <small>Time: {{ $checkout->format('h:i A') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $from = \Carbon\Carbon::parse(session('booking_from'));
                                        $to = \Carbon\Carbon::parse(session('booking_to'));
                                        $days = $from->diffInDays($to) + 1;
                                    @endphp
                                    <div class="bg-warning text-dark p-3 rounded">
                                        <strong>Total Days:</strong><br> <span
                                            id="total-days">{{ $days }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Rooms Display --}}
                            @php $total = 0; @endphp
                            @foreach ($rooms as $room)
                                @php $total += $room->donation; @endphp
                                <div class="d-flex mb-3 border rounded p-2 align-items-center shadow-sm"
                                    style="background-color: #f0f8ff;">
                                    <div style="width: 100px;">
                                        <img src="{{ asset($room->image) }}" class="img-fluid rounded shadow">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-primary fw-bold">{{ $room->name }}</h6>
                                        <small class="text-muted">Type: {{ $room->room_type }} | Beds:
                                            {{ $room->no_of_beds }} | Capacity: {{ $room->room_capacity }}</small>

                                        <div class="mt-2 d-flex align-items-center">
                                            <label class="me-2 mb-0 fw-semibold text-dark">Amount/Day:</label>
                                            <input type="number" name="amounts[{{ $room->id }}]"
                                                value="{{ $room->donation }}"
                                                class="form-control w-25 room-amount-input bg-warning-subtle border-warning text-dark fw-bold"
                                                data-room-id="{{ $room->id }}" min="0">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Totals --}}
                            <div class="row mt-4 text-end">
                                <div class="col-md-12">
                                    <div class="bg-info p-3 rounded text-white fw-bold fs-5 shadow-sm">
                                        <div>Estimated Per Day Total: ₹<span
                                                id="estimated-total-per-day">{{ $total }}</span></div>
                                        <div>Total Days: <span>{{ $days }}</span></div>
                                        <div>💰 Grand Total: ₹<span id="grand-total">{{ $total * $days }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h5 class="mb-3">Customer Details</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Customer Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Gothra</label>
                                    <input type="text" name="gothra" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>User Type</label>
                                    <select name="user_type" class="form-select">
                                        <option value="Donar">Donar</option>
                                        <option value="New Yatri">New Yatri</option>
                                        <option value="Regular Yatri">Regular Yatri</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Travel Type</label>
                                    <select name="travel_type" class="form-select">
                                        <option value="Bus">Bus</option>
                                        <option value="Train">Train</option>
                                        <option value="Flight">Flight</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Number of Adults</label>
                                    <select name="adults" class="form-select" required>
                                        @for ($i = 1; $i <= $room_capacity; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('adults') == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Number of Children</label>
                                    <input type="number" value="0" class="form-control" name="children"
                                        id="children">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Mail ID</label>
                                    <input type="email" name="email" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Aadhar Number</label>
                                    <input type="text" name="aadhar" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Booking Status</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="booked">Booked</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Payment Status</label>
                                    <select name="payment_status" class="form-select" required>
                                        <option value="unpaid" selected>Unpaid</option>
                                        <option value="advance_paid">Advance Paid</option>
                                        <option value="fully_paid">Fully Paid</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Paid Amount</label>
                                    <input type="number" name="paid_amount" class="form-control"
                                        max="{{ $total }}" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label>Message</label>
                                    <textarea name="message" rows="3" class="form-control"></textarea>
                                </div>
                            </div>



                            <button class="btn btn-success w-100">Confirm Booking</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const amountInputs = document.querySelectorAll('.room-amount-input');
            const totalPerDayElem = document.getElementById('estimated-total-per-day');
            const grandTotalElem = document.getElementById('grand-total');
            const totalDays = parseInt(document.getElementById('total-days').textContent) || 1;

            function updateTotals() {
                let totalPerDay = 0;
                amountInputs.forEach(input => {
                    const val = parseFloat(input.value) || 0;
                    totalPerDay += val;
                });

                totalPerDayElem.textContent = totalPerDay.toFixed(2);
                grandTotalElem.textContent = (totalPerDay * totalDays).toFixed(2);
            }

            amountInputs.forEach(input => {
                input.addEventListener('input', updateTotals);
            });

            updateTotals();
        });
    </script>


</x-app-layout>
