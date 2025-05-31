<x-app-layout>
    <div class="container-xxl py-4">
        <h4 class="fw-bold mb-4">Finalize Your Booking</h4>

        <form action="{{ route('room-bookings.confirm.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Left: Room Details --}}
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Selected Rooms</h5>

                            @php $total = 0; @endphp

                            @foreach ($rooms as $room)
                                @php $total += $room->donation; @endphp
                                <div class="d-flex mb-3 border-bottom pb-3 align-items-center">
                                    <div style="width: 100px; flex-shrink: 0;">
                                        <img src="{{ asset($room->image) }}" class="img-fluid rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <strong>{{ $room->name }}</strong><br>
                                        <span class="text-muted ">Type: {{ $room->room_type }} | Beds:
                                            {{ $room->no_of_beds }}</span>

                                        <div class="mt-2 d-flex align-items-center">
                                            <label class="me-2 mb-0 fw-semibold">Amount:</label>
                                            <input type="number" name="amounts[{{ $room->id }}]"
                                                value="{{ $room->donation }}"
                                                class="form-control  w-25 room-amount-input"
                                                data-room-id="{{ $room->id }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-end fw-bold fs-5 mt-3">
                                Estimated Total: ₹<span id="total-amount">{{ $total }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Customer Info --}}
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Customer Details</h5>

                            <div class="mb-3">
                                <label>Customer Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Gothra</label>
                                <input type="text" name="gothra" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>User Type</label>
                                <select name="user_type" class="form-control">
                                    <option value="Donar">Donar</option>
                                    <option value="General">General</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Travel Type</label>
                                <select name="travel_type" class="form-control">
                                    <option value="Bus">Bus</option>
                                    <option value="Train">Train</option>
                                    <option value="Flight">Flight</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label>Number of Adults</label>
                                <select name="adults" class="form-control" required>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('adults') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Number of Children</label>
                                <select name="children" class="form-control" required>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('children') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Mail ID</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Aadhar Number</label>
                                <input type="text" name="aadhar" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Booking Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="">-- Select Status --</option>
                                    <option value="booked">Booked</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label>Message</label>
                                <textarea name="message" rows="3" class="form-control"></textarea>
                            </div>



                            <button class="btn btn-success w-100">Confirm Booking</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.room-amount-input');
            const totalDisplay = document.getElementById('total-amount');

            function updateTotal() {
                let total = 0;
                inputs.forEach(input => {
                    const value = parseFloat(input.value);
                    if (!isNaN(value)) {
                        total += value;
                    }
                });
                totalDisplay.textContent = total.toFixed(2);
            }

            inputs.forEach(input => {
                input.addEventListener('input', updateTotal);
            });

            // Initial total sync (in case any default changed)
            updateTotal();
        });
    </script>

</x-app-layout>
