<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Heading -->
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span>
            <span class="text-muted fw-light">Quotation /</span> View Details
        </h4>

        <!-- Quotation Details Card -->
        <div class="card">
            <div class="card-header">
                @can($permissionPrefix . '-create')
                    <!-- Back Button -->
                    <x-back-button route="{{ route($routePrefix . '.index') }}" icon="fa-arrow-left" text="Back" />
                @endcan
            </div>
            <div class="card-body">
                <h5>Quotation Details</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Quotation Number</th>
                            <td>{{ $data->quotation_number }}</td>
                            <th>Quotation Date</th>
                            <td>{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Moving Type</th>
                            <td>{{ ucfirst(str_replace('_', ' ', $data->moving_type)) }}</td>
                            <th>Status</th>
                            <td>
                                <span
                                    class="badge bg-{{ $data->status == 'approved' ? 'success' : ($data->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Packing Date</th>
                            <td>{{ \Carbon\Carbon::parse($data->packing_date)->format('d M Y') }}</td>
                            <th>Delivery Date</th>
                            <td>{{ \Carbon\Carbon::parse($data->delivery_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>{{ number_format($data->total_amount, 2) }}</td>
                            <th>Final Amount</th>
                            <td>{{ number_format($data->final_amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="mt-4">Survey Details</h5>
                <div class="row">
                    <!-- Move From Section -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Move From (Consignor Details)</h6>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Name</th>
                                    <td>{{ $data->survey->consignor_name_from }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $data->survey->consignor_phone_from }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $data->survey->address_from }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $data->survey->city_from }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $data->survey->state_from }}</td>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <td>{{ $data->survey->pincode_from }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Move To Section -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Move To (Consignee Details)</h6>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Name</th>
                                    <td>{{ $data->survey->consignee_name_to }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $data->survey->consignee_phone_to }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $data->survey->address_to }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $data->survey->city_to }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $data->survey->state_to }}</td>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <td>{{ $data->survey->pincode_to }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <h5 class="mt-4">Quotation Items</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->service->name }}</td>
                                <td>{{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-end fw-bold">Total Amount</td>
                            <td>{{ number_format($data->items->sum('amount'), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
