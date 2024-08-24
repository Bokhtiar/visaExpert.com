<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noteped;
use Illuminate\Http\Request;

class NotepedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notepads = Noteped::latest()->get();
        return view('backend.notepad.index', compact('notepads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.notepad.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Noteped::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect()->route('admin.notepad.index')->with('success', 'Created successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating road', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Noteped::find($id);
        return view('backend.notepad.show', compact('show'));
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Noteped::find($id);
        return view('backend.notepad.form', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notepad = Noteped::find($id);
        $notepad->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.notepad.index')->with('success', 'updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Noteped::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
