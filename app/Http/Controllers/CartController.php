<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\Price;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use App\Model\Discount;
use App\Model\Unit;
use App\Model\Product;
use App\Model\Review;
use App\Size;
use App\Color;
use App\Brand;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCollection;


class CartController extends Controller
{

    public function addCart(Request $request,Product $product){
        
        $product =  DB::select("select p.* , pr.*, dis.* from products p, prices pr, discounts dis where p.id=$request->id and pr.product_id= $request->id and dis.product_id=$request->id");
       

        \Cart::add(array(
            'id' => $request->id,
            'name' => $product[0]->name,
            'price' => $product[0]->price,
            'discount_percent' => $product[0]->discount_percent,
            'quantity' => 1,
        ));
        $items = \Cart::getContent();
        session(['items'=>$items]);
        $item = session()->get('items');
        return response()->json($items);

    }

    public function viewCart(Request $request){

        $items = session()->get('items');
        $subtotal = \Cart::getSubTotal();
        $total = \Cart::getTotal();
        
        // session()->flush();
        // foreach($item as $key=> $row) {
        //     echo $row->id.'<br/>'; // row ID
        //     echo $row->name.'<br/>';
        // }

        return view('front.cart')->with(['items'=> $items, 'subtotal' =>$subtotal, 'total'=> $total]);
    }



    public function updateCart(Request $request){
        $ids = explode(",",$request->ids);
        $qnts = explode(",",$request->qnts);
        print_r(count($ids));

       
        //  for($i =0; $i<=count($ids); $i++){
        //      echo $ids[$i]."<br/>";
        //  }
       

       

        
    }

    public function check_out(){
        $countries = DB::select('select * from countries');
        $cities = DB::select('select * from cities');

        $items = session()->get('items');
        $subtotal = \Cart::getSubTotal();
        $total = \Cart::getTotal();
        return view('front.check_out')->with(['items'=> $items, 'subtotal' =>$subtotal, 'total'=> $total, 'countries'=>$countries,'cities'=>$cities]);
       
    }

    public function placeOrder(Request $request){
        ///////////////////////////////////
        // if user click on create account
        ///////////////////////////////////
        if($request->account=='on' || $request->account_or =='on'){
            $userAcc =[
            'name'=> $request->first_name.' '.$request->last_name,
            'email'=> $request->email,
            'password'=>$request->password,
            'roll_id' => 4
            ];
            $id=User::insertGetId($userAcc);
        
            $userDetails=[
                'user_id' => $id,
                'country_id'=> $request->country_id,
                'city_id'   => $request->city_id,
                'address'   => $request->address,
                'zip_code'  => $request->zip_code,
                'contact'   => $request->contact,
            ];
        
            $cusDetailId= DB::table('user_details')->insertGetId($userDetails);
        }

         ///////////////////////////////////
        // Shipping Detail
        ///////////////////////////////////
            $shippingDetail=[
            'user_id' => ($request->account=='on' || $request->account_or =='on')?$id:null,
            'name'=> $request->first_name.' '.$request->last_name,
            'email'=> $request->email,
            'country_id'=> $request->country_id,
            'city_id'   => $request->city_id,
            'address'   => $request->address,
            'zip_code'  => $request->zip_code,
            'contact'   => $request->contact,
            'email'     => $request->email
            ];
            $shippingId= DB::table('shippings')->insertGetId($shippingDetail);
            
        ///////////////////////////////////
        // Put data on order Table
        ///////////////////////////////////
        date_default_timezone_set("Asia/Dhaka");
           $orders =[
            'user_id' => ($request->account=='on' || $request->account_or =='on')?$id:null,
            'date_time'=> date("Y-m-d h:i:s"),
            'delivery_date'=> null,
            'cupon_id'      => null,
            'payment_info'=> null,
            'shipping_status'=> 1,
            'shippings_id'=> $shippingId,
            'payment_method_id'=> null
           ];
        $orderId= DB::table('orders')->insertGetId($orders);
         ///////////////////////////////////
        // Put data on order detail table
        ///////////////////////////////////
       
        $items = session()->get('items');
        $subtotal = \Cart::getSubTotal();
        $total = \Cart::getTotal();
        foreach($items as $key=>$val){
            $orderDetails = [
            'order_id'=> $orderId,
            'product_id' => $key,
            'unit_price'      => $val->price,
            'quantity'   => $val->quantity,
            'vat'        => null,
            'discount'   => null
        ];
        $orderDetailId= DB::table('order_details')->insertGetId($orderDetails);
        }
        /////////////////////////////////////////////////
        // Create invoic for user printable form browser
        ////////////////////////////////////////////////
        $invoice =[
            'invoice_id' => mt_rand(1000,10000).$this->generateRandomString(5).mt_rand(111,999),
            'date_time'   => $orders['date_time'],
            'invoice_sender'=> 'Azizul Hasan',
            'invoice_sender_addr'=> "University Of Dhaka",
            'invoice_sender_email'=> "hasan@gmail.com",
            'invoice_sender_contact'=> '01855929762',
            'invoice_reciever'=> $request->first_name.' '.$request->last_name,
            'invoice_reciever_addr'=> $request->address,
            'invoice_reciever_zip_code'=> $request->zip_code,
            'invoice_reciever_email'=> $request->email,
            'invoice_reciever_contact'=> $request->contact,
        ];

        ///////////////////////////////////
        // Put Invoice infor to Invoice table
        ///////////////////////////////////

        $invoiceTable=[
            'invoice_id' => $invoice['invoice_id'],
            'date_time'   => $orders['date_time'],
            'order_id'      => $orderId,
            'shippings_id'=> $shippingId,
            'user_id' => ($request->account=='on' || $request->account_or =='on')?$id:null,
        ];
        $invoicelId= DB::table('invoices')->insertGetId($invoiceTable);
        ///////////////////////////////////
        // Pass data to Invoice page for print
        ///////////////////////////////////
        $products = $items;
        $summury = [
            'subtotal'=> $subtotal,
            'total'=> $total,
            'discount'=> null,
            'vat'=> null
        ];
        session()->flush();
        return view("front.get_pdf")->with(['products'=>$products, 'invoice'=>$invoice, 'summery'=> $summury ]);
    }
    
    protected function generateRandomString($length = 2) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
