<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Session;

//use PHPOpenSourceSaver\JWTAuth\JWTAuth;


class AuthController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login','register','index']]);
//    }

//    public function index(Request $request)
//    {
//        return view('home.index');
//    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }else{
            $authUser = Auth::user();
//            $abc = new JWTAuth();
            $user = User::find($authUser->id);
            $user->remember_token = $token;
            $user->save();
//            return view('home.dashboard');
//            return redirect('/admin/dashboard');
//            $request->session()->regenerate();
//            Session::flush();
            session(['_token' => $token]);
//            $response->withCookie(cookie('jwt', $jwtToken, 60));
            session()->regenerate();
            session(['_token' => $token]);
            $request->session()->put('jwt', $token);

//            $sessionCookie = session()->getName();
//            // Create a new cookie instance with the updated session cookie value
//            $newCookie = cookie($sessionCookie, 'new_cookie_value');
//            return redirect()->intended();
//            return view('admin.dashboard.index');
            return redirect('http://127.0.0.1:8000/dashboard')->with('token', $token);
//            return redirect('http://127.0.0.1:8000/dashboard')->withCookie(cookie('jwt', $token, 60));
//            return redirect()->route('dashboard')->with('token', $token);
//            return redirect('admin/dashboard');
        }

//        $user = Auth::user();
//        return response()->json([
//            'status' => 'success',
//            'user' => $user,
//            'authorisation' => [
//                'token' => $token,
//                'type' => 'bearer',
//            ]
//        ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
