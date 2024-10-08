<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'photo_url' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'description' => 'required',
        ]);

        $recipe->steps()->create([
            ...$data,
            'photo_url' => $request->file('photo_url')->store('photos')
        ]);

        return to_route('recipes.edit', $recipe);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe, Step $step)
    {
        Gate::authorize('delete', $recipe);

        $step->delete();

        return to_route('recipes.edit', $recipe);
    }
}
