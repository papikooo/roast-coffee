<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Recipe;
use App\Bean;
use App\Tool;
use App\Process;
use App\Favorite;
use App\Report;
use App\RecipeHistory;

class RecipeController extends Controller
{
    public function index(Request $request) {
        $user = auth()->user();
        $keywords = $request->keyword;
        
        $query = Recipe::query();
        $query->select('recipes.id')
                ->leftJoin('beans', 'recipes.id', '=', 'beans.recipe_id')
                ->leftJoin('tools', 'recipes.id', '=', 'tools.recipe_id')
                ->where('recipes.public_status', '=', 1);
    
        if(!empty($keywords)){
            $keywords = trim($keywords);
            $keywords = str_replace("　", " ", $keywords);
            $keywords = explode(" ", $keywords);
            foreach($keywords as $keyword){
                $query->orWhere('recipes.name','like','%'.$keyword.'%')
                ->orWhere('recipes.introduction','like','%'.$keyword.'%')
                ->orWhere('recipes.time','like','%'.$keyword.'%')
                ->orWhere('beans.name','=', $keyword )
                ->orWhere('tools.name','=', $keyword );
            }
        }
        
        $query->groupBy('recipes.id');
 
        $recipes = $query->orderBy('recipes.created_at','desc')->paginate(10);
        $recipe_details = Recipe::whereIn('id', $recipes->modelKeys())->get();
        $recipe_beans = Bean::whereIn('recipe_id', $recipes->modelKeys())->get();
        
        foreach($recipes as $recipe){
            $recipe->detail = $recipe_details->find($recipe->id);
            $recipe->beans = $recipe_beans->filter(function($bean, $key)use($recipe) {
                return $bean->recipe_id == $recipe->id;
            });
        }
        
        return view('recipe/index', compact('recipes','keywords'));
    }
    
    // public function search() {
        
    //     return view('recipe/result', compact('recipes'));
    // }
    
    public function create() {
        return view('recipe/create');
    }
    
    public function store(Request $request) {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' =>['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        //     'introduction' => 'max:500'
        // ]);
        
        //画像
        $image = $request->file('image');
        $thumbnail = null;
        if(isset($image)){
            $path = Storage::disk('s3')->putFile('recipe', $image, 'public');
            $thumbnail = Storage::disk('s3')->url($path);
        }
        
        //レシピ登録
        $user_id = auth()->id();
        $name = $request->name;
        $introduction = $request->introduction;
        $time = $request->time;
        $public_status = $request->public_status;
        if($public_status == 2){
            $public_status = 2;
            }else{
                $public_status = 1;
                }
        
        $recipe = new Recipe();
        
        $recipe->user_id = $user_id;
        $recipe->name = $name;
        $recipe->introduction = $introduction;
        $recipe->time = $time;
        $recipe->thumbnail = $thumbnail;
        $recipe->public_status = $public_status;
        $recipe->save();
        
        $recipe_id = $recipe->id;
        
        //豆
        $beans = isset($request->beans) ? $request->beans : [];
            
        foreach($beans as $value){
            $bean = new Bean();
            $bean->recipe_id = $recipe_id;
            $bean->name = $value;
            $bean->save();
        }
        
        //道具
        $tools = isset($request->tools) ? $request->tools : [];
        
        foreach($tools as $value){
            $tool = new Tool();
            $tool->recipe_id = $recipe_id;
            $tool->name = $value;
            $tool->save();
        }
        
        //手順
        //$request配列から空文字を削除　array_diffで比較、""が無い配列を返し$processesを上書き
        $processes = $request->processes;
        $processes = array_diff($processes, array(""));
        $processes = array_values($processes);
        $process_num = 0;
        
        $memo = $request->memos;
        
        foreach($processes as $key => $value){
            $process_num++;
            $process = new Process();
            $process->recipe_id = $recipe_id;
            $process->process_num = $process_num;
            $process->action = $value;
            $process->memo = $memo[$key];
            $process->save();
        }
        
        
        return redirect("/recipe/detail/$recipe_id");
        
    }
    
    public function detail($recipe_id) {
        $user_id = auth()->id();
        RecipeHistory::where('recipe_id', '=', $recipe_id)
            ->where('user_id', '=', $user_id)->delete();
        $history = new RecipeHistory();
        $history->user_id = $user_id;
        $history->recipe_id = $recipe_id;
        $history->save();
        
        //join でrecipeテーブルにusers,profilesテーブルの必要なカラムを結合
        $recipe = Recipe::select('recipes.*', 'users.name as user_name', 'profiles.image as user_image')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'recipes.user_id')
            ->where('recipes.id', '=', $recipe_id)->first();
        $beans = Bean::where('recipe_id', '=', $recipe_id)->get();
        $tools = Tool::where('recipe_id', '=', $recipe_id)->get();
        $processes = Process::where('recipe_id', '=', $recipe_id)
            ->orderBy('process_num', 'asc')->get(); //昇順並びに
        $favorite = Favorite::where('recipe_id', '=', $recipe_id)
                            ->where('user_id', '=', $user_id)->first();
        $reports = Report::select('reports.*', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->where('recipe_id', '=', $recipe_id)->get();
        
        if($recipe->public_status == 2 && auth()->id() != $recipe->user_id){
            abort(404);    
        }
        return view("/recipe/detail", compact('recipe', 'beans', 'tools', 'processes', 'favorite', 'reports'));
    }
    
    public function edit($recipe_id) {
        $recipe = Recipe::where('recipes.id', "=", $recipe_id)->first();
        $beans = Bean::where('recipe_id', '=', $recipe_id)->get();
        $tools = Tool::where('recipe_id', '=', $recipe_id)->get();
        $processes = Process::where('recipe_id', '=', $recipe_id)
            ->orderBy('process_num', 'asc')->get();

        return view('recipe/edit', compact('recipe', 'beans', 'tools', 'processes'));
    }
    
    public function update(Request $request, $recipe_id) {
        //レシピ登録
        $user_id = auth()->id();
        $name = $request->name;
        $introduction = $request->introduction;
        $time = $request->time;
        $public_status = $request->public_status;
        if($public_status == 2){
            $public_status = 2;
        }else{
            $public_status = 1;
        }
        
        $recipe = Recipe::where('recipes.id', "=", $recipe_id)->first();
        
        $image = $request->file('image');
        $thumbnail = null;
        if(isset($image)){
            $path = Storage::disk('s3')->putFile('recipe', $image, 'public');
            $thumbnail = Storage::disk('s3')->url($path);
            $recipe->thumbnail = $thumbnail;
        }
        
        $recipe->name = $name;
        $recipe->introduction = $introduction;
        $recipe->time = $time;
        $recipe->public_status = $public_status;
        $recipe->save();
        
        $recipe_id = $recipe->id;
        
        //豆
        $beans = isset($request->beans) ? $request->beans : [];
        Bean::where('recipe_id', '=', $recipe_id)->delete();
            
        foreach($beans as $value){
            $bean = new Bean();
            $bean->recipe_id = $recipe_id;
            $bean->name = $value;
            $bean->save();
        }
        
        //道具
        $tools = isset($request->tools) ? $request->tools : [];
        Tool::where('recipe_id', '=', $recipe_id)->delete();
        
        foreach($tools as $value){
            $tool = new Tool();
            $tool->recipe_id = $recipe_id;
            $tool->name = $value;
            $tool->save();
        }
        
        //手順
        //$request配列から空文字を削除　array_diffで比較、""が無い配列を返し$processesを上書き
        Process::where('recipe_id', '=', $recipe_id)->delete();
            
        $processes = $request->processes;
        $processes = array_diff($processes, array(""));
        $processes = array_values($processes);
        $process_num = 0;
        
        
        $memo = $request->memos;
        
        foreach($processes as $key => $value){
            $process_num++;
            $process = new Process();
            $process->recipe_id = $recipe_id;
            $process->process_num = $process_num;
            $process->action = $value;
            $process->memo = $memo[$key];
            $process->save();
        }
        
        return redirect("/recipe/detail/$recipe_id");
    }
    
    //レポート
    public function report(Request $request, $recipe_id) {
        $user_id = auth()->id();
        $comment = $request->comment;
        
        $report = new Report();
        
        $report->user_id = $user_id;
        $report->recipe_id = $recipe_id;
        $report->comment = $comment;
        $report->save();
        
        return redirect("/recipe/detail/$recipe_id");
    }
    
}
