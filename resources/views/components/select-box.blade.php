<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}"
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" style="width: 100%;">
        <option value="" disabled selected>-- Select an option --</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
        @if ($errors->has($name))
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        @endif
    </select>
</div>
