<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\recipe;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        $data = $request->validate(['description' => ['required', 'string', 'max:255']]);

        $recipe->comments()->create([...$data, 'user_id' => $request->user()->id]);

        return to_route('recipes.show', $recipe)->withFragment('comments');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return to_route('recipes.show', $recipe)->withFragment('comments');
    }
}
