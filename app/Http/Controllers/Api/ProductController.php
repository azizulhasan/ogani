<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Review;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response;
class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except("index", "show");
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        return ProductResource::collection(Product::all());
        // return ProductCollection::collection(Product::paginate(10));

        // return view('dashboard.index');

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
    public function store(ProductRequest $request)
    {

        $product= [
            'name'      => $request->name,
            'detail'    => $request->detail,
            'price'     => $request->price,
            'stock'     => $request->stock,
            'discount'  => $request->discount,

        ];
        $id = Product::insertGetId($product);
        $product = Product::find($id);
        return response([
            'data'=> new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return $product;
        return new ProductResource($product);
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
    public function update(ProductRequest $request, $id)
    {
        $product= [
            'name'      => $request->name,
            'detail'    => $request->detail,
            'price'     => $request->price,
            'stock'     => $request->stock,
            'discount'  => $request->discount,

        ];
        
        $status = Product::where(['id'=> $id])->update($product);
        $updated_product = ($status=='1')?Product::find($id):"Something Went Wrong";
        
        // $product = Product::find($id);
        return response([
            'data'=> new ProductResource($updated_product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // return $product;
        $product->delete();
        return response([
            'data'=> "data deleted successfully"
        ], Response::HTTP_NO_CONTENT);
    }
}
