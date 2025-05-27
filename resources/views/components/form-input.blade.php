<!-- resources/views/components/form-input.blade.php -->

@props([
    'label' => '', // Label text
    'name' => '', // Name attribute for the input
    'value' => '', // Value of the input
    'id' => '', // id of the input
    'type' => 'text', // Input type, default is 'text' but can be 'date' or others
    'placeholder' => '', // Placeholder text
])
<div class="form-group my-2 ">
    <label>{{ $label }}:</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}">
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
