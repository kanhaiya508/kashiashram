<x-app-layout>
    <div class="container py-4">
        <h4 class="mb-4">Dashboard Overview</h4>

        <div class="row g-3">
            <div class="col-md-3 col-sm-6">
                <div class="card bg-light border shadow-sm small">
                    <div class="card-body text-center p-3">
                        <h6 class="text-muted mb-1">Total Bookings</h6>
                        <h5 class="mb-0 fw-bold">{{ $bookings }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card bg-light border shadow-sm small">
                    <div class="card-body text-center p-3">
                        <h6 class="text-muted mb-1">Total Ashrams</h6>
                        <h5 class="mb-0 fw-bold">{{ $ashrams }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card bg-light border shadow-sm small">
                    <div class="card-body text-center p-3">
                        <h6 class="text-muted mb-1">Total Rooms</h6>
                        <h5 class="mb-0 fw-bold">{{ $rooms }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card bg-light border shadow-sm small">
                    <div class="card-body text-center p-3">
                        <h6 class="text-muted mb-1">Total Users</h6>
                        <h5 class="mb-0 fw-bold">{{ $users }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
