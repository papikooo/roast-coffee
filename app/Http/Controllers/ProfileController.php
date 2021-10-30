<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\User;
use App\Profile;
use App\Favorite;
use App\Recipe;
use App\Bean;
use App\RecipeHistory;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index($id) {
        $user =  User::where('id','=', $id)->first();
        $profile = Profile::where('user_id','=',$id)->first();
        
        $histories = RecipeHistory::where('user_id', '=', $id)
            ->orderBy('recipe_histories.created_at','desc')->limit(5)->get();
        $recipe_ids = $histories->map(function($item, $key){
            return $item->recipe_id;
        })->all(); 
        
        $recipe_details = Recipe::whereIn('id', $recipe_ids)->get();
        $recipe_beans = Bean::whereIn('recipe_id', $recipe_ids)->get();
        
        foreach($histories as $history){
            $history->detail = $recipe_details->find($history->recipe_id);
            $history->beans = $recipe_beans->filter(function($bean, $key)use($history) {
                return $bean->recipe_id == $history->recipe_id;
            });
        }
        
        return view('profile/index', compact('profile','user', 'histories'));
    }
    
    public function edit() {
        $id = auth()->id();
        $user =  User::where('id','=', $id)->first();
        $profile = Profile::where('user_id','=',$id)->first();
        
        return view('profile/edit', compact('profile','user'));
    }
    
    public function update(Request $request) {
        $id = auth()->id();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' =>['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'introduction' => 'max:500'
        ]);
        
        $image = $request->file('image');
        $profile_image = null;
        if(isset($image)){
            $path = Storage::disk('s3')->putFile('profile', $image, 'public');
            $profile_image = Storage::disk('s3')->url($path);
        }
        
        $name = $request->name;
        $email = $request->email;
        $introduction = $request->introduction;
        
        $user =  User::where('id','=', $id)->first();
        $profile = Profile::where('user_id', '=', $id)->first();
        
        $user->name = $name;
        $user->email = $email;
        $profile->introduction = $introduction;
        $profile->image =$profile_image;
        $user->save();
        $profile->save();
        
        return redirect("/profile/$id");
    }
    
    public function favorite($id) {
        $favorites = Favorite::where('user_id', '=', $id)->get();
        $recipe_ids = $favorites->map(function($item, $key){
            return $item->recipe_id;
        })->all(); 
        
        $recipe_details = Recipe::whereIn('id', $recipe_ids)->get();
        $recipe_beans = Bean::whereIn('recipe_id', $recipe_ids)->get();
        
        foreach($favorites as $favorite){
            $favorite->detail = $recipe_details->find($favorite->recipe_id);
            $favorite->beans = $recipe_beans->filter(function($bean, $key)use($favorite) {
                return $bean->recipe_id == $favorite->recipe_id;
            });
        }
                                
        return view('profile/favorite', compact('favorites'));
    }
    
}