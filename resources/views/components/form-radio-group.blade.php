<div class="form-group">
    <label>{{ $label }}</label>
    @foreach ($options as $value => $label)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name . '_' . $value }}"
                value="{{ $value }}" {{ $selected == $value ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $name . '_' . $value }}">{{ $label }}</label>
        </div>
    @endforeach
</div>
