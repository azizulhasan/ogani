<?php

namespace App\Http\Controllers;

use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\StyleScriptTrait;
class UnitController extends Controller
{
    use StyleScriptTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        $arr =  $this->styleScriptAdd('scripts');
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/unit_add.js'];
        $arr3 = array_merge( $arr, $arr2);
        $scripts=[];
        $styles = [];
        return view('dashboard.unit_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'units'=>$units ]);
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
            'unit_name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'unit_name'=> $request->unit_name,
                
            ];
            if($request->unit_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->unit_id]);
               Unit::where('id', $request->unit_id)->update($update_data);
               $message = session("message", "Unit Updated Successfully.");
           
            }else{
                Unit::insertGetId($data);
                $message =session("message", 'Unit Created Successfully');
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::find($id);
    //    echo $unit;
        return response()->json($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        if($unit->delete()){
            $status = 1;
            $message = "Unit Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
}
