<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{


    public function index()
    {
        $rooms = Room::where('active', 1)->get();
        return view('website.index', compact('rooms'));
    }


    public function roombookings(Request $request)
    {
        $bookingFrom = $request->booking_from ?? now()->toDateString();
        $bookingTo = $request->booking_to ?? now()->addDay()->toDateString();

        // Merge for validation
        $request->merge([
            'booking_from' => $bookingFrom,
            'booking_to' => $bookingTo,
        ]);

        $request->validate([
            'booking_from' => 'required|date',
            'booking_to' => 'required|date|after_or_equal:booking_from',
        ]);

        // Step 1: Get all bookings in the date range that are still active
        $activeBookingIds = Booking::where('status', 'booked')
            ->where(function ($q) use ($bookingFrom, $bookingTo) {
                $q->whereBetween('booking_from', [$bookingFrom, $bookingTo])
                    ->orWhereBetween('booking_to', [$bookingFrom, $bookingTo])
                    ->orWhere(function ($q2) use ($bookingFrom, $bookingTo) {
                        $q2->where('booking_from', '<=', $bookingFrom)
                            ->where('booking_to', '>=', $bookingTo);
                    });
            })
            ->pluck('id');

        // Step 2: Get all room_ids booked within those bookings
        $bookedRoomIds = RoomBooking::whereIn('booking_id', $activeBookingIds)
            ->pluck('room_id')
            ->toArray();

        // Step 3: Filter out booked rooms
        $rooms = Room::where('active', 1)
            ->whereNotIn('id', $bookedRoomIds)
            ->get();

        session([
            'booking_from' => $bookingFrom,
            'booking_to' => $bookingTo,
        ]);


        return view('website.roombookings', compact('rooms'));
    }

    public function confirm()
    {
        $roomIds = session('selected_rooms', []);
        $rooms = Room::whereIn('id', $roomIds)->get();
        $booking_from = session('booking_from');
        $booking_to = session('booking_to');
        return view('website.confirm', compact('rooms', 'booking_from', 'booking_to'));
    }

    public function storeFinal(Request $request)
    {
        Log::info('storeFinal called');

        $roomIds = session('selected_rooms', []);
        $bookingFrom = session('booking_from');
        $bookingTo = session('booking_to');

        Log::info('Session data', [
            'roomIds' => $roomIds,
            'bookingFrom' => $bookingFrom,
            'bookingTo' => $bookingTo,
        ]);

        if (empty($roomIds) || !$bookingFrom || !$bookingTo) {
            Log::warning('Invalid session data');
            return redirect()->back()->with('error', 'Invalid booking session.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'aadhar' => 'nullable|string',
            'message' => 'nullable|string',
            'gothra' => 'nullable|string',
            'user_type' => 'nullable|string',
            'travel_type' => 'nullable|string',
            'amounts' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            Log::info('Creating booking...');

            $booking = Booking::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'aadhar' => $request->aadhar,
                'message' => $request->message,

                'adults' => $request->adults,
                'children' => $request->children,

                'gothra' => $request->gothra,
                'user_type' => $request->user_type,
                'travel_type' => $request->travel_type,
                'booking_from' => $bookingFrom,
                'booking_to' => $bookingTo,
                'status' => 'applied',
            ]);

            Log::info('Booking created', ['booking_id' => $booking->id]);

            foreach ($roomIds as $roomId) {
                $amount = $request->amounts[$roomId] ?? 0;
                RoomBooking::create([
                    'booking_id' => $booking->id,
                    'room_id' => $roomId,
                    'amount' => $amount,
                ]);
                Log::info('Room booked', ['room_id' => $roomId, 'amount' => $amount]);
            }

            session()->forget(['selected_rooms', 'booking_from', 'booking_to']);
            DB::commit();

            Log::info('Booking successful');
            return redirect()->route('thankyou')->with('success', 'Booking confirmed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function thankyou()
    {
        return view('website.thankyou');
    }
}
