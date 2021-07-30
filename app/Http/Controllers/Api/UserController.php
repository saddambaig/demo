<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function create(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'role'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),301);
        }
        $img_name="";
        if($request->has('file')){
            $img=$request->file;
            $img_name=time().$img->getClientOriginalName();
            $path=public_path().'/images/'.$img_name;
            $img->move($path);
           

        }
        $user=User::create([
            'name'=>$request->name,
            'user_name'=>$request->username,
            'email'=>$request->email,
            'password'=>'',
            'role'=>$request->role,
            'avatar'=>$img_name,
            'registered_at'=>date('d/m/Y'),
        ]);

        $data['url']=route('user.register',['id'=>$user->id]);
        $mail=\Mail::to('test@gamil.com')->send(new \App\Mail\SendRegistrationUrl($data));
       
            return response()->json(['success'=>'create password link sent to your email'],200);
       
    }
    public function login(Request $request){
        $validate=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),401);
        }
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $pin=rand(111111,999999);
           $user=User::find(Auth::user()->id);
            $user->pin='';
            $user->verify_pin='0';
            $user->save();
            $data['pin']=$pin;
            $data['url']=route('user.pin.verify',['id'=>json_encode($user->id)]);
            $mail=\Mail::to('test@gamil.com')->send(new \App\Mail\SendPinCode($data));
          
                $user->pin=$pin;
                $user->save();
            
            return response()->json(['success'=>'6 digits pin code is sent to your email please check']);
        }else{
            return response()->json('unathurized',401);
        }
    }
    public function updateProfile($request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'user_name'=>'sometimes|unique:users,username,',$request->id,
            'email'=>'sometimes|unique:users,email,',$request->id,
            'user_role'=>'required',
            'file'=>'sometimes|image|mimes,jpg,png,gif,jpeg'

        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),401);
        }
        $user=User::find($request->id);
        if($request->has('file')){
            $img=$request->file;
            $img_name=time().$img->getClientOriginalName();
            $path=public_path().'/images/'.$img_name;
            $img->move($path);
            $user->avatar=$img_name;

        }
        
        $user->name=$request->name;
        $user->user_name=$request->username;
        $user->email=$user->email;
        $user->save();
        return response()->json(['success'=>'successfully updated'],200);
        
    }
    
}
