<?php

namespace App\Http\Controllers;

use App\Model\Price;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        

        $prices = DB::select("select pr.*, p.id product_id, p.name product_name from prices pr, products p where p.id = pr.product_id");
        $products = DB::select('select id, name from products');

      
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/price_add.js'];
        
        $scripts=[];
        $styles = [];
        return view('dashboard.price_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'prices'=>$prices , 'products'=> $products]);
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
        $validator = Validator::make($request->all(), [
            'price' => ['required' ],
            'old_price' => ['required'],
            'product_id' => ['required' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'price'=> $request->price,
                'old_price'=> $request->old_price,
                'product_id'=> $request->product_id,
            ];
            if($request->price_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->price_id]);
               Price::where('id', $request->price_id)->update($update_data);
               $message = session("message", "Price Updated Successfully.");
           
            }else{
                Price::insertGetId($data);
                $message =session("message", "Price Created Successfully");
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price=DB::select("select pr.*, p.name product_name, p.id product_id from prices pr, products p where pr.id=$id and p.id=pr.product_id");
        return response()->json($price);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::find($id);
        if($price->delete()){
            $status = 1;
            $message = "Price Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
        return response()->json([ 'status'=> $status, 'message'=> $message]);
    }
}
