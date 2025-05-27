<div>
    <label for="{{ $name }}">{{ $label }}</label><br>
    <select id="{{ $name }}" name="{{ $name }}"
        class="form-control select2  {{ $errors->has($name) ? 'is-invalid' : '' }}" style="width: 100%;">
        <option value="">-- Select {{ $label }} --</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}" {{ $option->id == $selected ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
