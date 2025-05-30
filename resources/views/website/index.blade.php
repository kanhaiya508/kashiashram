@extends('website.layout')
@section('content')
    <div class="container-xxl py-4">
        <div class="">
            <!-- Top Line: Heading + Cart -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h4 class="fw-bold mb-0">Available Rooms</h4>
                <a href="{{ route('web.room-bookings.confirm') }}" class="btn btn-dark">
                    <i class="fas fa-shopping-cart me-1"></i> Go To Cart
                </a>
            </div>

            <!-- Date Filter (Search Box Style) -->
            <form method="GET" id="dateForm">
                <div class="row g-3 align-items-end bg-light p-3 rounded shadow-sm mb-4">
                    <div class="col-md-5">
                        <label class="form-label">Booking From</label>
                        <input type="date" name="booking_from" class="form-control"
                            value="{{ request('booking_from', session('booking_from')) }}" min="{{ now()->toDateString() }}"
                            onchange="document.getElementById('dateForm').submit();" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Booking To</label>
                        <input type="date" name="booking_to" class="form-control"
                            value="{{ request('booking_to', session('booking_to')) }}"
                            min="{{ request('booking_from', session('booking_from', now()->toDateString())) }}"
                            onchange="document.getElementById('dateForm').submit();" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <label class="form-label invisible">Search</label>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="row mt-4">
            {{-- Room Cards --}}
            <div class="col-md-12">
                <div class="row">
                    @forelse ($rooms as $room)
                        <div class="col-md-3 col-6  mb-4">
                            <div class="card h-100 text-white shadow-sm border-0"
                                style="position: relative; overflow: hidden;">
                                <div class="bg-image"
                                    style="
        background-image: url('{{ asset($room->image) }}');
        background-size: cover;
        background-position: center;
        height: 220px;
        position: relative;">

                                    <div
                                        style="
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px;">
                                        <h5 class="card-title mb-1 text-white">{{ $room->name }}</h5>
                                        <p class="mb-0"><strong>Type:</strong> {{ $room->room_type }}</p>
                                        <p class="mb-0"><strong>Beds:</strong> {{ $room->no_of_beds }}</p>
                                        <p class="mb-0"><strong>Donation:</strong> ₹{{ $room->donation }}</p>
                                    </div>
                                </div>

                                <div class="p-3 bg-white text-dark">
                                    <div class="p-3 bg-white text-dark text-center">
                                        <button
                                            class="btn w-100 mt-2 btn-toggle-cart {{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'btn-danger' : 'btn-outline-primary' }}"
                                            data-room-id="{{ $room->id }}"
                                            data-action="{{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'remove' : 'add' }}">
                                            <i
                                                class="{{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'fas fa-times-circle me-1' : 'fas fa-cart-plus me-1' }}"></i>
                                            {{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'Remove from Cart' : 'Add to Cart' }}
                                        </button>

                                    </div>

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
                                btn.classList.remove('btn-outline-primary');
                                btn.classList.add('btn-danger');
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
                                btn.classList.remove('btn-danger');
                                btn.classList.add('btn-outline-primary');
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
