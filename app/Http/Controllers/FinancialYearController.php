<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FinancialYearController extends Controller implements HasMiddleware
{
    protected $pagename = ' Financial Year';
    protected $routePrefix = 'financialyears';
    protected $permissionPrefix = 'financialyears';
    // Constructor to share the route and permission prefixes globally
    public function __construct()
    {
        // Share the variables with all views
        view()->share('pagename', $this->pagename);
        view()->share('routePrefix', $this->routePrefix);
        view()->share('permissionPrefix', $this->permissionPrefix);
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:financialyears-list', only: ['index', 'show']),
            new Middleware('permission:financialyears-create', only: ['create', 'store']),
            new Middleware('permission:financialyears-edit', only: ['edit', 'update']),
            new Middleware('permission:financialyears-delete', only: ['destroy']),
        ];
    }


    // Display a listing of the FinancialYears
    public function index()
    {
        $financialYears = FinancialYear::all();
        return view('financialyears.index', ['data' => $financialYears]);
    }

    // Show the form for creating a new FinancialYear
    public function create()
    {
        return view('financialyears.create', ['data' => null]);
    }

    // Store a newly created FinancialYear in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:0,1',
        ]);

        FinancialYear::create($request->only(['name', 'start_date', 'end_date', 'status']));

        return redirect()->route('financialyears.index')->with('success', 'Financial Year created successfully!');
    }

    // Display the specified FinancialYear
    public function show($id)
    {
        $financialYear = FinancialYear::findOrFail($id);
        return view('financialyears.show',  ['data' =>  $financialYear]);
    }

    // Show the form for editing the specified FinancialYear
    public function edit($id)
    {
        $financialYear = FinancialYear::findOrFail($id);
        return view('financialyears.edit', ['data' =>  $financialYear]);
    }


    // Update the specified FinancialYear in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:0,1',
        ]);
        $financialYear = FinancialYear::findOrFail($id);
        $financialYear->update($request->only(['name', 'start_date', 'end_date', 'status']));

        return redirect()->route('financialyears.index')->with('success', 'Financial Year updated successfully!');
    }

    // Update the status of a FinancialYear
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        // Find FinancialYear by ID
        $financialYear = FinancialYear::findOrFail($id);

        // Update status
        $financialYear->status = $request->status;
        $financialYear->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    // Remove the specified FinancialYear from storage
    public function destroy($id)
    {
        $financialYear = FinancialYear::findOrFail($id);
        $financialYear->delete();
        return redirect()->route('financialyears.index')->with('success', 'Financial Year deleted successfully!');
    }
}
