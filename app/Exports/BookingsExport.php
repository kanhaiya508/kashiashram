<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    public function collection()
    {
        return $this->bookings;
    }

    public function headings(): array
    {
        return [
            'Booking ID',
            'Customer Name',
            'User Type',
            'Phone',
            'Booking From',
            'Booking To',
            'Rooms (Name & Amount)',
            'Total Booking Amount (₹)',
            'Status',
        ];
    }

    public function map($booking): array
    {
        // Rooms ko ek string me combine kar rahe hain: RoomName (₹amount), RoomName (₹amount), ...
        $roomsList = $booking->rooms->map(function ($r) {
            return ($r->room->name ?? '-') . ' (₹' . number_format($r->amount, 2) . ')';
        })->implode(", ");  // Yahan ", " se alag kar rahe hain, agar newline chahiye toh "\n" bhi kar sakte hain

        return [
            $booking->id,
            $booking->name,
            $booking->user_type,
            $booking->phone,
            $booking->booking_from->format('d-m-Y'),
            $booking->booking_to->format('d-m-Y'),
            $roomsList,  // Sabhi rooms ek hi cell me aayenge
            number_format($booking->rooms->sum('amount'), 2),  // Total amount
            ucfirst($booking->status),
        ];
    }
}
