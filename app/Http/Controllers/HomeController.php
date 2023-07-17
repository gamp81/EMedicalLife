<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('tablero');
    }
    public function about() {
        return view('without');
    }
}
