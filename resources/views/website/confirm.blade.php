@extends('website.layout')
@section('content')
    <style>
        select option[value="Donar"] {
            color: red;
        }

        select option[value="New Yatri"] {
            color: green;
        }

        select option[value="Regular Yatri"] {
            color: blue;
        }
    </style>
    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-center">Finalize Your Booking</h4>

        <form action="{{ route('web.room-bookings.confirm.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Left: Room Details --}}
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="mb-4 fw-semibold text-primary">Selected Rooms</h5>

                            @php $total = 0; @endphp
                            @foreach ($rooms as $room)
                                @php $total += $room->donation; @endphp
                                <div class="d-flex mb-4 pb-3 border-bottom align-items-center room-item"
                                    data-donation="{{ $room->donation }}">
                                    <div style="width: 110px; flex-shrink: 0;">
                                        <img src="{{ asset($room->image) }}" class="img-fluid rounded shadow-sm"
                                            alt="{{ $room->name }}">
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <strong class="fs-5">{{ $room->name }}</strong><br>
                                        <small class="text-muted fst-italic">Type: {{ $room->room_type }} | Beds:
                                            {{ $room->no_of_beds }}</small>
                                        <div class="mt-3 d-flex align-items-center justify-content-between">
                                            <div>
                                                <label class="me-2 mb-0 fw-semibold">Amount:</label>
                                                <b class="text-success fs-5">₹{{ number_format($room->donation) }}</b>
                                                <input type="hidden" name="amounts[{{ $room->id }}]"
                                                    value="{{ $room->donation }}">
                                            </div>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-toggle-cart"
                                                data-room-id="{{ $room->id }}" data-action="remove"
                                                data-donation="{{ $room->donation }}">
                                                <i class="fas fa-times-circle me-1"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-end fw-bold fs-5 mt-4 text-dark">
                                Estimated Total: <span id="total-amount"
                                    class="text-primary">₹{{ number_format($total) }}</span>
                            </div>
                        </div>
                    </div>


                </div>

                {{-- Right: Customer Info --}}
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Customer Details</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="gothra" class="form-label">Gothra</label>
                                    <input type="text" id="gothra" name="gothra" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="adults" class="form-label">Number of Adults</label>
                                    <select id="adults" name="adults" class="form-select" required>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('adults') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="children" class="form-label">Number of Children</label>
                                    <select id="children" name="children" class="form-select" required>
                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('children') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Mail ID</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="user_type" class="form-label">User Type</label>
                                    <select id="user_type" name="user_type" class="form-select">
                                        <option value="Donar"> Donar </option>
                                        <option value="New Yatri"> New Yatri </option>
                                        <option value="Regular Yatri"> Regular Yatri </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="travel_type" class="form-label">Travel Type</label>
                                    <select id="travel_type" name="travel_type" class="form-select">
                                        <option value="Bus">Bus</option>
                                        <option value="Train">Train</option>
                                        <option value="Flight">Flight</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="aadhar" class="form-label">Aadhar Number</label>
                                    <input type="text" id="aadhar" name="aadhar" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" name="message" rows="3" class="form-control"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 mt-4">Confirm Booking</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalAmountElem = document.querySelector('#total-amount');

            // Parse initial total from page and convert to number
            let totalAmount = Number(totalAmountElem.textContent.replace(/[^0-9.-]+/g, ""));

            document.querySelectorAll('.btn-toggle-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const btn = this;
                    const roomId = btn.getAttribute('data-room-id');
                    const donation = Number(btn.getAttribute('data-donation'));

                    const route = '{{ route('room-bookings.remove-from-session') }}';

                    const originalHTML = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Removing...';

                    fetch(route, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                room_id: roomId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'removed') {
                                // Remove room from DOM
                                const roomDiv = btn.closest('.room-item');
                                if (roomDiv) {
                                    roomDiv.remove();
                                }

                                // Update total amount
                                totalAmount -= donation;
                                if (totalAmount < 0) totalAmount = 0;

                                // Format with commas (Indian format)
                                totalAmountElem.textContent = totalAmount.toLocaleString(
                                    'en-IN', {
                                        style: 'currency',
                                        currency: 'INR',
                                        minimumFractionDigits: 0
                                    });

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Removed!',
                                    text: 'Room removed from cart.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong. Please try again.'
                                });
                                btn.innerHTML = originalHTML;
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Network error. Please try again later.'
                            });
                            btn.innerHTML = originalHTML;
                        })
                        .finally(() => {
                            btn.disabled = false;
                        });
                });
            });
        });
    </script>

@endsection
