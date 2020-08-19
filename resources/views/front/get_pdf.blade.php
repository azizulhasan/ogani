@extends('layouts.front.app')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-3 offset-8">
            <button class="btn my-2" style="background:#7fad39; color:#fff; margin-left:40px;" onclick="printDiv('card_print')"><i class="fa fa-print"></i> Print Invoice</button>
            </div>
        </div>
    <div class="row">
    
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card" id="card_print">
                                <div class="card-header p-4">
                                     
                                
                                    <div class="float-right"> <h3 class="mb-0">Invoice {{$invoice['invoice_id']}}</h3>
                                    Date: {{$invoice['date_time']}}</div>
                                </div>
                                <div class="card-body">
                                   @if(isset($invoice) && count($invoice)>0)
                                   <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">From:</h5>                                            
                                            <h3 class="text-dark mb-1">{{$invoice['invoice_sender']}}</h3>
                                         
                                            <div>{{$invoice['invoice_sender_addr']}}</div>
                                            <div>Email: {{$invoice['invoice_sender_email']}}</div>
                                            <div>Phone: {{$invoice['invoice_sender_contact']}}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">To:</h5>
                                            <h3 class="text-dark mb-1">{{$invoice['invoice_reciever']}}</h3>                                            
                                            <div>{{$invoice['invoice_reciever_addr']}}</div>
                                            <div>{{$invoice['invoice_reciever_zip_code']}}</div>
                                            <div>Email: {{$invoice['invoice_reciever_email']}}</div>
                                            <div>Phone: {{$invoice['invoice_reciever_contact']}}</div>
                                        </div>
                                    </div>
                                   @endif
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sereil No.</th>
                                                    <th>Item</th>
                                                    <th>Description</th>
                                                    <th class="right">Unit Cost</th>
                                                    <th class="center">Qty</th>
                                                    <th class="right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($products) && count($products)>0)
                                                @foreach($products as $product)
                                                <tr>
                                                    <td class="center">{{1}}</td>
                                                    <td class="left strong">{{$product->name}}</td>
                                                    <td class="left">{{''}}</td>
                                                    <td class="right">{{$product->price}}</td>
                                                    <td class="center">{{$product->quantity}}</td>
                                                    <td class="right">{{$product->price*$product->quantity}}</td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td><h1>Your Cart Is Empty.</h1></td>
                                                </tr>
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-5">
                                        </div>
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                @if(isset($summery) && count($summery)>0)
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Subtotal</strong>
                                                        </td>
                                                        <td class="right">
                                                            {{$summery['subtotal']}}
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Discount (5%)</strong>
                                                        </td>
                                                        <td class="right">{{$summery['discount']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">VAT (2%)</strong>
                                                        </td>
                                                        <td class="right">{{$summery['vat']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark">{{$summery['total']}}</strong>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <p class="mb-0">University of Dhaka , Dhaka, 1000</p>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
</section>
<script>
    function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
</script>
@endsection('content')