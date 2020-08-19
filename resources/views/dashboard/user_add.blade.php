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
                    <button id="user_add" class="" 
                    style="background-color:#110E2A;
                    color:#fff;
                    padding:7px;
                    border:0;
                    border-radius:3px;
                    cursor:pointer;

                    "  data-toggle="modal" data-target="#user_modal">
                    New User</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(isset($users) && count($users)>0)
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                    <img src="{{asset('storage/users/'. $user->picture)}}" alt="" height="50" >
                                    </td>
                                    <td>
                                        <button href="#" data-toggle="modal" data-target="#user_modal" data-id="{{$user->id}}"  class="btn btn-warning btn-sm edit_user">Edit</button>
                                        <a href="#" data-id="{{$user->id}}"   class="btn btn-danger btn-sm delete_user">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
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
    <div class="modal fade " id="user_modal" tabindex="-1" role="dialog" aria-labelledby="addNewUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewUser">Add New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form id="validationform" method="post" action="{{url('dashboard/users')}}" data-parsley-validate="" enctype="multipart/form-data" novalidate="">
                @csrf
                    <div class="form-group row">
                        <div class="col-12">
                        <input type="text" hidden value="" id="user_id" name="user_id">
                        <input type="text" id="user_name" name="name" required="" placeholder="Full Name" autofocus class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="email" id="user_email" name="email" required="" autocomplete="off"  placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="password" id="user_password" name="password" required="" autocomplete="off" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="password" id="user_password_confirm"  name="password_confirmation" required="" placeholder="Confirm Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8">
                            <input type="file" id="user_picture" name="picture" required="" placeholder="Image" class="form-control mt-4">
                            
                        </div>
                        <div class="col-4" id="user_preview" style="float:right;right:0;">
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <select  name="roll_id" id="roll_id" class="form-control">
                                <option value="0">select user</option>
                                @if(isset($rolls))
                                @foreach($rolls as $roll)
                                <option value="{{$roll->id}}">{{$roll->roll_name}}</option>
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