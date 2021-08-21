<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    public function index() {
        $user = auth()->user();
        $recipes = Recipe::get();
        return view('recipe/index', compact('recipes'));
    }
    
    public function create() {
        return view('recipe/create');
    }
}
