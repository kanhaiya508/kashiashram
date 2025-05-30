@extends('website.layout')
@section('content')
    <div class="container-xxl py-5">
        <div class="text-center mb-5">
            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
            <h2 class="fw-bold text-success">Thank You for Your Booking!</h2>
            <p class="lead">Your booking has been successfully confirmed.</p>
            <p class="text-muted">We truly appreciate your trust and look forward to serving you during your stay.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">What’s Next?</h5>
                        <p class="card-text">You will receive a confirmation email shortly with your booking details. If you have any questions or need assistance, feel free to contact us anytime.</p>
                        <a href="{{ route('index') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-home me-1"></i> Go to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
