<!-- resources/views/components/financial-years.blade.php -->

<div class="row mb-2">
    <!-- Name Field Component (Text) -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <x-form-input label="Name" name="name" type="text" value="{{ $data->name ?? old('name') }}"
            placeholder="Enter name" />
    </div>

    <!-- Start Date Field Component (Date) -->
    <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
        <x-form-input label="Start Date" name="start_date" type="date"
            value="{{ $data->start_date ?? old('start_date') }}" />
    </div>

    <!-- End Date Field Component (Date) -->
    <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
        <x-form-input label="End Date" name="end_date" type="date"
            value="{{ $data->end_date ?? old('end_date') }}" />
    </div>

    <!-- Status Field Component (Dropdown) -->
    <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
        <x-status-select name="status" label="Status" :selected="$data->status ?? old('status')" />
    </div>
</div>
