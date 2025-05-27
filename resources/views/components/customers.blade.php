<div class="row mb-2">
    <!-- Name Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="Name" name="name" type="text" value="{{ $data->name ?? old('name') }}"
            placeholder="Enter name" />
    </div>

    <!-- Company Name Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="Company Name" name="company_name" type="text"
            value="{{ $data->company_name ?? old('company_name') }}" placeholder="Enter company name" />
    </div>
</div>

<div class="row mb-2">
    <!-- Email Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="Email" name="email" type="email" value="{{ $data->email ?? old('email') }}"
            placeholder="Enter email address" />
    </div>

    <!-- Phone Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="Phone" name="phone" type="text" value="{{ $data->phone ?? old('phone') }}"
            placeholder="Enter phone number" />
    </div>
</div>

<div class="row mb-2">
    <!-- GST Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="GST" name="gst" type="text" value="{{ $data->gst ?? old('gst') }}"
            placeholder="Enter GST number" />
    </div>

    <!-- Address Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-textarea label="Address" name="address" placeholder="Enter address">{{ $data->address ?? old('address')
            }}</x-form-textarea>
    </div>
</div>

<div class="row mb-2">
    <!-- Status Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-status-select name="status" label="Status" :selected="$data->status ?? old('status')" />
    </div>
</div>