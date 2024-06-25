<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ShowUserController extends Controller
{
    public function show($id)
    {
        $user = User::with('posts')->findOrFail($id);
        
        return view('user.usershow', compact('user'));
    }
}
