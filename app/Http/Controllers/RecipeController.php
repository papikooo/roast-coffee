<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    public function index() {
        $recipes = Recipe::get();
        return view('recipe/index', compact('recipes'));
    }
}
