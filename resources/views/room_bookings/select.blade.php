<x-app-layout>
    <div class="container-xxl py-4">
        <h4 class="fw-bold">Select Room to Book</h4>

        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div
                        class="card h-100 {{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'border-success' : '' }}">
                        @if ($room->image)
                            <img src="{{ asset($room->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $room->room_type }}</p>
                            <p class="card-text mb-1"><strong>Beds:</strong> {{ $room->no_of_beds }}</p>
                            <p class="card-text mb-1"><strong>Donation:</strong> ₹{{ $room->donation }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <form action="{{ route('room-bookings.addToSession') }}" method="POST">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <button class="btn btn-sm btn-outline-primary" type="submit">
                                    {{ session('selected_rooms') && in_array($room->id, session('selected_rooms')) ? 'Added' : 'Add' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (session('selected_rooms') && count(session('selected_rooms')) > 0)
            <div class="text-end mt-4">
                <a href="{{ route('room-bookings.create') }}" class="btn btn-success">Continue to Booking</a>
            </div>
        @endif
    </div>
</x-app-layout>
