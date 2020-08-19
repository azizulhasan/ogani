<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\StyleScriptTrait;

class CategoryController extends Controller
{
    use StyleScriptTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/category_add.js'];
        $scripts=[];
        $styles = [];
        return view('dashboard.category_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'categories'=>$categories ]);
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
            'category_name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'category_name'=> $request->category_name,
                
            ];
            if($request->category_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->category_id]);
               Category::where('id', $request->category_id)->update($update_data);
               $message = session("message", "Category Updated Successfully.");
           
            }else{
                Category::insertGetId($data);
                $message =session("message", 'Categy Created Successfully');
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        DB::delete("delete from sub_categories where category_id=$id");
        if($category->delete()){
            $status = 1;
            $message = "Category Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
}
