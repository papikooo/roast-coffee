<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;

class ProfileController extends Controller
{
    public function index($id) {
        $users = User::get();
        $profiles = Profile::get();
        
        $user =  User::where('id','=', $id)->first();
        
        return view('profile/index', compact('profiles','user'));
    }
    
    public function edit($id) {
        $users = User::get();
        $profiles = Profile::get();
        
        $user =  User::where('id','=', $id)->first();
        $profile = Profile::where('user_id','=',$id)->first();
        
        return view('profile/edit', compact('profile','user'));
    }
    
    // public function update($id, Request $request) {
    //     $name = $request->name;
    //     $email = $request->email;
    //     $introduction = $request->introduction;
        
    //     $profile = Profile::where('id', '=', $id)->first();
    //     $profile->name = $name;
    //     $profile->email = $email;
    //     $profile->introduction = $introduction;
    //     $profile->save();
        
    //     return redirect('/profile');
    // }
}
