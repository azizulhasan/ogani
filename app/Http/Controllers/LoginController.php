<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('backend.login');
    }
    public function login(){
        // return view('backend.login');
        echo "yes";
    }
}
