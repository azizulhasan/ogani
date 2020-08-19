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
                    <button id="category_add" class="" 
                    style="background-color:#110E2A;
                    color:#fff;
                    padding:7px;
                    border:0;
                    border-radius:3px;
                    cursor:pointer;

                    "  data-toggle="modal" data-target="#category_modal">
                    New Category</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(isset($categories) && count($categories)>0)
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        <button href="#" data-toggle="modal" data-target="#category_modal" data-id="{{$category->id}}"  class="btn btn-warning btn-sm edit_category">Edit</button>
                                        <a href="#" data-id="{{$category->id}}"   class="btn btn-danger btn-sm delete_category">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
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
    <div class="modal fade " id="category_modal" tabindex="-1" role="dialog" aria-labelledby="addNewCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewCategory">Add New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="validationform" method="post" action="{{url('dashboard/categories')}}" data-parsley-validate="" enctype="multipart/form-data" novalidate="">
                @csrf
                    <div class="form-group row">
                        <div class="col-12">
                        <input type="text" hidden value="" id="category_id" name="category_id">
                        <input type="text" id="category_name" name="category_name" required="" placeholder="Unit Name" autofocus class="form-control">
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