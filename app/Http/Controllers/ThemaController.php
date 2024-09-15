<?php

namespace App\Http\Controllers;

use App\Models\Thema;
use Illuminate\Http\Request;

class ThemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Thema::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        Thema::create([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);
        return response()->json(['message' => 'Post created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $thema = Thema::find($id);
        return response()->json($thema, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(thema $thema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, thema $thema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(thema $thema)
    {
        //
    }
}
