<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/brand_add.js'];
       
        $scripts=[];
        $styles = [];
        return view('dashboard.brand_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'brands'=>$brands ]);
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
            'brand_name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'brand_name'=> $request->brand_name,
                
            ];
            if($request->brand_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->brand_id]);
               Brand::where('id', $request->brand_id)->update($update_data);
               $message = session("message", "Brand Updated Successfully.");
           
            }else{
                Brand::insertGetId($data);
                $message =session("message", 'Brand Created Successfully');
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand->delete()){
            $status = 1;
            $message = "Brand Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
}
