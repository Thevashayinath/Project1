<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('auth.login');
});
//Route::get('project1/dashboard', function () {
//    return view('home.dashboard');
//});
//Route::get('/home/dashboard', function () {
//    return view('home.dashboard');
//});
//Route::get('/', 'AuthController@index')->name('home.index');
//Route::get('/home/dashboard', 'HomeController@show')->name('home.dashboard');

//Route::group(['namespace' => 'App\Http\Controllers'], function()
//{
    /**
     * Home Routes
     */
    //Route::get('/', function () {
//    return view('auth.login');
//});
//    Route::get('/', 'AuthController@index')->name('home.index');

//    Route::get('dashboard', 'AuthController@show')->name('dashboard');;
//    Route::post('login', 'AuthController@login')->name('login');;
//    Route::post('dashboard', 'HomeController@show')->name('dashboard');

//    Route::post('admin/dashboard', 'AuthController@view');

//    Route::group(['middleware' => ['guest']], function() {
//        /**
//         * Register Routes
//         */
//        Route::get('/register', 'RegisterController@show')->name('register.show');
//        Route::post('/register', 'RegisterController@register')->name('register.perform');
//
//        /**
//         * Login Routes
//         */
//        Route::get('/login', 'LoginController@show')->name('login.show');
//        Route::post('login', 'AuthController@login');
//
//    });
//
//    Route::group(['middleware' => ['auth']], function() {
//        /**
//         * Logout Routes
//         */
//        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
//    });
//});


//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});
