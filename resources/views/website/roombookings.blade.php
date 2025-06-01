@extends('website.layout')
@section('content')
    <div class="sigma_subheader dark-overlay dark-overlay-1"
        style="background-image: url({{ asset('website/assets/img/subheader.jpg') }})">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Room Book</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Room Book</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <div class="section">
        <div class="container">


            <div class="">
                <div class="d-flex justify-content-between align-items-center mb-5 flex-nowrap">
                    <h4 class="fw-bold mb-0 ">Check Room Availability</h4>
                    <a href="{{ route('web.room-bookings.confirm') }}" class="sigma_btn-custom px-2 ">
                        <i class="fal fa-shopping-bag"></i> Go To Cart
                        (<span
                            id="cart-count">{{ session('selected_rooms') ? count(session('selected_rooms')) : 0 }}</span>) </a>
                </div>


                <!-- Date Filter (Search Box Style) -->
                <form method="GET" id="dateForm">
                    <div class="row g-3 align-items-end sidebar-widget widget-search  mb-4">
                        <div class="col-md-5">
                            <label class="form-label">Booking From</label>
                            <input type="date" name="booking_from" class="form-control dark"
                                value="{{ request('booking_from', session('booking_from')) }}"
                                min="{{ now()->toDateString() }}" onchange="document.getElementById('dateForm').submit();"
                                required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Booking To</label>
                            <input type="date" name="booking_to" class="form-control dark"
                                value="{{ request('booking_to', session('booking_to')) }}"
                                min="{{ request('booking_from', session('booking_from', now()->toDateString())) }}"
                                onchange="document.getElementById('dateForm').submit();" required>
                        </div>
                        <div class="col-md-2 d-grid">

                            <button type="submit" class="sigma_btn-custom">Submit Now</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="row mt-4">
                {{-- Room Cards --}}
                <div class="col-md-12">
                    <div class="row">
                        @forelse ($rooms as $room)
                            <div class="col-md-4 col-lg-3 col-sm-6 mb-4">
                                <div class="card border-1 shadow-sm rounded-3 h-100">
                                    <img src="{{ asset($room->image) }}" class="card-img-top rounded-top"
                                        alt="{{ $room->name }}" style="height: 200px; object-fit: cover;">

                                    <div class="card-body">
                                        <h5 class="sigma_product-title mb-2 fw-bold ">{{ $room->name }}</h5>

                                        <p class="mb-2">
                                            <strong class="">Type: <span
                                                    class="text-muted">{{ $room->room_type }}</span></strong>
                                            <strong class="mx-2">Beds: <span
                                                    class="text-muted">{{ $room->no_of_beds }}</span></strong>
                                            <strong class="">Room size : <span class="text-muted">LxB
                                                    13/12</span></strong>


                                        </p>
                                        <p class="mb-3">
                                            <strong class="me-3 fs-4 text-muted fw-bold">
                                                Price:
                                                <span class="text-success">₹{{ number_format($room->donation, 2) }}</span>
                                            </strong>
                                        </p>

                                        <button
                                            class="btn w-100 btn-sm btn-toggle-cart {{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'sigma_btn-custom secondary' : 'sigma_btn-custom' }}"
                                            data-room-id="{{ $room->id }}"
                                            data-action="{{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'remove' : 'add' }}">
                                            <i
                                                class="{{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'fas fa-times-circle me-1' : 'fas fa-cart-plus me-1' }}"></i>
                                            {{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'Remove  Cart' : 'Add to Cart ' }}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">No rooms available for selected dates.</div>
                            </div>
                        @endforelse
                    </div>


                </div>


                {{-- Booking Summary --}}
                {{-- <div class="col-md-4 order-1 order-md-2 mt-4 mt-md-0">

                <div class=" d-none d-md-block">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Booking Summary</h5>
                            @php
                                $selectedIds = session('selected_rooms', []);
                                $selectedRooms = \App\Models\Room::whereIn('id', $selectedIds)->get();
                                $totalAmount = $selectedRooms->sum('donation');
                            @endphp

                            @forelse ($selectedRooms as $r)
                                <div class="d-flex justify-content-between">
                                    <span>{{ $r->name }}</span>
                                    <span>₹{{ $r->donation }}</span>
                                </div>
                            @empty
                                <p class="text-muted">No rooms selected</p>
                            @endforelse

                            @if ($selectedRooms->count())
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>₹{{ $totalAmount }}</span>
                                </div>

                                <div class="mt-3 text-end">
                                    <a href="{{ route('room-bookings.create') }}" class="btn btn-success w-100">
                                        Continue to Booking
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-block d-md-none mt-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Booking Summary</h5>

                            @foreach ($selectedRooms as $r)
                                <div class="d-flex justify-content-between">
                                    <span>{{ $r->name }}</span>
                                    <span>₹{{ $r->donation }}</span>
                                </div>
                            @endforeach

                            @if ($selectedRooms->count())
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>₹{{ $totalAmount }}</span>
                                </div>

                                <div class="mt-3 text-end">
                                    <a href="{{ route('room-bookings.create') }}" class="btn btn-success w-100">
                                        Continue to Booking
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-toggle-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const btn = this;
                    const roomId = btn.getAttribute('data-room-id');
                    const action = btn.getAttribute('data-action');

                    const route = action === 'add' ?
                        '{{ route('room-bookings.add-to-session') }}' :
                        '{{ route('room-bookings.remove-from-session') }}';

                    // Show processing text/icon
                    const originalHTML = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Processing...';

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
                            if (data.status === 'added') {
                                btn.classList.remove('sigma_btn-custom');
                                btn.classList.add('sigma_btn-custom', 'secondary');
                                btn.innerHTML =
                                    '<i class="fas fa-times-circle me-1"></i> Remove from Cart';
                                btn.setAttribute('data-action', 'remove');


                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added!',
                                    text: 'Room added to cart.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });


                            } else if (data.status === 'removed') {
                                btn.classList.remove('secondary');
                                btn.classList.add('sigma_btn-custom');
                                btn.innerHTML =
                                    '<i class="fas fa-cart-plus me-1"></i> Add to Cart';
                                btn.setAttribute('data-action', 'add');
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
                            const cartCountElement = document.getElementById('cart-count');
                            let currentCount = parseInt(cartCountElement.innerText) || 0;

                            if (data.status === 'added') {
                                cartCountElement.innerText = currentCount + 1;
                            } else if (data.status === 'removed' && currentCount > 0) {
                                cartCountElement.innerText = currentCount - 1;
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
