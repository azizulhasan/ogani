<?php

namespace App\Http\Controllers;

use App\Model\SubCategory;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\StyleScriptTrait;

class SubCategoryController extends Controller
{
    use StyleScriptTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        

        $sub_categories = DB::select("select sc.*, c.category_name, c.id category_id from sub_categories sc, categories c where sc.category_id=c.id");
        $categories = Category::all();
        $arr =  $this->styleScriptAdd('scripts');
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/sub_category_add.js'];
        $arr3 = array_merge( $arr, $arr2);
        $scripts=[];
        $styles = [];
        return view('dashboard.sub_category_add')->with(['styles'=>$styles, 'scripts'=> $arr2 ,  'sub_categories'=>$sub_categories , 'categories'=> $categories]);
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
            'sub_category_name' => ['required', 'max:255' ],
            
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $data =[
                'sub_category_name'=> $request->sub_category_name,
                'category_id'=> $request->category_id,
            ];
            if($request->sub_category_id !=''){
               $update_data =  array_merge($data, ['id'=> $request->sub_category_id]);
               SubCategory::where('id', $request->sub_category_id)->update($update_data);
               $message = session("message", "Sub Category Updated Successfully.");
           
            }else{
                SubCategory::insertGetId($data);
                $message =session("message", "Sub Category Created Successfully");
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_category=DB::select("select sc.*, c.category_name, c.id category_id from sub_categories sc, categories c where sc.id=$id and sc.category_id=c.id");
        return response()->json($sub_category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::find($id);
        if($sub_category->delete()){
            $status = 1;
            $message = "Sub Category Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
        return response()->json([ 'status'=> $status, 'message'=> $message]);
    }
}
