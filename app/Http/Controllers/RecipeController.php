<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Bean;
use App\Tool;
use App\Process;

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
        
        //道具
        foreach($request->tools as $value){
            $tool = new Tool();
            $tool->recipe_id = $recipe_id;
            $tool->name = $value;
            $tool->save();
        }
        
        //手順
        
        
        $process_num = 0;
        $pro_1 = $request->pro_1;
        $pro_2 = $request->pro_2;
        $pro_3 = $request->pro_3;
        $pro_4 = $request->pro_4;
        $pro_5 = $request->pro_5;
        
        $process = new Process();
        
        $process->recipe_id = $recipe_id;
        $process->process_num = $process_num + 1;
        $process->action = $pro_1;
        // $process->memo = $memo;
        // $process->image = $image;
        $process->save();
        
        // foreach($request->processes as $value){
        //     $process = new Process();
        //     $process->recipe_id = $recipe_id;
        //     $process->process_num = $process_num + 1;
        //     $process->action = $value;
        //     dd($value);
        //     $process->save();
        // }
        
        return redirect('/recipe/create');
    }
}
