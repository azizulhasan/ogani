<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\Price;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use App\Model\Discount;
use App\Model\Unit;
use App\Model\Product;
use App\Model\Review;
use App\Size;
use App\Color;
use App\Brand;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function index(){

        $products = DB::select("select p.* , c.id cId, c.category_name, sc.id scId, 
        sc.sub_category_name, br.id brId, br.brand_name, un.id unId, un.unit_name, pr.price, pr.old_price, dis.discount_percent from products p, categories c, sub_categories sc, brands br, units un, prices pr, discounts dis  where p.category_id=c.id and p.sub_category_id=sc.id and  p.brand_id=br.id and  p.unit_id=un.id and p.id=pr.product_id and p.id=dis.product_id  order by id desc");
        $items = session()->get('items');
        return view("front.index")->with(['products'=> $products, 'items'=>$items]);
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
      
    public function product_detail($id){
        // $product = DB::select("select p.* , c.id cId, c.category_name, sc.id scId, 
        // sc.sub_category_name, br.id brId, br.brand_name, un.id unId, un.unit_name from products p, categories c, sub_categories sc, brands br, units un, users us  where p.category_id=c.id and p.sub_category_id=sc.id and  p.brand_id=br.id and  p.unit_id=un.id and p.id=$id ");

        $product = DB::select("select p.* , c.id cId, c.category_name, sc.id scId, 
        sc.sub_category_name, br.id brId, br.brand_name, un.id unId, un.unit_name, pr.price, pr.old_price, dis.discount_percent from products p, categories c, sub_categories sc, brands br, units un, prices pr, discounts dis  where p.category_id=c.id and p.sub_category_id=sc.id and  p.brand_id=br.id and  p.unit_id=un.id and p.id=pr.product_id and p.id=dis.product_id and p.id=$id");
        
        return view("front.product_detail")->with('product', $product);
    }
    public function cart(){
        return view("front.cart");
    }
    
    


  
}
