<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('top/index', compact('user'));
    }
}
