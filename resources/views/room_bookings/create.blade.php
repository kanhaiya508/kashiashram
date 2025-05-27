<x-app-layout>
    <div class="container-xxl py-4">
        <h4 class="fw-bold">Book a Room</h4>

        <form method="POST" action="{{ route('room-bookings.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Select Room</label>
                <select name="room_id" class="form-control" required>
                    <option value="">-- Select Room --</option>
                    @foreach ($rooms as $id => $name)
                        <option value="{{ $id }}" {{ old('room_id') == $id ? 'selected' : '' }}>
                            {{ $name }}</option>
                    @endforeach
                </select>
                @error('room_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Booking From</label>
                <input type="date" name="booking_from" class="form-control" value="{{ old('booking_from') }}"
                    required>
                @error('booking_from')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Booking To</label>
                <input type="date" name="booking_to" class="form-control" value="{{ old('booking_to') }}" required>
                @error('booking_to')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Book Room</button>
        </form>
    </div>
</x-app-layout>
