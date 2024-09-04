<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Recipe;

Route::get('/', fn () => view('welcome')->withRecipes(Recipe::all));
