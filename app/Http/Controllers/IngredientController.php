<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IngredientController extends Controller
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
            'value' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
        ]);

        $recipe->ingredients()->create([...$data]);

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
    public function destroy(Recipe $recipe, Ingredient $ingredient)
    {
        Gate::authorize('delete', $recipe);

        $ingredient->delete();

        return to_route('recipes.edit', $recipe);
    }
}
