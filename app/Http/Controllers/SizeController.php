<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all();
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/size_add.js'];
        $scripts=[];
        $styles = [];
        return view('dashboard.size_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'sizes'=>$sizes ]);
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
            'size_name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'size_name'=> $request->size_name,
                
            ];
            if($request->size_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->size_id]);
               Size::where('id', $request->size_id)->update($update_data);
               $message = session("message", "Size Updated Successfully.");
           
            }else{
                Size::insertGetId($data);
                $message =session("message", 'Size Created Successfully');
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::find($id);
        return response()->json($size);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        if($size->delete()){
            $status = 1;
            $message = "Size Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
}
