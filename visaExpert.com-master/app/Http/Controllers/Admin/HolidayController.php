<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $holidays = Holiday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();
        return view('backend.holiday.index', compact('holidays', 'month', 'year'));
    }

    public function create()
    {
        return view('backend.holiday.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required',
        ]);
    
        Holiday::create($request->all());
        return redirect()->route('admin.holiday.index')->with('success', 'Holiday created successfully.');
    }

    public function show(Holiday $holiday)
    {
        return view('holidays.show', compact('holiday'));
    }

    public function edit(Holiday $holiday)
    {
        $edit = $holiday;
        return view('backend.holiday.form', compact('edit'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required',
        ]);

        $holiday->update($request->all());
        return redirect()->route('admin.holiday.index')->with('success', 'Holiday updated successfully.');
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return redirect()->route('admin.holiday.index')->with('success', 'Holiday deleted successfully.');
    }

    /** holiday */
    public function holiday_filter(Request $request)
    {
     
        // Initialize the query
        $query = Holiday::query();
        $month = $request->month;
        $year = $request->year;

        // Apply month filter if present
        if ($request->month) {
            $query->whereMonth('date', $request->month);
        }

        // Apply year filter if present
        if ($request->year) {
            $query->whereYear('date', $request->year);
        }

        // Execute the query to get filtered holidays
        $holidays = $query->get();

        return view('backend.holiday.index', compact('holidays', 'month', 'year'));

    }
}
