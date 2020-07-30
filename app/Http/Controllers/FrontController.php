<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view("front.index");
    }
    public function shop(){
        return view("front.shop");
    }
    public function blog(){
        return view("front.blog");
    }
    public function contact(){
        return view("front.contact");
    }
    public function single_blog(){
        return view("front.single_blog");
    }
      
    public function product_detail(){
        return view("front.product_detail");
    }
    public function cart(){
        return view("front.cart");
    }
    public function check_out(){
        return view("front.check_out");
    }
}
