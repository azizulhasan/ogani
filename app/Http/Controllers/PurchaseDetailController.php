<?php

namespace App\Http\Controllers;

use App\Model\PurchaseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Price;
use App\Model\Product;
use App\Model\Purchase;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productStore = auth()->user();
        $stores = DB::select("select pd.*, p.name pName ,  pur.date , pur.reference_no from purchase_details pd, products p, purchases pur where pd.product_id=p.id and pd.purchase_id=pur.id");

        // dd($stores);

        $products = Product::all();
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/productStore_add.js'];
        $scripts=[];
        $styles = [];
        return view('dashboard.productStore_add')->with(['styles'=>$styles, 'scripts'=> $arr2 , 'products'=> $products, 'stores'=>$stores]);
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
            'date' => ['required' ],
            'reference_no' => ['required',],
            'parchase_rate' => ['required'],
            'quantity' => 'required',
            'product_id' => 'required'
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            
            $puschase =[
                'date'=> $request->date,
                'reference_no' => $request->reference_no,
            ];
           
            $purchaseDetail =[
                'parchase_rate' => $request->parchase_rate,
                'quantity'=> $request->quantity,
                'product_id'=> $request->product_id
            ];
            
            
            if($request->productStore_id !=''){

                Purchase::where('id', $request->purchase_id)->update($puschase);
                
                
               $purchaseDetail =  array_merge($purchaseDetail, ['id'=> $request->productStore_id, 'purchase_id'=> $request->purchase_id]);
               PurchaseDetail::where('id', $request->productStore_id)->update($purchaseDetail);


               $message = session("message", "Store Updated Successfully.");
            }else{
                $purchaseId = Purchase::insertGetId($puschase);
                $detail = array_merge($purchaseDetail, ['purchase_id' => $purchaseId]);
                PurchaseDetail::insertGetId($detail);
                $message =session("message", "Store Created Successfully");
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productStore = PurchaseDetail::find($id);
        $purchase = Purchase::find($productStore->purchase_id);
        return response()->json(['purchaseDetail'=> $productStore, 'purchase'=> $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productStore = PurchaseDetail::find($id);
        $purchase = Purchase::find($productStore->purchase_id);
        $purchase->delete();
        if($productStore->delete()){
            $status = 1;
            $message = "Store Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
}
