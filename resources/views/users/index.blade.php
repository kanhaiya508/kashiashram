

<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Dashboard /</span> <span class="text-muted fw-light">
                Account Settings /</span> Users Management </h4>
        <div class="card">
            <div class="card-header">
                @can('role-create')
                <a href="{{ route('users.create') }}">
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
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    @if(!empty($row->getRoleNames()))
                                    @foreach($row->getRoleNames() as $v)
                                    <label class="badge bg-primary">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                          
                                            <a class="dropdown-item" href="{{ route('users.edit', $row->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                          
                                            <form method="POST" action="{{ route('users.destroy', $row->id) }}"
                                                style="display:inline" class="delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="dropdown-item delete-button"><i
                                                        class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                          
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $data->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>