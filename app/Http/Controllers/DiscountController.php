<?php

namespace App\Http\Controllers;

use App\Model\Discount;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = DB::select("select d.*, p.id product_id, p.name product_name from discounts d, products p where p.id = d.product_id");
        $products = DB::select('select id, name from products');

      
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/discount_add.js'];
        
        $scripts=[];
        $styles = [];
        return view('dashboard.discount_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'discounts'=>$discounts , 'products'=> $products]);
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
            'discount_percent' => ['required' ],
            'product_id' => ['required' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'discount_percent'=> $request->discount_percent,
                'product_id'=> $request->product_id,
            ];
            if($request->discount_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->discount_id]);
               Discount::where('id', $request->discount_id)->update($update_data);
               $message = session("message", "Discount Updated Successfully.");
           
            }else{
                Discount::insertGetId($data);
                $message =session("message", "Discount Created Successfully");
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discount=DB::select("select d.*, p.name product_name, p.id product_id from discounts d, products p where d.id=$id and p.id=d.product_id");
        return response()->json($discount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        if($discount->delete()){
            $status = 1;
            $message = "Discount Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
        return response()->json([ 'status'=> $status, 'message'=> $message]);
    }
}
