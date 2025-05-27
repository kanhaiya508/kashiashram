<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label><br>
    <select id="{{ $name }}" name="{{ $name }}"
        class="form-control select2 {{ $errors->has($name) ? 'is-invalid' : '' }}" style="width: 100%;">
        <option value="" disabled selected>-- Select Quotation --</option>
        @foreach ($quotation as $id => $quotationNo)
            <option value="{{ $id }}" {{ $selected == $id ? 'selected' : '' }}>
                {{ $quotationNo }}
            </option>
        @endforeach
    </select>
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
