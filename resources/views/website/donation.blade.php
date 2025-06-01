@extends('website.layout')
@section('content')
    <div class="sigma_subheader dark-overlay dark-overlay-1"
        style="background-image: url({{ asset('website/assets/img/subheader.jpg') }})">

        <div class="container">
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Donation</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn-link" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Donation </li>

                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <div class="section ">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form class="sigma_box box-lg m-0 mf_form_validate ajax_submit" action="{{ route('donor.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <i class="far fa-user"></i>
                            <input type="text" placeholder="Full Name" class="form-control dark" name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <i class="far fa-user"></i>
                            <input type="text" placeholder="Gothra" class="form-control dark" name="gothra">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <i class="far fa-user"></i>
                            <input type="text" placeholder="Donor Name" class="form-control dark" name="donor_name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <i class="far fa-gift"></i>
                            <input type="text" placeholder="Occasion" class="form-control dark" name="occasion">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <i class="far fa-money-bill-alt"></i>
                            <input type="number" placeholder="Donation Amount" class="form-control dark"
                                name="donation_amount" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">

                            <input type="date" placeholder="Donation Date" class="form-control dark" name="donation_date"
                                min="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group">
                            <i class="far fa-phone"></i>
                            <input type="text" placeholder="Contact Number" class="form-control dark"
                                name="contact_number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <i class="far fa-envelope"></i>
                            <input type="email" placeholder="Email Address" class="form-control dark" name="email">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">

                            <textarea name="contact_details" placeholder="Full Addres" cols="45" rows="5" class="form-control dark"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <textarea name="note" placeholder="Additional Note" cols="45" rows="5" class="form-control dark"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="sigma_btn-custom">Donate Now</button>
                    <div class="server_response w-100"></div>
                </div>
            </form>


        </div>
    </div>
@endsection
