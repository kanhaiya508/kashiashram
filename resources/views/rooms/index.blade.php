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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Ashram</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Beds</th>
                                <th>Donation</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if (!empty($room->image))
                                            <a target="_blank" href="{{ asset($room->image) }}"> <img
                                                    src="{{ asset($room->image) }}" alt="Room Image"
                                                    style="width: 80px; height: auto;"></a>
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>

                                    <td>{{ $room->ashram->name ?? '-' }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->room_type }}</td>
                                    <td>{{ $room->no_of_beds }}</td>
                                    <td>₹{{ $room->donation }}</td>
                                    <td>{{ $room->active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('room-edit')
                                                    <a class="dropdown-item" href="{{ route('rooms.edit', $room->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                @endcan
                                                @can('room-delete')
                                                    <form method="POST" action="{{ route('rooms.destroy', $room->id) }}"
                                                        class="delete-form">
                                                        @csrf @method('DELETE')
                                                        <button type="button" class="dropdown-item delete-button">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">

                        <div>
                            {{ $rooms->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
