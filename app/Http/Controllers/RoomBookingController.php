<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class RoomBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Booking::with('rooms.room')
            ->where('status', '!=', 'applied'); // applied exclude karne ke liye

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('booking_from', [$request->from_date, $request->to_date]);
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('room_bookings.index', compact('bookings'));
    }



    public function enquiry(Request $request)
    {
        $query = \App\Models\Booking::with('rooms.room')
            ->where('status', 'applied'); // sirf applied status wale

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('booking_from', [$request->from_date, $request->to_date]);
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        // Alag view bana sakte ho enquiry ke liye ya same view use karo
        return view('room_bookings.enquiry', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::pluck('name', 'id');
        return view('room_bookings.create', compact('rooms'));
    }


    public function availableRooms(Request $request)
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

        return view('room_bookings.select-room', compact('rooms'));
    }



    public function selectRoom()
    {
        $rooms = Room::where('active', 1)->get();
        $selected = Session::get('selected_rooms', []);
        return view('room_bookings.select-room', compact('rooms', 'selected'));
    }

    public function addToSession(Request $request)
    {
        $roomId = $request->room_id;
        $selected = session('selected_rooms', []);

        if (!in_array($roomId, $selected)) {
            $selected[] = $roomId;
            session(['selected_rooms' => $selected]);
        }

        return response()->json(['status' => 'added']);
    }

    public function removeFromSession(Request $request)
    {
        $roomId = $request->room_id;
        $selected = session('selected_rooms', []);

        $selected = array_filter($selected, fn($id) => $id != $roomId);
        session(['selected_rooms' => array_values($selected)]);

        return response()->json(['status' => 'removed']);
    }


    public function confirm()
    {
        $roomIds = session('selected_rooms', []);
        $rooms = Room::whereIn('id', $roomIds)->get();
        $booking_from = session('booking_from');
        $booking_to = session('booking_to');

        return view('room_bookings.confirm', compact('rooms', 'booking_from', 'booking_to'));
    }



    public function storeFinal(Request $request)
    {
        $roomIds = session('selected_rooms', []);
        $bookingFrom = session('booking_from');
        $bookingTo = session('booking_to');

        if (empty($roomIds) || !$bookingFrom || !$bookingTo) {
            return redirect()->route('room-bookings.index')->with('error', 'Invalid booking session.');
        }

        $request->validate([
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
            // Step 1: Create the master booking
            $booking = Booking::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'aadhar' => $request->aadhar,
                'message' => $request->message,
                'gothra' => $request->gothra,
                'user_type' => $request->user_type,
                'travel_type' => $request->travel_type,
                'booking_from' => $bookingFrom,
                'booking_to' => $bookingTo,


                'adults' => $request->adults,
                'children' => $request->children,


                'status' => $request->status,
            ]);

            // Step 2: Save all room bookings
            foreach ($roomIds as $roomId) {
                $amount = $request->amounts[$roomId] ?? 0;
                RoomBooking::create([
                    'booking_id' => $booking->id,
                    'room_id' => $roomId,
                    'amount' => $amount,
                ]);
            }

            // Step 3: Clear session
            session()->forget(['selected_rooms', 'booking_from', 'booking_to']);

            DB::commit();

            return redirect()->route('room-bookings.index')->with('success', 'Booking confirmed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function status_update($id, $status)
    {
        $booking = Booking::findOrFail($id);
        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        // Update the booking status
        $booking->update(['status' => $status]);

        return back()->with('success', 'Booking status updated to ' . $status . '.');
    }

    public function generateInvoice($id)
    {
        $booking = Booking::with(['rooms.room'])->findOrFail($id);
        $pdf = Pdf::loadView('room_bookings.invoice', compact('booking'))->setPaper('a4', 'portrait');
        $fileName = 'Invoice_' . $booking->name . '_' . $booking->id . '.pdf';
        return $pdf->stream($fileName);
    }


    // Controller me edit method me add karo
    public function edit($id)
    {
        $booking = Booking::with('rooms.room')->findOrFail($id);


        $bookingFrom = $booking->booking_from->toDateString();
        $bookingTo = $booking->booking_to->toDateString();
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

        return view('room_bookings.edit', compact('booking', 'rooms'));
    }


    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'aadhar' => 'nullable|string',
            'message' => 'nullable|string',
            'status' => 'required|string|in:applied,booked,cancelled,completed',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            'amounts' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            // Update booking info
            $booking->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'aadhar' => $request->aadhar,
                'message' => $request->message,
                'status' => $request->status,
                'adults' => $request->adults,
                'children' => $request->children,
            ]);

            // Update room booking amounts
            foreach ($booking->rooms as $roomBooking) {
                $roomId = $roomBooking->room_id;
                if (isset($request->amounts[$roomId])) {
                    $roomBooking->update(['amount' => $request->amounts[$roomId]]);
                }
            }

            DB::commit();

            return redirect()->route('room-bookings.index')->with('success', 'Booking updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update booking: ' . $e->getMessage());
        }
    }

    public function addRoomToBooking(Request $request, $bookingId)
    {



        $request->validate([
            'room_id' => 'required|exists:rooms,id',
        ]);

        $booking = Booking::findOrFail($bookingId);

        // Check if room already added
        $exists = RoomBooking::where('booking_id', $bookingId)->where('room_id', $request->room_id)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Room already added.');
        }

        $room = Room::findOrFail($request->room_id);

        RoomBooking::create([
            'booking_id' => $bookingId,
            'room_id' => $request->room_id,
            'amount' => $request->amount ?? $room->donation, // Adjust if price or donation field
        ]);

        return redirect()->back()->with('success', 'Room added successfully.');
    }


    public function removeRoomFromBooking(Request $request, $bookingId)
    {
        $request->validate([
            'room_booking_id' => 'required|exists:room_bookings,id',
        ]);

        $roomBooking = RoomBooking::findOrFail($request->room_booking_id);

        if ($roomBooking->booking_id != $bookingId) {
            return response()->json(['status' => 'error', 'message' => 'Room does not belong to this booking.']);
        }

        $roomBooking->delete();

        return response()->json(['status' => 'success', 'message' => 'Room removed successfully.']);
    }



    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('room-bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
