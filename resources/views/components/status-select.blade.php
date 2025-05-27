<!-- resources/views/components/status-select.blade.php -->

@props([
'label' => 'Status', // Label for the select
'name' => 'status', // Select name attribute
'selected' => null, // Selected option
])

<div class="form-group">
    <label>{{ $label }}:</label>
    <select name="{{ $name }}" class="form-control">
        <option value="1" disabled>Select Status</option>
        <option value="1" {{ $selected==1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $selected==0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>