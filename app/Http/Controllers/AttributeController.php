<?php

namespace App\Http\Controllers;

use App\Model\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\StyleScriptTrait;
class AttributeController extends Controller
{
    use StyleScriptTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();
        $arr =  $this->styleScriptAdd('scripts');
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/attribute_add.js'];
        $arr3 = array_merge( $arr, $arr2);
        $scripts=[];
        $styles = [];
        return view('dashboard.attribute_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'attributes'=>$attributes ]);
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
            'attribute_name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'attribute_name'=> $request->attribute_name,
                
            ];
            if($request->attribute_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->attribute_id]);
               Attribute::where('id', $request->attribute_id)->update($update_data);
               $message = session("message", "Attribute Updated Successfully.");
           
            }else{
                Attribute::insertGetId($data);
                $message =session("message", 'Attriubte Created Successfully');
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::find($id);
        return response()->json($attribute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        if($attribute->delete()){
            $status = 1;
            $message = "Attribute Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
}
