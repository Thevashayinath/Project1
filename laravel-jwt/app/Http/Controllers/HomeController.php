<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('_token')) {
            return view('auth.login');
        }
        $jwt = $request->session()->get('_token');

        if ($jwt) {
            $user = User::where('remember_token', $jwt)->first();
            if($user){
                return view('admin.dashboard.index');
            }else{
                return view('auth.login');
            }
        }
        else{
            return view('auth.login');
        }
    }

}
