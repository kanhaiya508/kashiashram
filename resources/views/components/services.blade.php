<div class="row mb-2">
    <!-- Name Field Component (Text) -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-form-input label="Name" name="name" type="text" value="{{ $data->name ?? old('name') }}"
            placeholder="Enter name" />
    </div>
    <!-- Status Field Component (Dropdown) -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <x-status-select name="status" label="Status" :selected="$data->status ?? old('status')" />
    </div>
</div>
