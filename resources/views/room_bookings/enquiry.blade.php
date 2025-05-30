<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Room Bookings Enquiry
        </h4>

        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-wrap justify-content-between align-items-center">


                    <form method="GET" action="{{ route('room-bookings.index') }}" class="row gy-2 gx-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label mb-0 small">Customer Name</label>
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search by name">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label mb-0 small">Phone</label>
                            <input type="text" name="phone" value="{{ request('phone') }}" class="form-control"
                                placeholder="Phone">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label mb-0 small">From Date</label>
                            <input type="date" name="from_date" value="{{ request('from_date') }}"
                                class="form-control">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label mb-0 small">To Date</label>
                            <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Booking Dates</th>
                                <th>Rooms</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->booking_from)->format('d-m-Y') }}
                                        →
                                        {{ \Carbon\Carbon::parse($booking->booking_to)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($booking->rooms as $r)
                                                <li>{{ $r->room->name ?? '-' }} — ₹{{ $r->amount }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        ₹ {{ $booking->rooms->sum('amount') }}
                                    </td>
                                    <td>
                                        @php
                                            $status = $booking->status;
                                            $badgeClass = match ($status) {
                                                'booked' => 'bg-info text-dark',
                                                'completed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                'applied' => 'bg-warning text-dark',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- Mark as Applied --}}
                                                <button class="dropdown-item status-change"
                                                    data-url="{{ route('room-bookings.status.update', ['id' => $booking->id, 'status' => 'applied']) }}"
                                                    data-action="Mark this booking as applied?">
                                                    <i class="fas fa-hourglass-start me-1 text-warning"></i> Mark as
                                                    Applied
                                                </button>
                                                {{-- Cancel --}}
                                                <button class="dropdown-item status-change"
                                                    data-url="{{ route('room-bookings.status.update', ['id' => $booking->id, 'status' => 'cancelled']) }}"
                                                    data-action="Cancel this booking?">
                                                    <i class="fas fa-times-circle me-1 text-danger"></i> Cancel
                                                </button>

                                                {{-- Mark as Booked --}}
                                                <button class="dropdown-item status-change"
                                                    data-url="{{ route('room-bookings.status.update', ['id' => $booking->id, 'status' => 'booked']) }}"
                                                    data-action="Mark this booking as booked?">
                                                    <i class="fas fa-book me-1 text-primary"></i> Mark as Booked
                                                </button>

                                                {{-- Mark as Complete --}}
                                                <button class="dropdown-item status-change"
                                                    data-url="{{ route('room-bookings.status.update', ['id' => $booking->id, 'status' => 'completed']) }}"
                                                    data-action="Mark this booking as completed?">
                                                    <i class="fas fa-check-circle me-1 text-success"></i> Complete
                                                </button>

                                                {{-- Invoice --}}
                                                <a href="{{ route('room-bookings.invoice', $booking->id) }}"
                                                    class="dropdown-item">
                                                    <i class="fas fa-file-pdf me-1 text-secondary"></i> Invoice
                                                </a>

                                            </div>
                                        </div>
                                    </td>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="d-flex justify-content-between mt-3">
                        <div class="text-muted small">
                            Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of
                            {{ $bookings->total() }} entries
                        </div>
                        <div>{{ $bookings->links() }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.status-change').forEach(button => {
                    button.addEventListener('click', function() {
                        const url = this.getAttribute('data-url');
                        const action = this.getAttribute('data-action');

                        Swal.fire({
                            title: 'Are you sure?',
                            text: action,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, proceed',
                            cancelButtonText: 'No',
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                        }).then(result => {
                            if (result.isConfirmed) {
                                window.location.href = url;
                            }
                        });
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
