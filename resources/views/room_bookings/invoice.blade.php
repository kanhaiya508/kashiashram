<!DOCTYPE html>
<html>

<head>
    <title>SKG Ashram - Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            padding: 15px;
        }

        h2,
        h4,
        p {
            margin: 0;
            padding: 0;
        }

        .center {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .note {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h2 class="center">SKG ASHRAM - INVOICE</h2>
    <p class="center">WELCOME TO MOKSHAPURI KASHI<br>BOOKING CONFIRMATION COPY</p>

    <h4>Shree Gayatri Charitable Trust</h4>
    <p>B7/131, Bagh Hada, (near Sai Baba Mandir Sonarpura Varanasi)<br>Kedar Ghat 221001<br>Phone: +91 9918774933</p>

    <table>
        <tr>
            <th>Booking ID</th>
            <td>{{ $booking->id }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ $booking->created_at->format('d-m-Y h:i A') }}</td>
        </tr>
        <tr>
            <th>Guest Name</th>
            <td>{{ $booking->name }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $booking->phone }}</td>
        </tr>
        <tr>
            <th>Gotram</th>
            <td>{{ $booking->gothra }}</td>
        </tr>
        <tr>
            <th>Aadhaar Number</th>
            <td>{{ $booking->aadhar }}</td>
        </tr>
        <tr>
            <th>Email ID</th>
            <td>{{ $booking->email }}</td>
        </tr>
        <tr>
            <th>Check-in Date</th>
            <td>{{ $booking->booking_from->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Check-out Date</th>
            <td>{{ $booking->booking_to->format('d-m-Y') }}</td>
        </tr>
        @php
            $roomTotal = $booking->rooms->sum('amount');
            $day = $booking->getDurationInDays() ?? 0;
            $finalTotal = $roomTotal * $day;
            $isPaid = $booking->payment_status === 'paid';
            $paidAmount = $booking->paid_amount ?? 0; // agar paid amount stored hai to use karo
        @endphp

        <tr>
            <th>Room Total</th>
            <td>₹{{ number_format($roomTotal, 2) }}</td>
        </tr>
        <tr>
            <th>No. of Days</th>
            <td>{{ $booking->getDurationInDays() }}</td>
        </tr>
        <tr class="table-primary fw-bold">
            <th>Final Total Amount</th>
            <td>₹{{ number_format($finalTotal, 2) }}</td>
        </tr>
        <tr>
            <th>Paying Amount</th>
            <td>₹{{ number_format($paidAmount, 2) }}</td>
        </tr>
        <tr>
            <th>Remaining Balance</th>
            <td>₹{{ number_format($finalTotal - $paidAmount, 2) }}</td>
        </tr>


        <tr>
            <th>No. of People</th>
            <td>{{ $booking->adults + $booking->children }}</td>
        </tr>
        <tr>
            <th>Travel Type</th>
            <td>{{ $booking->travel_type }}</td>
        </tr>

        <tr>
            <th>User Type</th>
            <td>{{ $booking->user_type }}</td>
        </tr>
        <tr>
            <th>Adults</th>
            <td>{{ $booking->adults }}</td>
        </tr>
        <tr>
            <th>Children</th>
            <td>{{ $booking->children }}</td>
        </tr>
        <tr>
            <th>Anna Prasadam Timing</th>
            <td>12:30 PM to 2:30 PM</td>
        </tr>
        <tr>
            <th>Tiffin in Evening</th>
            <td>8:00 PM</td>
        </tr>
        <tr>
            <th>Message</th>
            <td>{{ $booking->message }}</td>
        </tr>
    </table>

    <h4 class="mt-3">Rooms Booked:</h4>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Room</th>
                <th>Type</th>
                <th>Beds</th>
                <th>Days</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking->rooms as $index => $r)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ optional($r->room)->name ?? '-' }}</td>
                    <td>{{ optional($r->room)->room_type ?? '-' }}</td>
                    <td>{{ optional($r->room)->no_of_beds ?? '-' }}</td>
                    <td>{{ $booking->getDurationInDays() }}</td>
                    <td>₹{{ number_format($r->amount * $booking->getDurationInDays(), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <p class="note"><strong>Note:</strong> In case of any cancellation, the paid amount will not be refundable or
        transferable and will be utilized for Narayana Seva.</p>
    <p class="note"><strong>Note:</strong> Don’t forget to register your name in the reception register for Anna
        Prasadam before morning 8 AM and evening 5 PM.</p>
    <p class="note"><strong>We request you to participate in <em>*Annaprasad Donation Yadhasakthi*</em>.</strong></p>
    <p class="center"><strong>Thank You!!! Visit Again<br>*Hari Om*</strong></p>

</body>

</html>
