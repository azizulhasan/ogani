@extends('layouts.backend.dashboard', ['styles' => $styles, 'scripts' => $scripts])
<x-backend.navbar/>  
@section('content')

<x-backend.header/> 
   
    
    
    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">View Order</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Deliver Date</th>
                                    <th>Order Status</th>
                                    <th>Shipping Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @if(isset($orders) && count($orders)>0)
                            @for($i = 0; $i< count($orders) ;$i++)
                            <tr>
                                    <td>{{$orders[$i]->order_id}}</td>
                                    <td>{{$orders[$i]->date_time}}</td>
                                    <td>{{$orders[$i]->delivery_date}}</td>
                                    <td>
                                    {{$orders[$i]->status_name}}
                                    </td>
                                    <td>
                                    {{  $orders[$i]->name." ".$orders[$i]->email.' '.$orders[$i]->address.' '.$orders[$i]->zip_code }}</td>
                                    <td>
                                    <button href="#" data-toggle="modal" data-target="#price_modal" data-id="{{$orders[$i]->id}}"  class="btn btn-warning btn-sm view_order_details">Details</button>
                                        <a href="#" data-id="{{$orders[$i]->id}}"   class="btn btn-danger btn-sm update_order_status">Update Status</a>
                                    
                                    </td>
                            </tr>
                            @endfor
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Deliver Date</th>
                                    <th>Order Status</th>
                                    <th>Shipping Address</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end data table  -->
        <!-- ============================================================== -->
    </div>


@endsection('content')