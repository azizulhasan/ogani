<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\StyleScriptTrait;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    use StyleScriptTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = DB::select('select ord.id order_id, ord.date_time, ord.delivery_date, ord.shipping_status, st.status_name , shipd.id shipping_id, shipd.* from orders ord,  status st, shippings shipd where  st.id=ord.shipping_status and shipd.id=ord.shippings_id');
        // dd($orders);

        $details = DB::select('select ordtl.*, ord.date_time order_date, ord.delivery_date, ord.shipping_status  from order_details ordtl , orders ord  where ord.id =ordtl.order_id');
        

        $status = DB::select('select * from status');
        $countries = DB::select('select * from countries');
        $cities     = DB::select('select * from cities');
        
        return view('dashboard.order_view')->with(['styles'=>$this->styleScriptAdd('styles'), 'scripts'=> $this->styleScriptAdd('scripts'), 'orders'=>$orders, 'details'=> $details, 'status'=> $status ]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
