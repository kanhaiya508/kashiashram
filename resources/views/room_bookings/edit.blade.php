<x-app-layout>
    <div class="container-xxl py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Dashboard /</span> Edit Booking #{{ $booking->id }}
            </h4>

            <form action="{{ route('room-bookings.add-room', $booking->id) }}" method="POST"
                class="d-flex gap-2 align-items-center mt-3 mt-md-0">
                @csrf
                <div class="input-group">
                    <select name="room_id" class="form-select" required>
                        <option value="">-- Select Room --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @if ($booking->rooms->pluck('room.id')->contains($room->id)) disabled @endif>
                                {{ $room->name }} (Beds: {{ $room->no_of_beds }})
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">
                        Add Room
                    </button>
                </div>
            </form>
        </div>




        <form action="{{ route('room-bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card shadow-sm rounded">
                <div class="card-header">
                    <h5 class="card-title
                    mb-0">Customer Detail</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        {{-- Customer Details --}}
                        <div class=" col-md-3 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $booking->name) }}" required>
                        </div>

                        <div class=" col-md-3  mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $booking->phone) }}" required>
                        </div>

                        <div class="  col-md-3  mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $booking->email) }}">
                        </div>

                        <div class="  col-md-3  mb-3">
                            <label class="form-label">Aadhar</label>
                            <input type="text" name="aadhar" class="form-control"
                                value="{{ old('aadhar', $booking->aadhar) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="gothra">Gothra</label>
                            <input type="text" id="gothra" name="gothra"
                                value="{{ old('gothra', $booking->gothra) }}" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="user_type">User Type</label>
                            <select name="user_type" id="user_type" class="form-control">
                                <option value="Donar"
                                    {{ old('user_type', $booking->user_type) == 'Donar' ? 'selected' : '' }}>Donar
                                </option>
                                <option value="New Yatri"
                                    {{ old('user_type', $booking->user_type) == 'New Yatri' ? 'selected' : '' }}>New
                                    Yatri</option>
                                <option value="Regular Yatri"
                                    {{ old('user_type', $booking->user_type) == 'Regular Yatri' ? 'selected' : '' }}>
                                    Regular Yatri</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="travel_type">Travel Type</label>
                            <select name="travel_type" id="travel_type" class="form-control">
                                <option value="Bus"
                                    {{ old('travel_type', $booking->travel_type) == 'Bus' ? 'selected' : '' }}>Bus
                                </option>
                                <option value="Train"
                                    {{ old('travel_type', $booking->travel_type) == 'Train' ? 'selected' : '' }}>Train
                                </option>
                                <option value="Flight"
                                    {{ old('travel_type', $booking->travel_type) == 'Flight' ? 'selected' : '' }}>
                                    Flight</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Adults</label>
                            <input type="number" name="adults" class="form-control"
                                value="{{ old('adults', $booking->adults) }}" min="1" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Children</label>
                            <input type="number" name="children" class="form-control"
                                value="{{ old('children', $booking->children) }}" min="0" required>
                        </div>
                        {{-- Status --}}
                        <div class="  col-md-4  mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                @foreach (['applied', 'booked', 'cancelled', 'completed'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status', $booking->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="payment_status" class="form-label fw-semibold">Payment Status</label>
                            <select name="payment_status" id="payment_status" class="form-select" required>
                                <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                            </select>
                        </div>

                        <div class="  col-md-12  mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control">{{ old('message', $booking->message) }}</textarea>
                        </div>
                    </div>





                </div>
            </div>

            <div class="card mt-3 shadow-sm rounded">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <h5 class="card-title
                    mb-0">Rooms Detail</h5>
                        </div>


                    </div>
                </div>
                <div class="card-body">
                    <div id="rooms-container">
                        @foreach ($booking->rooms as $roomBooking)
                            @php $room = $roomBooking->room; @endphp
                            <div class="mb-3 border p-3 rounded room-entry">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div
                                        class="d-flex flex-column flex-md-row align-items-start align-items-md-center mb-3 mb-md-0">
                                        {{-- Room Image --}}
                                        <img src="{{ asset($room->image) }}" alt="{{ $room->name }}"
                                            class="rounded me-md-3 mb-2 mb-md-0"
                                            style="width: 100%; height: auto; max-width: 100px; object-fit: cover;">

                                        {{-- Room Details --}}
                                        <div>
                                            <strong class="fs-5">{{ $room->name }}</strong><br>
                                            <small class="text-muted">
                                                Ashram: {{ $room->ashram->name ?? 'N/A' }}<br>
                                                Beds: {{ $room->no_of_beds }}<br>
                                                Type: {{ ucfirst($room->room_type) }}<br>
                                                Donation: ₹{{ number_format($room->donation) }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <label class="form-label me-2 mb-0">Amount:</label>
                                        <input type="number" name="amounts[{{ $room->id }}]"
                                            value="{{ old('amounts.' . $room->id, $roomBooking->amount) }}"
                                            class="form-control" style="width:120px" min="0" required>

                                        <button type="button" class="btn btn-outline-danger btn-sm remove-room-btn"
                                            title="Remove Room" data-room-booking-id="{{ $roomBooking->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <input type="hidden" name="room_ids[]" value="{{ $room->id }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Booking</button>
                </div>
            </div>

        </form>




    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomsContainer = document.getElementById('rooms-container');

            roomsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-room-btn')) {
                    const btn = e.target.closest('.remove-room-btn');
                    const roomBookingId = btn.getAttribute('data-room-booking-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you really want to remove this room?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, remove it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('room-bookings.remove-room', $booking->id) }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    body: JSON.stringify({
                                        room_booking_id: roomBookingId
                                    }),
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        const roomDiv = btn.closest('.room-entry');
                                        if (roomDiv) roomDiv.remove();

                                        Swal.fire(
                                            'Removed!',
                                            data.message,
                                            'success'
                                        );
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            data.message || 'Failed to remove room.',
                                            'error'
                                        );
                                    }
                                });
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
