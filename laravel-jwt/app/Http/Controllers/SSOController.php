<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SSOController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!$request->header('Authorization')) {
            return view('auth.login');
        }

        $token = $request->header('Authorization');
        $res = $this->validateToken($token);
        if (!$res) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        } else {
            return view('admin.dashboard.index');
        }

    }
    public function validateToken($token):string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post('http://127.0.0.1:8001/api/getToken');

        if ($response->ok()) {
            // API request successful, handle response
            return $response->json();
        } else {
            // API request failed, handle error
            return $response->json()['error'];
        }
    }
}
