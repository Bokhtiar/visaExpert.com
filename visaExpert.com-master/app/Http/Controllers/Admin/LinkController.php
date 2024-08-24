<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::latest()->get();
        return view('backend.link.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.link.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Link::create([
                'name' => $request->name,
                'link' => $request->link,
                'color' => $request->color,
            ]);

            return redirect()->route('admin.link.index')->with('success', 'Created successfully.');
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['message' => 'Error creating road', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Link::find($id);
        return view('backend.link.show', compact('show'));
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Link::find($id);
        return view('backend.link.form', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Link::find($id);
        $link->update([
            'name' => $request->name,
            'link' => $request->link,
            'color' => $request->color,
        ]);
        return redirect()->back()->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Link::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
