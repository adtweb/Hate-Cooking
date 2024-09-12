<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Рецепты для тех, кто не любит готовить';

        return view('welcome', compact('pageTitle'));
    }
}
