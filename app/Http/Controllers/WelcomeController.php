<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $hotToday = Menu::where('is_hot_today', true)->where('status', 'active')->take(6)->get();
        return view('welcome', compact('hotToday'));
    }
}
