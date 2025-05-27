<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Dashboard /</span> <span class="text-muted fw-light">
                Account Settings /</span> Role Management </h4>

        <div class="card">
            <div class="card-header">
                @can('role-create')
                    <a href="{{ route('roles.create') }}">
                        <button type="button" class="btn btn-primary">Add</button>
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('role-edit')
                                                    <a class="dropdown-item" href="{{ route('roles.edit', $row->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('role-delete')
                                                    <form method="POST" action="{{ route('roles.destroy', $row->id) }}"
                                                        style="display:inline" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button" class="dropdown-item delete-button"><i
                                                                class="bx bx-trash me-1"></i> Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
