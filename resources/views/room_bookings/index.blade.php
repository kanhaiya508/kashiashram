<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="d-flex  flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <h4 class="fw-bold mb-2 mb-md-0">
                <span class="text-muted fw-light">Dashboard /</span> Room Bookings
            </h4>

            <button type="button" class="btn btn-outline-dark d-md-inline-block d-block" id="toggleFilter">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>




        <div class="card">
            <div class="card-header">

                <div id="filterForm" class="d-none w-100">


                    <div class="d-flex flex-wrap justify-content-between align-items-center">


                        <form method="GET" action="{{ route('room-bookings.index') }}"
                            class="row gy-2 gx-2 align-items-end">
                            <div class="col-md-2  col-6">
                                <label class="form-label mb-0 small">Customer Name</label>
                                <input type="search" name="search" value="{{ request('search') }}"
                                    class="form-control" placeholder="Search Here...">
                            </div>

                            <div class="col-md-2  col-6">
                                <label class="form-label mb-0 small">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All</option>
                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                            </div>

                            <div class="col-md-2  col-6 ">
                                <label for="user_type">User Type</label>
                                <select name="user_type" id="user_type" class="form-control">
                                    <option value="">-- Select User Type --</option>
                                    <option value="Donar" {{ request('user_type') == 'Donar' ? 'selected' : '' }}>
                                        Donar
                                    </option>
                                    <option value="New Yatri"
                                        {{ request('user_type') == 'New Yatri' ? 'selected' : '' }}>
                                        New Yatri</option>
                                    <option value="Regular Yatri"
                                        {{ request('user_type') == 'Regular Yatri' ? 'selected' : '' }}>Regular Yatri
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2  col-6 ">
                                <label for="travel_type">Travel Type</label>
                                <select name="travel_type" id="travel_type" class="form-control">
                                    <option value="">-- Select Travel Type --</option>
                                    <option value="Bus" {{ request('travel_type') == 'Bus' ? 'selected' : '' }}>Bus
                                    </option>
                                    <option value="Train" {{ request('travel_type') == 'Train' ? 'selected' : '' }}>
                                        Train
                                    </option>
                                    <option value="Flight" {{ request('travel_type') == 'Flight' ? 'selected' : '' }}>
                                        Flight</option>
                                </select>
                            </div>



                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <label class="form-label small">From Date</label>

                                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                                            class="form-control " placeholder="From">

                                    </div>

                                    <div class="col-md-6 col-6">
                                        <label class="form-label small">To Date</label>
                                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                                            class="form-control" placeholder="To">
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-12 col-12">
                                <div
                                    class="d-flex  flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">

                                    <button type="submit" name="action" value="filter" class="btn btn-primary">
                                        Filter
                                    </button>

                                    <a href="{{ route('room-bookings.index') }}" class="btn btn-dark">
                                        Clear
                                    </a>

                                    <button type="submit" name="action" value="download_excel" class="btn btn-info">
                                        <i class="fas fa-file-excel me-1"></i> Download Excel
                                    </button>


                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($bookings as $booking)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card shadow border-0 h-100">
                                <div
                                    class="card-header  bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                                    <span>{{ $booking->name }}</span>
                                    <span
                                        class="badge bg-white text-primary text-uppercase small">{{ $booking->user_type }}</span>
                                </div>

                                <div class="card-body d-flex flex-column">

                                    {{-- 📅 Booking Dates --}}
                                    <div class="my-3 p-2   rounded border bg-light">
                                        <strong>Booking:</strong><br>
                                        <span class="text-dark">
                                            {{ \Carbon\Carbon::parse($booking->booking_from)->format('d M Y, h:i A') }}
                                            →
                                            {{ \Carbon\Carbon::parse($booking->booking_to)->format('d M Y, h:i A') }}
                                        </span><br>
                                        <small class="text-muted">Days: {{ $booking->getDurationInDays() }}</small>
                                    </div>

                                    {{-- 🛏️ Room Details --}}
                                    <div class="mb-3 p-2 rounded border bg-white">
                                        <strong>Rooms:</strong>
                                        <ul class="ps-3 mb-1">
                                            @foreach ($booking->rooms as $r)
                                                <li>
                                                    <span class="fw-semibold">{{ $r->room->name ?? '-' }}</span> —
                                                    ₹{{ $r->amount }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <strong>Total:
                                            ₹{{ $booking->rooms->sum('amount') * ($booking->getDurationInDays() ?? 0) }}</strong>
                                    </div>

                                    {{-- ☎️ Contact & Invoice --}}
                                    <div class="mb-3 p-2 rounded border bg-white">
                                        <strong>Phone:</strong> {{ $booking->phone }}
                                        @php
                                            $phone = preg_replace('/\D/', '', $booking->phone);
                                            $invoiceLink = route('invoice', $booking->id);
                                            $message = "Namaste 🙏,\n\nHere is your booking invoice from SKG Ashram:\n$invoiceLink\n\nThank you! Hari Om 🙏";
                                            $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);
                                        @endphp
                                        <a href="{{ $whatsappUrl }}" target="_blank"
                                            class="btn btn-sm btn-success mt-2 w-100">
                                            <i class="fab fa-whatsapp me-1"></i> Send Invoice
                                        </a>
                                    </div>

                                    {{-- 🔖 Status and Payment --}}
                                    <div class="mb-3 p-2 rounded border bg-white">
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

                                        <p class="mb-1">
                                            <strong>Status:</strong>
                                            <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                        </p>

                                        <p class="mb-0">
                                            <strong>Payment:</strong>
                                            @if ($booking->payment_status === 'advance_paid')
                                                <span class="text-warning fw-bold">Advance Paid</span>
                                            @elseif ($booking->payment_status === 'fully_paid')
                                                <span class="text-success fw-bold">Fully Paid</span>
                                            @else
                                                <span class="text-danger fw-bold">Unpaid</span>
                                            @endif
                                        </p>
                                    </div>

                                    {{-- ⚙️ Actions --}}
                                    <div class="mt-auto">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary w-100 dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu w-100">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('room-bookings.edit', $booking->id) }}">
                                                        <i class="fas fa-edit me-1"></i> Edit</a></li>

                                                <li><a class="dropdown-item"
                                                        href="{{ route('invoice', $booking->id) }}">
                                                        <i class="fas fa-file-pdf me-1 text-secondary"></i> Invoice</a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                {{-- Status updates --}}
                                                @foreach (['applied', 'booked', 'cancelled', 'completed'] as $status)
                                                    <li>
                                                        <button class="dropdown-item status-change"
                                                            data-url="{{ route('room-bookings.status.update', ['id' => $booking->id, 'status' => $status]) }}"
                                                            data-action="Mark this booking as {{ $status }}?">
                                                            <i class="fas fa-circle me-1 text-muted"></i> Mark as
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    </li>
                                                @endforeach

                                                {{-- Delete --}}
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('room-bookings.destroy', $booking->id) }}"
                                                        class="delete-form m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item delete-button">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">No bookings found.</div>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $bookings->links() }}
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById('toggleFilter');
            const filterForm = document.getElementById('filterForm');

            toggleBtn.addEventListener('click', function() {
                filterForm.classList.toggle('d-none');
            });

            // Auto-open if any filter is applied
            const urlParams = new URLSearchParams(window.location.search);
            if (
                urlParams.has('search') ||
                urlParams.has('status') ||
                urlParams.has('user_type') ||
                urlParams.has('travel_type') ||
                urlParams.has('from_date') ||
                urlParams.has('to_date')
            ) {
                filterForm.classList.remove('d-none');
            }
        });
    </script>

</x-app-layout>
