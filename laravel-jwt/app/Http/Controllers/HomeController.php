<?php
namespace App\Http\Controllers;
use App\Models\User;
//use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

//use PHPOpenSourceSaver\JWTAuth\JWTAuth;

//use PHPOpenSourceSaver\JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
//use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
//use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
//use Tymon\JWTAuth\JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
//use PHPOpenSourceSaver\JWTAuth;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('jwt')) {
//            return redirect('http://127.0.0.1:8000/login?redirect_url=' . urlencode($request->url()));
            return view('auth.login');
        }
//        $this->checkToken();
//        $user = JWTAuth::getToken();
        $jwt = $request->session()->get('jwt');
//        $decoded = JWTAuth::decode($jwt);
//        $user = new JWT();
//        $user->fromSubject();
        if ($jwt) {
            $user = User::where('remember_token', $jwt)->first();
            if($user){
                session(['_token' => $jwt]);
                $sessionCookie = session()->getName();
                // Create a new cookie instance with the updated session cookie value
                $newCookie = cookie($sessionCookie, 'abc');
//                $request->session()->put('_token', $jwt);
//                return view('admin.dashboard.index');
                $response = new Response(view('admin.dashboard.index'));
                $response->withCookie(cookie('_token', $jwt, 60));
                $response->withCookie(cookie('token', $jwt, 60));
                return $response;
//                return view('admin.dashboard.index')->withCookie(cookie('jwt', $jwt, 60));
            }else{
                return view('auth.login');
            }
        }
        else{
            return view('auth.login');
        }
    }

//    public  function checkToken(){
//
//        $tokens = JWTAuth::parseToken();
////        $payload = $token->getPayload();
//        try {
//            $token = JWTAuth::parseToken();
//            $payload = $token->getPayload();
//            $expiration = $payload->get('exp');
//            $now = time();
//            if ($expiration < $now) {
//                return view('auth.login');
//                // Token has expired
//            }
//        } catch (\Exception $e) {
//            // Invalid token
//        }
//    }

}
