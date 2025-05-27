<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Ashrams
        </h4>

        <div class="card">
            <div class="card-header">
                @can('ashram-create')
                    <a href="{{ route('ashrams.create') }}" class="btn btn-primary">Add Ashram</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Order</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ashrams as $ashram)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ashram->name }}</td>
                                    <td>{{ $ashram->type }}</td>
                                    <td>{{ $ashram->order }}</td>
                                    <td>{{ $ashram->active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('ashram-edit')
                                                    <a class="dropdown-item"
                                                        href="{{ route('ashrams.edit', $ashram->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                @endcan
                                                @can('ashram-delete')
                                                    <form method="POST"
                                                        action="{{ route('ashrams.destroy', $ashram->id) }}"
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
                    <div class="d-flex justify-content-end mt-3">{{ $ashrams->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
