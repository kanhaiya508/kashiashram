<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Rooms
        </h4>

        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div class="mb-2">
                        @can('room-create')
                            <a href="{{ route('rooms.create') }}" class="btn btn-primary me-2">Add Room</a>
                        @endcan
                    </div>

                    <form method="GET" action="{{ route('rooms.index') }}" class="d-flex" role="search">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control me-2"
                            placeholder="Search by name...">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($rooms as $room)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if (!empty($room->image))
                                    <img src="{{ asset($room->image) }}" class="card-img-top" alt="Room Image"
                                        style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex justify-content-center align-items-center"
                                        style="height: 180px;">
                                        <span class="text-muted">No Image</span>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->name }}</h5>
                                    <p class="mb-1"><strong>Ashram:</strong> {{ $room->ashram->name ?? '-' }}</p>
                                    <p class="mb-1"><strong>Type:</strong> {{ $room->room_type }}</p>
                                    <p class="mb-1"><strong>Beds:</strong> {{ $room->no_of_beds }}</p>
                                    <p class="mb-1"><strong>Capacity:</strong> {{ $room->room_capacity }} persons</p>
                                    <p class="mb-1"><strong>Donation:</strong> ₹{{ $room->donation }}</p>
                                    <p class="mb-1"><strong>Extra Charges:</strong>
                                        ₹{{ number_format($room->extra_charges, 2) }}</p>
                                    <p class="mb-1"><strong>Active:</strong> {{ $room->active ? 'Yes' : 'No' }}</p>
                                </div>

                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex justify-content-between">
                                        @can('room-edit')
                                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bx bx-edit-alt"></i> Edit
                                            </a>
                                        @endcan
                                        @can('room-delete')
                                            <form method="POST" action="{{ route('rooms.destroy', $room->id) }}"
                                                class="delete-form d-inline">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-confirm">
                                                    <i class="bx bx-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">No rooms available.</div>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $rooms->links() }}
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-confirm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

</x-app-layout>
