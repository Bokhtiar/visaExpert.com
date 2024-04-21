<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Road;
use Illuminate\Http\Request;

class RoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roads = Road::latest()->get();
        return view('backend.road.index', compact('roads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.road.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Road::create([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.road.index')->with('success', 'Created successfully.');
        } catch (\Exception $e) {
            // Handle the exception
            dd($e->getMessage());
            return response()->json(['message' => 'Error creating road', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Road::find($id);
        return view('backend.road.show', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Road::find($id);
        return view('backend.road.form', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $road = Road::find($id);
        $road->update([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Road::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
