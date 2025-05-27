<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span>
            <span class="text-muted fw-light">{{ $pagename }} /</span>List
        </h4>
        <div class="card">
            <div class="card-header">
                @can($permissionPrefix . '-create')
                    <a href="{{ route($routePrefix . '.create') }}">
                        <x-primary-button type="button">Add</x-primary-button>
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <div class="">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Quotation Number</th>
                                    <th>Survey Number</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>GST Amount</th>
                                    <th>Final Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a
                                                href="{{ route($routePrefix . '.show', $row->survey_id) }}">{{ $row->quotation_number }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('surveys.show', $row->survey_id) }}">{{ $row->survey->survey_no ?? 'N/A' }}</a>
                                        </td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ number_format($row->calculateTotalAmount()) }}</td>
                                        <td>{{ number_format($row->calculateGSTAmount()) }}</td>
                                        <td>{{ number_format($row->calculateFinalAmount()) }}</td>

                                        <!-- Status Dropdown -->
                                        <td>
                                            <div class="form-group">
                                                <select class="form-select dropdowenstatus"
                                                    data-id="{{ $row->id }}"
                                                    data-url="{{ route($routePrefix . '.update.status', $row) }}">
                                                    <option value="pending"
                                                        {{ $row->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $row->status == 'approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $row->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Invoice Generate -->
                                                    <a class="dropdown-item"
                                                        href="{{ route($routePrefix . '.genrate.invoice', $row->id) }}">
                                                        <i class="bx bx-file me-1"></i> Generate Invoice
                                                    </a>

                                                    <!-- Manage Service Items -->
                                                    <a class="dropdown-item"
                                                        href="{{ route($routePrefix . '.add.service', $row->id) }}">
                                                        <i class="bx bx-list-ul me-1"></i> Manage Service
                                                    </a>

                                                    <!-- Download Quotation PDF -->
                                                    <a class="dropdown-item"
                                                        href="{{ route('quotation.download.pdf', $row->id) }}">
                                                        <i class="bx bx-download me-1"></i> Download PDF
                                                    </a>
                                                    <!-- Show -->
                                                    <a class="dropdown-item"
                                                        href="{{ route($routePrefix . '.show', $row->id) }}">
                                                        <i class="bx bx-show me-1"></i> Show
                                                    </a>
                                                    <!-- Edit -->
                                                    @can($permissionPrefix . '-edit')
                                                        <a class="dropdown-item"
                                                            href="{{ route($routePrefix . '.edit', $row->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                    @endcan

                                                    <!-- Delete -->
                                                    @can($permissionPrefix . '-delete')
                                                        <form method="POST"
                                                            action="{{ route($routePrefix . '.destroy', $row->id) }}"
                                                            style="display:inline" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item delete-button">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No quotations found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
