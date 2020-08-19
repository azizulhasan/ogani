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
                    <button id="sub_category_add" class="" 
                    style="background-color:#110E2A;
                    color:#fff;
                    padding:7px;
                    border:0;
                    border-radius:3px;
                    cursor:pointer;

                    "  data-toggle="modal" data-target="#sub_category_modal">
                    New Sub Category</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($sub_categories) && count($sub_categories)>0)
                                @for($i = 0; $i< count($sub_categories) ;$i++)
                                <tr>
                                    <td>{{$sub_categories[$i]->id}}</td>
                                    <td>{{$sub_categories[$i]->sub_category_name}}</td>
                                    <td>{{$sub_categories[$i]->category_name}}</td>
                                    <td>
                                        <button href="#" data-toggle="modal" data-target="#sub_category_modal" data-id="{{$sub_categories[$i]->id}}"  class="btn btn-warning btn-sm edit_sub_category">Edit</button>
                                        <a href="#" data-id="{{$sub_categories[$i]->id}}"   class="btn btn-danger btn-sm delete_sub_category">Delete</a>
                                    </td>
                                </tr>
                                @endfor
                                @endif
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
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
    <div class="modal fade " id="sub_category_modal" tabindex="-1" role="dialog" aria-labelledby="addNewSubCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewSubCategory">Add New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="validationform" method="post" action="{{url('dashboard/sub_categories')}}" data-parsley-validate="" enctype="multipart/form-data" novalidate="">
                @csrf
                    <div class="form-group row">
                        <div class="col-12">
                        <input type="text" hidden value="" id="sub_category_id" name="sub_category_id">
                        <input type="text" id="sub_category_name" name="sub_category_name" required="" placeholder="Sub Category Name" autofocus class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                        <select name="category_id" class="form-control" id="category_id">
                            <option value="0">Select Category</option>
                            @if(isset($categories) && count($categories)> 0)
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
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