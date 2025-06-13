<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ashram;
use App\Models\Donor;
use App\Models\Room;


class CalendarController extends Controller
{

    public function roomcalendar(Request $request)
    {
        $ashrams = Ashram::all();

        // Default values
        $defaultAshramId = $ashrams->first()->id ?? null;
        $defaultStartDate = Carbon::today()->format('Y-m-d');
        $defaultEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');  // ✅ Corrected here

        // Get request values or use defaults
        $ashramId = $request->input('ashram_id', $defaultAshramId);
        $startDate = $request->input('start_date', $defaultStartDate);
        $endDate = $request->input('end_date', $defaultEndDate);


        // If required inputs exist
        if ($ashramId && $startDate && $endDate) {
            $rooms = Room::where('ashram_id', $ashramId)->with('bookings.booking')->get();

            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);
            $dateRange = [];

            while ($start->lte($end)) {
                $dateRange[] = $start->format('Y-m-d');
                $start->addDay();
            }

            $bookingDetailsMap = []; // Holds booking details by room and date

            // Append booked dates + full booking details
            foreach ($rooms as $room) {
                $bookedDates = [];
                $bookingDetailsByDate = [];

                foreach ($room->bookings as $booking) {
                    $from = Carbon::parse($booking->booking->booking_from);
                    $to = Carbon::parse($booking->booking->booking_to);
                    $period = $from->copy();

                    while ($period->lt($to)) {
                        $dateStr = $period->format('Y-m-d');
                        $bookedDates[] = $dateStr;

                        $bookingDetailsByDate[$dateStr] = [
                            'booking_id' => $booking->booking->id,
                            'name' => $booking->booking->name,
                            'phone' => $booking->booking->phone,
                            'aadhar' => $booking->booking->aadhar,
                            'status' => $booking->booking->status,
                            'amount' => $booking->amount,
                            'room_name' => $room->name,
                            'room_type' => $room->room_type,
                            'donation' => $room->donation,
                        ];

                        $period->addDay();
                    }
                }

                $room->booked_dates = $bookedDates;
                $room->booking_details_by_date = $bookingDetailsByDate;
            }

            return view('calendar.room', compact('ashrams', 'rooms', 'dateRange', 'ashramId', 'startDate', 'endDate'));
        }

        return view('calendar.room', compact('ashrams', 'ashramId', 'startDate', 'endDate'));
    }

    public function donorcalendar(Request $request)
    {
        $defaultStartDate = Carbon::today()->format('Y-m-d');
        $defaultEndDate = Carbon::endOfMonth()->format('Y-m-d');

        $startDate = $request->input('start_date', $defaultStartDate);
        $endDate = $request->input('end_date', $defaultEndDate);

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $dateRange = [];

        while ($start->lte($end)) {
            $dateRange[] = $start->format('Y-m-d');
            $start->addDay();
        }

        $donors = Donor::whereBetween('donation_date', [$startDate, $endDate])->get();

        return view('calendar.donor-calendar', compact('donors', 'dateRange', 'startDate', 'endDate'));
    }
}
