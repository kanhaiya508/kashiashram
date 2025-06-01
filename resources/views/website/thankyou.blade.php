@extends('website.layout')
@section('content')
    <div class="sigma_subheader dark-overlay dark-overlay-1"
        style="background-image: url({{ asset('website/assets/img/subheader.jpg') }})">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Thank You</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Confirm Booking </li>
                        <li class="breadcrumb-item active" aria-current="page">Thank You </li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <div class="section section-padding">
        <div class="text-center section-title mb-5">
            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
            <h4 class="title">Thank You for Your Booking!</h4>
            <p class="subtitle">Your booking has been successfully.</p>
            <p class="text-muted">We truly appreciate your trust and look forward to serving you during your stay.</p>
             <a href="{{ route('index') }}" class="sigma_btn-custom mt-3">
                            <i class="fas fa-home me-1"></i> Go to Home
                        </a>
        </div>


    </div>
@endsection
