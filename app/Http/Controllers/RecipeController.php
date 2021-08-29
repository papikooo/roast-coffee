<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Bean;

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
    
    public function store(Request $request) {
        
        //レシピ登録
        $user_id = auth()->id();
        $name = $request->name;
        $introduction = $request->introduction;
        $time = $request->time;
        $public_status = 1;
        
        $recipe = new Recipe();
        
        $recipe->user_id = $user_id;
        $recipe->name = $name;
        $recipe->introduction = $introduction;
        $recipe->time = $time;
        // $recipe->thumbnail = $thumbnail;
        $recipe->public_status = $public_status;
        $recipe->save();
        
        $recipe_id = $recipe->id;
        
        //豆
        foreach($request->beans as $value){
            $bean = new Bean();
            $bean->recipe_id = $recipe_id;
            $bean->name = $value;
            $bean->save();
        }
        
        return redirect('/recipe/create');
    }
}
