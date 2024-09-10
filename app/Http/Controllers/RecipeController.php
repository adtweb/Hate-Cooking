<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recipes.index', [
            'recipes' => Recipe::latest()->with('user')->with('categories')->with('qualities')->paginate(10),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(recipe $recipe)
    {
        return view('recipes.show', [
            'recipe' => $recipe,
            'qualities' => $recipe->qualities(),
            'categories' => $recipe->categories(),
            'ingredients' => $recipe->ingredients(),
            'steps' => $recipe->steps(),
            'comments' => $recipe->comments()->latest()->with('user')->paginate(10),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(recipe $recipe)
    {
        //
    }
}
