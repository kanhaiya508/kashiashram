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
                        <li class="breadcrumb-item active" aria-current="page">Booking Enquiry</li>
                        <li class="breadcrumb-item active" aria-current="page">Thank You</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="section section-padding">
        <div class="text-center section-title mb-5">
            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
            <h4 class="title">Thank You for Your Enquiry!</h4>
            <p class="subtitle">Your booking enquiry has been successfully submitted.</p>
            <p class="text-muted">Our team will review your request and get in touch with you shortly to confirm availability and details.</p>

            <div class="alert alert-info mt-4 mx-auto" style="max-width: 700px;">
                <strong>Note:</strong> Our booking team will contact you soon.<br>
                Please note that in case of any cancellations, the paid amount will <strong>not</strong> be refunded.<br>
                The amount will be utilised for <strong>Annaprasadham Viniyogam</strong>.<br>
                <span class="d-block mt-2">Hari Om 🙏</span>
            </div>

            <a href="{{ route('index') }}" class="sigma_btn-custom mt-4">
                <i class="fas fa-home me-1"></i> Go to Home
            </a>
        </div>
    </div>
@endsection



