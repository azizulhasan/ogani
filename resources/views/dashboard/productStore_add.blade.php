@extends('layouts.backend.dashboard', ['styles' => $styles, 'scripts' => $scripts])
<x-backend.navbar/>  
@section('content')

<x-backend.header/> 
   
    
    
    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <x-backend.alert-html/> 
            <div class="card">
                <div class="card-header">
                    <button id="productStore_add" class="" 
                    style="background-color:#110E2A;
                    color:#fff;
                    padding:7px;
                    border:0;
                    border-radius:3px;
                    cursor:pointer;

                    "  data-toggle="modal" data-target="#productStore_modal">
                    Add Product Store</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Purchase Date</th>
                                    <th>Reference No</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(isset($stores) && count($stores)>0)
                                @foreach($stores as $store)
                                <tr>
                                    <td>{{$store->id}}</td>
                                    <td>{{$store->pName}}</td>
                                    <td>{{$store->date}}</td>
                                    <td>{{$store->reference_no}}</td>
                                    <td>{{$store->quantity}}</td>
                                    <td>{{$store->parchase_rate}}</td>
                                    <td>
                                        <button href="#" data-toggle="modal" data-target="#productStore_modal" data-id="{{$store->id}}"  class="btn btn-warning btn-sm edit_productStore">Edit</button>
                                        <a href="#" data-id="{{$store->id}}"   class="btn btn-danger btn-sm delete_productStore">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Purchase Date</th>
                                    <th>Reference No</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
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

    <!-- Modal -->
    <div class="modal fade " id="productStore_modal" tabindex="-1" role="dialog" aria-labelledby="addProductStore" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addProductStore">Add Product Store</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="validationform" method="post" action="{{url('dashboard/productStore')}}" data-parsley-validate="" enctype="multipart/form-data" novalidate="">
                @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <select  name="product_id" id="product_id" class="form-control">
                                <option value="0">Select Product</option>
                                @if(isset($products))
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->id}} - {{$product->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                        <input type="text" hidden value="" id="productStore_id" name="productStore_id">
                        <input type="text" hidden value="" id="purchase_id" name="purchase_id">
                        <input type="date" id="date" name="date" required=""  autofocus class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="number" id="quantity" name="quantity" required="" autocomplete="off"  placeholder="Quantity" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="number" id="parchase_rate" name="parchase_rate" required="" autocomplete="off"  placeholder="Per Unit Price" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="text" id="reference_no" name="reference_no" required="" autocomplete="off"  placeholder="Reference No" class="form-control">
                        </div>
                    </div>      
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btn_save" class="btn btn-primary">Save</button> 
        </div>
        </form>    
        </div>
    </div>
    </div>
    <x-backend.alert-script/> 
    
@endsection('content')