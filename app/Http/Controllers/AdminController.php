<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\StyleScriptTrait;


class AdminController extends Controller
{
    use StyleScriptTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolls = DB::select('select * from rolls');
        $users = User::all();
        $arr =  $this->styleScriptAdd('scripts');
        $arr2 = ['13'=> 'assets/backend/assets/libs/js/user_add.js'];
        $arr3 = array_merge( $arr, $arr2);
        $scripts=[];
        $styles = [];
        return view('dashboard.user_add')->with(['styles'=>$this->styleScriptAdd('styles'), 'scripts'=> $arr3 , 'rolls'=> $rolls , 'users'=>$users ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255' ],
            'email' => ['required', 'email'],
            'password' => ['required','string', 'min:3', 'confirmed'],
            'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000000',
            'roll_id' => 'required'
        ]);
        if ($validator->fails())
        { 
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }else{
            if($request->hasFile('picture')){
            $picture =  $request->picture->getClientOriginalName();
            $picture=  time().'_'.$this->generateRandomString(10)."_".$picture;
            $request->picture->storeAs('users' , $picture , 'public' );
            }
            $data =[
                'name'=> $request->name,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
                'picture'=> $picture,
                'roll_id'=> $request->roll_id
            ];


            
            if($request->user_id !=''){
                $this->deleteOldImage($request->user_id);
               $update_data =  array_merge($data, ['id'=> $request->user_id]);
               User::where('id', $request->user_id)->update($update_data);
               $message = session("message", "User Updated Successfully.");
            //    $message = "User Updated Successfully.";
            }else{
                User::insertGetId($data);
                $message =session("message", 'User Created Successfully');
            }
            return redirect()->back()->with(['status'=>$message ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $user = User::find($id);
       
    return response()->json($user);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

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
        echo $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete()){
            $status = 1;
            $message = "User Deleted Successfull";
        }else{
            $status = 0;
            $message = "Something Went Wrong.";
        }
       return response()->json(['status'=>  $status , 'message'=> $message]);
    }
    
    protected function deleteOldImage($id){
        if($id !=""){
            $user =User::find($id);
            Storage::delete('/public/users/'.$user->picture); 
        }
    }

    protected function generateRandomString($length = 2) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
