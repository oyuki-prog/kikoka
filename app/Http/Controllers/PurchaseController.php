<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchase() {
        return view('purchase');
    }

    public function buy(Request $request) {
        $user = User::find(Auth::id());
        $user->coin += $request->coin;
        $user->save();

        return redirect()->route('questions.index')->with('message', "{$request->coin}コインを購入しました");
    }
}
