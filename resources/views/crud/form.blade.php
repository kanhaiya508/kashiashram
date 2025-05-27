<div class="row mb-3">
    <!-- Quotation Number Field -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="Quotation Number " name="quotation_number" type="text"
            value="{{ $data->quotation_number ?? old('quotation_number') }}" placeholder="Enter Quotation Number" />
    </div>
    <!-- Date Field -->
    <div class="col-md-6">
        <div class="form-group">
            <x-form-input label="QT.Date" name="date" type="date" value="{{ $data->date ?? old('date') }}" />
        </div>
    </div>
    <!-- survey Dropdown -->
    <div class="col-md-6">
        <div class="form-group">
            <x-survey-dropdown name="survey_id" label="Select Survey" :selected="$data->survey_id ?? null" />

        </div>
    </div>



    <!-- Moving Type -->
    <div class="col-md-6">
        <div class="form-group">
            <x-select-box name="moving_type" label="Select Moving Type" :options="[
                'local' => 'Local',
                'domestic' => 'Domestic',
                'international' => 'International',
                'household_goods' => 'Household Goods',
                'office_shifting' => 'Office Shifting',
                'vehicle_shifting' => 'Vehicle Shifting',
                'industrial_goods_shifting' => 'Industrial Goods Shifting',
            ]" :selected="$data->moving_type ?? null" />
        </div>
    </div>

    <!-- packing  Field -->
    <div class="col-md-6">
        <div class="form-group">
            <x-form-input label="Packing Date" name="packing_date" type="date"
                value="{{ $data->packing_date ?? old('packing_date') }}" />
        </div>
    </div>

    <!-- Delivery  Date Field -->
    <div class="col-md-6">
        <div class="form-group">
            <x-form-input label="Delivery Date" name="delivery_date" type="date"
                value="{{ $data->delivery_date ?? old('delivery_date') }}" />
        </div>
    </div>
</div>



<div class="row mb-3">
    <!-- Status Dropdown -->
    <div class="col-md-6">
        <div class="form-group">
            <x-select-box name="status" label="Select Status" :options="[
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ]" :selected="$data->status ?? null" />
        </div>
    </div>
</div>
