<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index($id) {
        $user =  User::where('id','=', $id)->first();
        $profile = Profile::where('user_id','=',$id)->first();
        
        return view('profile/index', compact('profile','user'));
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
        
        $name = $request->name;
        $email = $request->email;
        $introduction = $request->introduction;
        
        $user =  User::where('id','=', $id)->first();
        $profile = Profile::where('user_id', '=', $id)->first();
        
        $user->name = $name;
        $user->email = $email;
        $profile->introduction = $introduction;
        $user->save();
        $profile->save();
        
        return redirect("/profile/$id");
    }
}