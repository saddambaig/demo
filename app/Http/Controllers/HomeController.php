<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function rigister($id){
        $user=User::find($id);
        return view('set-password',compact('user'));
    }
    public function creae_pass(Request $request){
        $request->validate([
            'password'=>'required'
        ]);
        $user=User::find($request->id);
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->back();
    }
    public function verify_pin($id){
        return view('verify-pin',compact('id'));
    
    }

    public function pin_verified(Request $request){
        $request->validate([
            'pin'=>'required'
        ]);
        $user=User::find(json_decode($request->id));
        if($user->pin==$request->pin){
            $user->pin='';
            $user->verify_pin='1';
            $user->save();
            return redirect('success');
        }else{
            return redirect()->back();
        }
    }
}
