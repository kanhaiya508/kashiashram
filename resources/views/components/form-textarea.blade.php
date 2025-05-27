<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea 
        id="{{ $name }}" 
        name="{{ $name }}" 
        class="form-control" 
        placeholder="{{ $placeholder }}" 
        rows="4">{{ $value }}</textarea>
</div>
