<?php

namespace App\Http\Controllers;

use App\Models\NavigationMenu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        return view('pages.main.home');
    }
}
