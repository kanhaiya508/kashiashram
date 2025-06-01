<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Room Bookings Report</title>
    <style>
        /* Reset & base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 20px 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #004085;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            vertical-align: top;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            font-size: 14px;
            user-select: none;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        ul {
            margin: 0;
            padding-left: 18px;
            list-style-type: disc;
            font-size: 12px;
        }

        /* Badge styles */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 700;
            border-radius: 12px;
            color: #fff;
            white-space: nowrap;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-primary {
            background-color: #007bff;
        }

        .bg-info {
            background-color: #17a2b8;
        }

        .bg-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .bg-secondary {
            background-color: #6c757d;
        }

        /* Status badge */
        .status-booked {
            background-color: #17a2b8;
            color: #000;
        }

        .status-completed {
            background-color: #28a745;
        }

        .status-cancelled {
            background-color: #dc3545;
        }

        .status-applied {
            background-color: #ffc107;
            color: #212529;
        }

        /* Footer */
        .footer {
            font-size: 11px;
            color: #666;
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <h2>Room Bookings Report</h2>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">#</th>
                <th style="width: 150px;">Customer</th>
                <th style="width: 110px;">Phone</th>
                <th style="width: 120px;">Booking Dates</th>
                <th>Rooms</th>
                <th style="width: 100px;">Total Amount</th>
                <th style="width: 90px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $booking->name }}<br>
                        <small>User Type:</small><br>
                        @if ($booking->user_type == 'Donar')
                            <span class="badge bg-success">Donar</span>
                        @elseif ($booking->user_type == 'New Yatri')
                            <span class="badge bg-primary">New Yatri</span>
                        @elseif ($booking->user_type == 'Regular Yatri')
                            <span class="badge bg-info">Regular Yatri</span>
                        @else
                            <span class="badge bg-warning">Unknown</span>
                        @endif
                    </td>
                    <td>{{ $booking->phone }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($booking->booking_from)->format('d-m-Y') }}
                        Rs.
                        {{ \Carbon\Carbon::parse($booking->booking_to)->format('d-m-Y') }}
                    </td>
                    <td>
                        <ul>
                            @foreach ($booking->rooms as $r)
                                <li>{{ $r->room->name ?? '-' }} — Rs.{{ number_format($r->amount, 2) }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>₹ {{ number_format($booking->rooms->sum('amount'), 2) }}</td>
                    <td>
                        @php
                            $status = $booking->status;
                            $badgeClass = match ($status) {
                                'booked' => 'status-booked',
                                'completed' => 'status-completed',
                                'cancelled' => 'status-cancelled',
                                'applied' => 'status-applied',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $total = $bookings->count();
        $first = $total > 0 ? 1 : 0;
        $last = $total;
    @endphp

    <div class="footer">
        <div>
            Showing records
            <strong>{{ $first }}</strong>
            to
            <strong>{{ $last }}</strong>
            of
            <strong>{{ $total }}</strong>
        </div>
        <div>Generated on: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</div>
    </div>


</body>

</html>
