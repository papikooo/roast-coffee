<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoriteController extends Controller
{
    public function add($recipe_id) {
        $favorite = new Favorite();
        $favorite->user_id = auth()->id();
        $favorite->recipe_id = $recipe_id;
        $favorite->save();
        
        return redirect("/recipe/detail/$recipe_id");
    }
    
    public function delete($recipe_id) {
        $user_id = auth()->id();
        Favorite::where('recipe_id', '=', $recipe_id)
                ->where('user_id', '=', $user_id)->delete();
        
        return redirect("/recipe/detail/$recipe_id");
    }
}
