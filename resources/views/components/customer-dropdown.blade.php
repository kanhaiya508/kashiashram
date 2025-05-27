<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label><br>
    <select id="{{ $name }}" name="{{ $name }}" class="form-control select2" style="width: 100%;">
        <option disabled value="">-- Select Customer --</option>
        @foreach ($customers as $customer)
        <option value="{{ $customer->id }}" {{ $selected==$customer->id ? 'selected' : '' }}>
            {{ $customer->name }} - {{ $customer->email }}
        </option>
        @endforeach
    </select>
</div>