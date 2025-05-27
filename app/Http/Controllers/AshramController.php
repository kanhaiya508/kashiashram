<?php

namespace App\Http\Controllers;

use App\Models\Ashram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AshramController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:ashram-list', only: ['index', 'show']),
            new Middleware('permission:ashram-create', only: ['create', 'store']),
            new Middleware('permission:ashram-edit', only: ['edit', 'update']),
            new Middleware('permission:ashram-delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $ashrams = Ashram::latest()->paginate(10);
        return view('ashrams.index', compact('ashrams'));
    }

    public function create(): View
    {
        return view('ashrams.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:ashrams,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'address', 'type', 'order', 'active']);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/ashrams'), $filename);
            $data['image'] = 'uploads/ashrams/' . $filename;
        }

        Ashram::create($data);

        return redirect()->route('ashrams.index')->with('success', 'Ashram created successfully.');
    }

    public function edit(int $id): View
    {
        $ashram = Ashram::findOrFail($id);
        return view('ashrams.edit', compact('ashram'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $ashram = Ashram::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:ashrams,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'address', 'type', 'order', 'active']);

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/ashrams'), $filename);
            $data['image'] = 'uploads/ashrams/' . $filename;
        }

        $ashram->update($data);

        return redirect()->route('ashrams.index')->with('success', 'Ashram updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $ashram = Ashram::findOrFail($id);
        if ($ashram->image && file_exists(public_path($ashram->image))) {
            unlink(public_path($ashram->image));
        }
        $ashram->delete();

        return redirect()->route('ashrams.index')->with('success', 'Ashram deleted successfully.');
    }
}
