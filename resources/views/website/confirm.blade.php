@extends('website.layout')
@section('content')


    <div class="sigma_subheader dark-overlay dark-overlay-1"
        style="background-image: url({{ asset('website/assets/img/subheader.jpg') }})">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Confirm Booking</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Confirm Booking</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <div class="section">
        <div class="container">

            <form action="{{ route('web.room-bookings.confirm.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Left: Room Details --}}
                    <div class="col-md-6">
                        <div class="card mb-4 shadow-sm rounded">
                            <div class="card-body">
                                <h5 class="mb-4 text-center ">Selected Rooms</h5>

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

                                            <p class="mb-2">
                                                <strong class="">Type: <span
                                                        class="text-muted">{{ $room->room_type }}</span></strong>
                                                <strong class="mx-2">Beds: <span
                                                        class="text-muted">{{ $room->no_of_beds }}</span></strong>
                                                <strong class="">Room size : <span class="text-muted">LxB
                                                        13/12</span></strong>


                                            </p>
                                            <div class="mt-3 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <label class="me-2 mb-0 fw-semibold">Amount:</label>
                                                    <b class="text-success fs-5">₹{{ number_format($room->donation) }}</b>
                                                    <input type="hidden" class="room-amount-input"
                                                        name="amounts[{{ $room->id }}]" value="{{ $room->donation }}">

                                                </div>
                                                <button type="button" class="sigma_btn-custom p-2   btn-toggle-cart"
                                                    data-room-id="{{ $room->id }}" data-action="remove"
                                                    data-donation="{{ $room->donation }}">
                                                    <i class="fas fa-times-circle me-1"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-end fw-bold fs-5 mt-3">
                                    <div>Estimated Total: ₹<span id="estimated-total">{{ $total }}</span></div>
                                    <div>Room Capacity Total: <span id="room-capacity-total">{{ $room_capacity }}</span>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>

                    {{-- Right: Customer Info --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3  text-center ">Customer Details</h5>

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
                                            @for ($i = 1; $i <= $room_capacity; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('adults') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="children" class="form-label">Number of Children</label>
                                        <select id="children" name="children" class="form-select" required>
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('children') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
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

                                <button type="submit" class="sigma_btn-custom  mt-2">Confirm Booking</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.room-amount-input');
            const totalDisplay = document.getElementById('total-amount');
            const adultsSelect = document.querySelector('[name="adults"]');
            const childrenSelect = document.querySelector('[name="children"]');

            const capacityCount = document.getElementById('room-capacity-count');
            const totalPeopleCount = document.getElementById('total-people-count');
            const extraPersonCount = document.getElementById('extra-person-count');
            const extraChargeAmount = document.getElementById('extra-charge-amount');

            function getTotalRoomCapacity() {
                let totalCapacity = 0;
                @foreach ($rooms as $room)
                    totalCapacity += {{ $room->room_capacity }};
                @endforeach
                return totalCapacity;
            }

            function updateTotal() {
                let total = 0;
                inputs.forEach(input => {
                    const value = parseFloat(input.value);
                    if (!isNaN(value)) {
                        total += value;
                    }
                });

                const adults = parseInt(adultsSelect.value) || 0;
                const children = parseInt(childrenSelect.value) || 0;
                const totalPeople = adults + children;

                const roomCapacity = getTotalRoomCapacity();

                // Update counts
                capacityCount.textContent = roomCapacity;
                totalPeopleCount.textContent = totalPeople;

                let extraPeople = 0;
                let extraCharge = 0;
                if (totalPeople > roomCapacity) {
                    extraPeople = totalPeople - roomCapacity;
                    extraCharge = extraPeople * 299;
                }

                extraPersonCount.textContent = extraPeople;
                extraChargeAmount.textContent = extraCharge;

                total += extraCharge;
                totalDisplay.textContent = total.toFixed(2);
            }

            // Event listeners
            inputs.forEach(input => input.addEventListener('input', updateTotal));
            adultsSelect.addEventListener('change', updateTotal);
            childrenSelect.addEventListener('change', updateTotal);

            updateTotal(); // Initial call
        });
    </script>

@endsection
