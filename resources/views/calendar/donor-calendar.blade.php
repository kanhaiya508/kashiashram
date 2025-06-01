<x-app-layout>
    <div class="container py-4">

        <!-- Summary Section -->
        <div class="row mb-4 g-2 text-center">
            <div class="col-md-6 col-6">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="text-success mb-2">
                            <i class="fas fa-users me-2"></i> Total Donors
                        </h5>
                        <h3 class="text-dark">{{ $donors->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="card border-info shadow-sm">
                    <div class="card-body">
                        <h5 class="text-info mb-2">
                            <i class="fas fa-rupee-sign me-2"></i> Total Donations
                        </h5>
                        <h3 class="text-dark">{{ $donors->sum('donation_amount') }} ₹</h3>
                    </div>
                </div>
            </div>


        </div>

        <!-- Filter Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('donor-calendar') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                        <div class="col-md-4">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Donor Calendar Table -->
        @if ($donors->count())
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-start"
                                style="position: sticky; left: 0; z-index: 11; background-color: #343a40; color: #fff;">
                                Donor Name</th>
                            @foreach ($dateRange as $date)
                                <th style=" background-color: #5a5e61; color: #fff;" >{{ \Carbon\Carbon::parse($date)->format('d M') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donors as $donor)
                            <tr>
                                 <td class="fw-bold bg-light text-start" style="position: sticky; left: 0; z-index: 10;">{{ $donor->donor_name }}</td>
                                @foreach ($dateRange as $date)
                                    @php
                                        $matched = $donor->donation_date == $date;
                                    @endphp
                                    <td class="{{ $matched ? 'bg-danger text-white' : 'bg-success text-white' }}"
                                        @if ($matched) data-bs-toggle="modal"
                                            data-bs-target="#donorModal{{ $donor->id }}"
                                            style="cursor: pointer;" @endif>
                                        {{ $matched ? '₹' . $donor->donation_amount : '---' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Donor Detail Modals -->
            @foreach ($donors as $donor)
                <div class="modal fade" id="donorModal{{ $donor->id }}" tabindex="-1"
                    aria-labelledby="donorModalLabel{{ $donor->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title text-white " id="donorModalLabel{{ $donor->id }}">Donor Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-4 fw-semibold text-secondary">Name:</div>
                                        <div class="col-8">{{ $donor->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 fw-semibold text-secondary">Email:</div>
                                        <div class="col-8">{{ $donor->email }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 fw-semibold text-secondary">Phone:</div>
                                        <div class="col-8">{{ $donor->contact_number }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 fw-semibold text-secondary">Amount:</div>
                                        <div class="col-8">₹{{ number_format($donor->donation_amount, 2) }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 fw-semibold text-secondary">Date:</div>
                                        <div class="col-8">
                                            {{ \Carbon\Carbon::parse($donor->donation_date)->format('d M Y') }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4 fw-semibold text-secondary">Address:</div>
                                        <div class="col-8">{{ $donor->contact_details }}</div>
                                    </div>
                                    @if (!empty($donor->note))
                                        <div class="row">
                                            <div class="col-4 fw-semibold text-secondary">Note:</div>
                                            <div class="col-8 fst-italic text-muted">{{ $donor->note }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">No donors found between selected dates.</div>
        @endif
    </div>


</x-app-layout>
