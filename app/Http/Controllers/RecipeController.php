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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' =>['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        //     'introduction' => 'max:500'
        // ]);
        
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
        $beans = isset($request->beans) ? $request->beans : [];
            
        foreach($beans as $value1){
            $bean = new Bean();
            $bean->recipe_id = $recipe_id;
            $bean->name = $value1;
            $bean->save();
        }
        
        //道具
        $tools = isset($request->tools) ? $request->tools : [];
        
        foreach($tools as $value2){
            $tool = new Tool();
            $tool->recipe_id = $recipe_id;
            $tool->name = $value2;
            $tool->save();
        }
        
        //手順
        //$request配列から空文字を削除　array_diffで比較、""が無い配列を返し$processesを上書き
        $processes = $request->processes;
        $processes = array_diff($processes, array(""));
        $processes = array_values($processes);
        $process_num = 0;
       
        foreach($processes as $value3){
            $process_num++;
            $process = new Process();
            $process->recipe_id = $recipe_id;
            $process->process_num = $process_num;
            $process->action = $value3;
            // $process->memo = $memo;
            $process->save();
        }
        
        return redirect("/recipe/detail/$recipe_id");
        
    }
    
    public function detail($recipe_id) {
        //join でrecipeテーブルにusers,profilesテーブルの必要なカラムを結合
        $recipe = Recipe::select('recipes.*', 'users.name as user_name', 'profiles.image as user_image')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'recipes.user_id')
            ->where('recipes.id', '=', $recipe_id)->first();
        $beans = Bean::where('recipe_id', '=', $recipe_id)->get();
        $tools = Tool::where('recipe_id', '=', $recipe_id)->get();
        $processes = Process::where('recipe_id', '=', $recipe_id)
            ->orderBy('process_num', 'asc')->get(); //昇順並びに
        
        return view("/recipe/detail", compact('recipe', 'beans', 'tools', 'processes'));
    }
}
