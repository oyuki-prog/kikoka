<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user)
    {
        $questions = $user->questions()->where('user_id', Auth::id())->get();
        return view('user', compact(['user', 'questions']));
    }
}
