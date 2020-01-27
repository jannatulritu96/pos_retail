<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        return view('admin.dashboard');
    }

    public function showResetForm()
    {
        return view('admin.change_password');
    }

    public function updatepassword(Request $request){
        $password=User::find(Auth::id())->password;
        $oldpass=$request->oldpass;

        if(Hash::check($oldpass,$password)){
            $user=User::find(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth()->logout();
            return Redirect()->route('login')->with('success', 'Product save successfully!');
        }else{
            return Redirect()->back()->with('error', 'Product insert failed!');
        }

    }
}
