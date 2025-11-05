<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function blogs()
    {
        return view('blogs');
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }
}