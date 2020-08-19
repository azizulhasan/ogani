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
                    <button id="discount_add" class="" 
                    style="background-color:#110E2A;
                    color:#fff;
                    padding:7px;
                    border:0;
                    border-radius:3px;
                    cursor:pointer;

                    "  data-toggle="modal" data-target="#discount_modal">
                    New Discount %</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Discount %</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($discounts) && count($discounts)>0)
                                @for($i = 0; $i< count($discounts) ;$i++)
                                <tr>
                                    <td>{{$discounts[$i]->id}}</td>
                                    <td>{{$discounts[$i]->product_id}}</td>
                                    <td>{{$discounts[$i]->product_name}}</td>
                                    <td>{{$discounts[$i]->discount_percent}}</td>
                                    <td>
                                        <button href="#" data-toggle="modal" data-target="#discount_modal" data-id="{{$discounts[$i]->id}}"  class="btn btn-warning btn-sm edit_discount">Edit</button>
                                        <a href="#" data-id="{{$discounts[$i]->id}}"   class="btn btn-danger btn-sm delete_discount">Delete</a>
                                    </td>
                                </tr>
                                @endfor
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Id</th>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Discount %</th>
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
    <div class="modal fade " id="discount_modal" tabindex="-1" role="dialog" aria-labelledby="addNewDiscount" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewDiscount">Add Discount %</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="validationform" method="post" action="{{url('dashboard/discounts')}}" data-parsley-validate="" enctype="multipart/form-data" novalidate="">
                @csrf
                    <div class="form-group row">
                        <div class="col-12">
                        <input type="text" hidden value="" id="discount_id" name="discount_id">
                        <input type="number" id="discount_percent" name="discount_percent" required="" placeholder="Discount Percent" autofocus class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                        <select name="product_id" class="form-control" id="product_id">
                            <option value="0">Select Category</option>
                            @if(isset($products) && count($products)> 0)
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->id}} - {{$product->name}} </option>
                            @endforeach
                            @endif
                        </select>
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