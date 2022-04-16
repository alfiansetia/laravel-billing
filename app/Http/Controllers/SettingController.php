<?php

namespace App\Http\Controllers;

use App\Models\Comp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function comp()
    {
        $user = Auth::user();
        $comp = Comp::first();
        return view('setting.comp', compact(['user', 'comp']))->with('title', 'Setting Company');
    }

    
}
