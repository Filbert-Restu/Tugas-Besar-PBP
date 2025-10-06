<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // index user
    public function index()
    {
        $user = Auth::user();
        return view('user.index', compact('user'));
    }

}
