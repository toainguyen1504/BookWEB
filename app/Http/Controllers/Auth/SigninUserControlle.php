<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\SigninRequest;
use Illuminate\Support\Facades\Hash; 

class SigninUserController extends Controller
{

    public function templateSignin()
    {
        return view('signin');
    }

    public function signin(SigninRequest $request)
    {
       
        $data_user = DB::table('users')->where('email', $request->email)->first();
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            // 'status' => 0 
        ];
        $data_user = DB::table('users')->where('email', $request->email)->first();
            //dd($request->password);
        if (Auth::attempt($data)) {

            if ($data_user->status == 0) {
                return redirect()->route('userIndex', ['id' => $data_user->id]);
            } else {
                return redirect()->route('signin')->with('wrong', 'Account has been locked!');
            }
        }
        else return redirect()->route('signin')->with('wrong', 'Incorrect account or password!'); 
            
    }

    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin');
    }
}
