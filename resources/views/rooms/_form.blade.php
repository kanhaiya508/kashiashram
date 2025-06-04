<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Ashram</label>
        <select name="ashram_id" class="form-control" required>
            <option value="">-- Select Ashram --</option>
            @foreach ($ashrams as $id => $name)
                <option value="{{ $id }}"
                    {{ old('ashram_id', $room->ashram_id ?? '') == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        @error('ashram_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Room Name</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $room->name ?? '') }}">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Donation (₹)</label>
        <input type="number" name="donation" class="form-control" required
            value="{{ old('donation', $room->donation ?? '') }}">
        @error('donation')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">No Of Beds</label>
        <input type="number" name="no_of_beds" class="form-control" required
            value="{{ old('no_of_beds', $room->no_of_beds ?? '') }}">
        @error('no_of_beds')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-md-6 mb-3">
        <label class="form-label">Room Capacity</label>
        <input type="number" name="room_capacity" class="form-control" required
            value="{{ old('room_capacity', $room->room_capacity ?? '') }}">
        @error('room_capacity')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

  

    <div class="col-md-6 mb-3">
        <label class="form-label">Room Type</label>
        <select name="room_type" class="form-control" required>
            <option value="AC" {{ old('room_type', $room->room_type ?? '') == 'AC' ? 'selected' : '' }}>AC</option>
            <option value="Non-AC" {{ old('room_type', $room->room_type ?? '') == 'Non-AC' ? 'selected' : '' }}>Non-AC
            </option>
        </select>
        @error('room_type')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Active</label>
        <select name="active" class="form-control">
            <option value="1" {{ old('active', $room->active ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('active', $room->active ?? 1) == 0 ? 'selected' : '' }}>No</option>
        </select>
        @error('active')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Upload Image (1920x517)</label>
        <input type="file" name="image" class="form-control">
        @if (!empty($room->image))
            <a href="{{ asset($room->image) }}" target="_blank" class="d-block mt-2">View Existing</a>
        @endif
        @error('image')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
