<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Ashram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoomController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:room-list', only: ['index']),
            new Middleware('permission:room-create', only: ['create', 'store']),
            new Middleware('permission:room-edit', only: ['edit', 'update']),
            new Middleware('permission:room-delete', only: ['destroy']),
        ];
    }

    public function index(Request $request): View
    {
        $query = Room::with('ashram');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $rooms = $query->latest()->paginate(15)->withQueryString(); // withQueryString maintains search during pagination

        return view('rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        $ashrams = Ashram::pluck('name', 'id');
        return view('rooms.create', compact('ashrams'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ashram_id' => 'required|exists:ashrams,id',
            'name' => 'required|string',
            'donation' => 'required|numeric',
            'no_of_beds' => 'required|integer',
            'room_type' => 'required|in:AC,Non-AC',
            'room_capacity' => 'required|integer|min:1',

            'image' => 'nullable|image',
        ]);

        $data = $request->only([
            'ashram_id',
            'name',
            'donation',
            'no_of_beds',
            'room_type',
            'room_capacity',
            'active'
        ]);


        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/rooms'), $filename);
            $data['image'] = 'uploads/rooms/' . $filename;
        }

        Room::create($data);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room): View
    {
        $ashrams = Ashram::pluck('name', 'id');
        return view('rooms.edit', compact('room', 'ashrams'));
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $request->validate([
            'ashram_id' => 'required|exists:ashrams,id',
            'name' => 'required|string',
            'donation' => 'required|numeric',
            'no_of_beds' => 'required|integer',
            'room_type' => 'required|in:AC,Non-AC',
            'room_capacity' => 'required|integer|min:1',
            'image' => 'nullable|image',
        ]);

        $data = $request->only([
            'ashram_id',
            'name',
            'donation',
            'no_of_beds',
            'room_type',
            'room_capacity',
            'active'
        ]);


        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/rooms'), $filename);
            $data['image'] = 'uploads/rooms/' . $filename;
        }

        $room->update($data);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room): RedirectResponse
    {
        if ($room->image && file_exists(public_path($room->image))) {
            unlink(public_path($room->image));
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
