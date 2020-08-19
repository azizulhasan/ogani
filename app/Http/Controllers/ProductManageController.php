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


class ProductManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        
        
        $products = DB::select("select p.* , c.id cId, c.category_name, sc.id scId, 
        sc.sub_category_name, br.id brId, br.brand_name, un.id unId, un.unit_name,us.id usId, us.name usName, us.email, pr.price, pr.old_price, dis.discount_percent from products p, categories c, sub_categories sc, brands br, units un, users us, prices pr, discounts dis  where p.category_id=c.id and p.sub_category_id=sc.id and  p.brand_id=br.id and  p.unit_id=un.id and p.user_id=$user->id and p.id=pr.product_id and p.id=dis.product_id  order by id desc");
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::all();
        
        $arr2 = [
            
            '1'=> 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
            '2'=> 'assets/backend/assets/libs/js/product_add.js',
        ];
        $scripts=[];
        $styles = [];
        ['1'=> 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'];
        return view('dashboard.product_add')->with(['styles'=>$styles, 'scripts'=> $arr2 , 'products'=> $products, 'categories'=>$categories, 'sub_categories'=>$sub_categories, 'units'=> $units,'sizes'=>$sizes,'colors'=>$colors,'brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{

            
                $default_picture =  $request->file('default_picture')->getClientOriginalName();
                $default_picture =  time().'_'.$this->generateRandomString(10)."_".$default_picture;
                $request->default_picture->storeAs('products/default_picture' , $default_picture , 'public' );

                


                // picture1
                $picture1 =  $request->upload_file[0]->getClientOriginalName();
                $picture1=  time().'_'.$this->generateRandomString(10)."_".$picture1;

                $request->file('default_picture')->storeAs('products/gallery' , $picture1 , 'public' );
                

                // picture2
                $picture2 =  $request->upload_file[1]->getClientOriginalName();
                $picture2=  time().'_'.$this->generateRandomString(10)."_".$picture2;
                $request->upload_file[1]->storeAs('products/gallery' , $picture2 , 'public' );


                // picture3
                $picture3 =  $request->upload_file[2]->getClientOriginalName();
                $picture3=  time().'_'.$this->generateRandomString(10)."_".$picture3;
                $request->upload_file[2]->storeAs('products/gallery' , $picture3 , 'public' );

                // picture4
                $picture4 =  $request->upload_file[3]->getClientOriginalName();
                $picture4=  time().'_'.$this->generateRandomString(10)."_".$picture4;
                $request->upload_file[3]->storeAs('products/gallery' , $picture4 , 'public' );
            
            // dd($request->all());
            $data =[
                'name'              => $request->name,
                'detail'            =>  $request->detail,
                'category_id'       => $request->category_id,
                'sub_category_id'   => $request->sub_category_id,
                'unit_id'           => $request->unit_id,
                'brand_id'          => $request->brand_id,
                'size_id'           => $request->size_id,
                'color_id'          => $request->color_id,
                'user_id'           => $user->id,
                'default_picture'   => $default_picture,
                'picture1'          => $picture1,
                'picture2'          => $picture2,
                'picture3'          => $picture3,
                'picture4'          => $picture4,
            ];
            $id = Product::insertGetId($data);
            $price = [
                'price'=> $request->price,
                'old_price'=> $request->old_price,
                'product_id'=> $id
            ];
            Price::insertGetId($price);
            $discount=[
                'discount_percent'=> $request->discount_percent,
                'product_id'=> $id
            ];
            Discount::insertGetId($discount);

            if($id !=""){
                $message =session("message", "Product Created Successfully");
            return redirect()->back()->with(['status'=>$message ]);
            }else{

                $message =session("message", "Somthing Went Wrong");
            return redirect()->back()->with(['status'=>$message ]);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        return response()->json(['ida'=> 'put']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $this->defaultPicture($id);
        $this->deleteGalleryImage($id);
        
        if($product->delete()){
            $status = 1;
            $message = "Product Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }

    public function getSubCategory($id){

        $sub_categories = SubCategory::where(['category_id'=> $id])->get();
        return response()->json($sub_categories);
    }
    protected function defaultPicture($id){
        if($id !=""){
            $product =Product::find($id);
            Storage::delete('/public/products/default_picture/'.$product->default_picture);
            
        }
    }

    protected function deleteGalleryImage($id){
        if($id !=""){
            $product =Product::find($id);
            for($i=1; $i<5; $i++){
            $picture ="picture".$i;
            Storage::delete('/public/products/gallery/'.$product->$picture); 
            }
        }
    }
    protected function generateRandomString($length = 2) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
