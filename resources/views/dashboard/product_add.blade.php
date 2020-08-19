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
                    <button id="product_add" class="" 
                    style="background-color:#110E2A;
                    color:#fff;
                    padding:7px;
                    border:0;
                    border-radius:3px;
                    cursor:pointer;

                    "  data-toggle="modal" data-target="#product_modal">
                    New Product</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Unit Name</th>
                                    <th>Brand Name</th>
                                    <th>Price</th>
                                    <th>Old Price</th>
                                    <th>Discount %</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 
                            @if(isset($products) && count($products)>0)
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        <img width="70" src="{{asset('storage/products/default_picture/'. $product->default_picture)}}" alt="{{$product->name}}">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category_name}}</td>
                                    <td>{{$product->sub_category_name}}</td>
                                    <td>{{$product->unit_name}}</td>
                                    <td>{{$product->brand_name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->old_price}}</td>
                                    <td>{{$product->discount_percent}}</td>
                                    <td>
                                        <button href="#" data-toggle="modal" data-target="#product_edit_modal" data-id="{{$product->id}}"  class="btn btn-warning btn-sm edit_product"><i class="fas fa fa-edit"></i></button>
                                        <button href="#" data-id="{{$product->id}}"   class="btn btn-danger btn-sm delete_product"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Unit Name</th>
                                    <th>Brand Name</th>
                                    <th>Price</th>
                                    <th>Old Price</th>
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
<div class="modal fade " id="product_modal" tabindex="-1" role="dialog" aria-labelledby="productEditModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="validationform" method='post' enctype="multipart/form-data" action="{{url('dashboard/products')}}" data-parsley-validate="" novalidate="">

                @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="text"  name="name" required="" placeholder="Product Title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <input type="number"  name="price" required="" placeholder="Product Price" class="form-control">
                        </div>
                        <div class="col-4">
                            <input type="number"  name="old_price" required="" placeholder="Product Old Price" class="form-control">
                        </div>
                        <div class="col-4">
                            <input type="number"  name="discount_percent" required="" placeholder="Discount Percent" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <textarea name="detail" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <select name="category_id" id="category_id"  class="form-control">
                                <option value="0">Select Category</option>
                                @if(isset($categories) && count($categories)> 0)
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- sub category -->
                        <div class="col-3">
                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                            <option value="">Select Sub Category</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="unit_id"  class="form-control">
                                <option value="0">Select Unit</option>
                                @if(isset($units) && count($units)> 0)
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="brand_id"  class="form-control">
                                <option value="0">Select Brand</option>
                                @if(isset($brands) && count($brands)> 0)
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 "> 
                            <select name="size_id" class="form-control">
                                <option value="0">Select Size</option>
                                @if(isset($sizes) && count($sizes)> 0)
                                @foreach($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-6 ">
                            <select name="color_id"   class="form-control">
                                <option value="0">Select Color</option>
                                @if(isset($colors) && count($colors)> 0)
                                @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                        <label for="default_picture"> Default Picture</label>
                            <input type="file"  name="default_picture" required=""   class="form-control">
                        </div>
                    </div>
                    <div class="form-group p-0 m-0 row">
                        <div class="col-12 p-0 m-0">
                    <label for="upload_file"> Gallery Picture Max 4 Image</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8">
                        <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple/>
                        </div>
                        <div class="col-4">
                        <input type="button" id="remove_image" class="btn btn-danger" value="Remove Image"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                            <ul id="image_preview"></ul>
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



  <!-- product edit -->
<div class="modal fade " id="product_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productEditModal">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="editProductForm" data-parsley-validate="" novalidate="" enctype="multipart/form-data" method="POST">
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="text" id="edit_product_id" name="edit_product_id" hidden>
                            <input type="text" id="edit_name" name="name" required="" placeholder="Product Title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <textarea name="detail" id="edit_detail" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <select name="category_id" id="edit_category_id"  class="form-control">
                                <option value="0">Select Category</option>
                                @if(isset($categories) && count($categories)> 0)
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="sub_category_id" id="edit_sub_category_id" class="form-control">
                            <option value="">Select Sub Category</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="unit_id" id="edit_unit_id" class="form-control">
                                <option value="0">Select Unit</option>
                                @if(isset($units) && count($units)> 0)
                                @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="brand_id" id="edit_brand_id" class="form-control">
                                <option value="0">Select Brand</option>
                                @if(isset($brands) && count($brands)> 0)
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 "> 
                            <select name="size_id"  id="edit_size_id" class="form-control">
                                <option value="0">Select Size</option>
                                @if(isset($sizes) && count($sizes)> 0)
                                @foreach($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-6 ">
                            <select name="color_id"  id="edit_color_id" class="form-control">
                                <option value="0">Select Color</option>
                                @if(isset($colors) && count($colors)> 0)
                                @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                        <label for="default_picture"> Default Picture</label>
                            <input type="file" id="edit_default_picture" value="hasan.jpg" name="default_picture" required=""   class="form-control">
                        </div>
                    </div>
                    <div class="form-group p-0 m-0 row">
                        <div class="col-12 p-0 m-0">
                    <label for="edit_upload_file"> Gallery Picture Max 4 Image</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8">
                        <input type="file" id="edit_upload_file" onchange="edit_preview_image();" name="upload_file[]"   multiple/>
                        </div>
                        <div class="col-4">
                        <input type="button" id="edit_remove_image" class="btn btn-danger" value="Remove Image"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                            <ul id="edit_image_preview"></ul>
                        </div>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="edit_btn_save" class="btn btn-primary">Update Product</button> 
      </div>
      </form>       
    </div>
  </div>
</div> 

<style>
    #image_preview{
        position:relative;
    }
    #image_preview li{
        display:inline;
        float:left;
    }
    #image_preview li img{
        width: 100px;
        height:100px;
        padding-right:10px;
    }

    #edit_image_preview{
        position:relative;
    }
    #edit_image_preview li{
        display:inline;
        float:left;
    }
    #edit_image_preview li img{
        width: 100px;
        height:100px;
        padding-right:10px;
    }
</style>

<script>
    function preview_image()
    {
        var total_file=4;
        var file = document.getElementById("upload_file").files.length;
        if(file> 4){
            alert('please enter 4 image')
            document.getElementById("upload_file").value="";
            
        }else{
            for(var i=0;i<total_file;i++)
        {
        $('#image_preview').append("<li data-id='"+i+"'><img width='100'  src='"+URL.createObjectURL(event.target.files[i])+"'></li>");
        }
        }
    }


    function edit_preview_image()
        {
        var editfile = document.getElementById("edit_upload_file").files.length;

        if(editfile> 4){
            alert('please enter 4 image')
            document.getElementById("edit_upload_file").value="";
            
        }else{
            var total_file=4;
            for(var i=0;i<total_file;i++)
            {
            $('#edit_image_preview').append("<li data-id='"+i+"'><img width='100'  src='"+URL.createObjectURL(event.target.files[i])+"'></li>");
            }
            }
    } 
</script>
<x-backend.alert-script/> 
@endsection('content')

