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
        $defaultEndDate = Carbon::tomorrow()->format('Y-m-d');

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

            // Append booked dates to each room
            foreach ($rooms as $room) {
                $bookedDates = [];

                foreach ($room->bookings as $booking) {
                    $from = Carbon::parse($booking->booking->booking_from);
                    $to = Carbon::parse($booking->booking->booking_to);
                    $period = $from->copy();

                    while ($period->lte($to)) {
                        $bookedDates[] = $period->format('Y-m-d');
                        $period->addDay();
                    }
                }

                $room->booked_dates = $bookedDates;
            }

            return view('calendar.room', compact('ashrams', 'rooms', 'dateRange', 'ashramId', 'startDate', 'endDate'));
        }

        return view('calendar.room', compact('ashrams', 'ashramId', 'startDate', 'endDate'));
    }

    public function donorcalendar(Request $request)
    {
        $defaultStartDate = Carbon::today()->format('Y-m-d');
        $defaultEndDate = Carbon::tomorrow()->format('Y-m-d');

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
