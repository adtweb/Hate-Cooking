<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'value' => ['required', 'string', 'max:255'],
            'photo_url' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'description' => 'required',
        ]);

        $recipe = Recipe::create([
            ...$data,
            'slug' => Recipe::getUniqSlug($data['value']),
            'photo_url' => $request->file('photo_url')->store('photos'),
            'user_id' => $request->user()->id
        ]);

        $recipe->categories()->attach($request->categories);
        $recipe->qualities()->attach($request->qualities);

        return to_route('recipes.edit', ['recipe' => $recipe->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
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
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', [
            'recipe' => $recipe,
            'qualities' => $recipe->qualities(),
            'categories' => $recipe->categories(),
            'ingredients' => $recipe->ingredients(),
            'steps' => $recipe->steps(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recipe $recipe)
    {
        Gate::authorize('update', $recipe);

        $data = $request->validate([
            'value' => ['required', 'string', 'max:255'],
            'photo_url' => ['nullable'],
            'description' => 'required',
        ]);
        if ($request->photo_url) {
            $request->validate([
                'photo_url' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            ]);
            $data['photo_url'] = $request->file('photo_url')->store('photos');
        }

        $recipe->update([...$data]);
        $recipe->categories()->attach($request->categories);
        $recipe->qualities()->attach($request->qualities);

        return to_route('recipes.show', ['recipe' => $recipe]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        Gate::authorize('delete', $recipe);

        $recipe->delete();

        return to_route('recipes.index');
    }
}
