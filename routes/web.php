<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', function () {
    if (Session::has('setLanguage')){
        App::setLocale(Session::get('setLanguage'));
    }else{
        App::setLocale('en');
    }
    Cache::flush();
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'login'])->name('login');
    Route::post('/login', [SessionController::class, 'submitLogin']);
});

Route::get('/home', function () {
    if (Session::has('setLanguage')){
        App::setLocale(Session::get('setLanguage'));
    }else{
        App::setLocale('en');
    }
    Cache::flush();
    return redirect('admin/home');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.index')->middleware('roleAccess:admin');
    Route::get('/admin/messenger', [AdminController::class, 'messenger'])->middleware('roleAccess:admin');
    Route::get('/admin/get_data_profile/{userid}', [AdminController::class, 'getdataprofile'])->middleware('roleAccess:admin');
    Route::post('/admin/user/modify', [AdminController::class, 'user_modify'])->middleware('roleAccess:admin');

    //chat admin
    Route::get('/chat/loadview/{userid}/{name}', [ChatController::class, 'loadview'])->middleware('roleAccess:admin');
    Route::get('/chat/getMessage/admin/{userid}', [ChatController::class, 'getMessage'])->middleware('roleAccess:admin');
    Route::post('/chat/postMessage', [ChatController::class, 'postMessage'])->middleware('roleAccess:admin');
    Route::post('/broadcasting/auth',function() {
        return response()->json(['success' => true]);
    })->middleware('roleAccess:admin');


    Route::post('/chat/visitor/postMessage', [ChatController::class, 'postMessage'])->middleware('roleAccess:visitor');
    Route::get('/visitor/home', [VisitorController::class, 'index'])->middleware('roleAccess:visitor');;
    Route::get('/logout', [SessionController::class, 'logout']);
});

Route::get('/register', [SessionController::class, 'register']);
Route::post('/register', [SessionController::class, 'submitRegister']);

Route::get('/legal', function () {
    if (Session::has('setLanguage')){
        App::setLocale(Session::get('setLanguage'));
    }else{
        App::setLocale('en');
    }
    return view('/legal/legal');
});

Route::get('/replace_language/{locale}', function ($locale) {
   Session::put('setLanguage', $locale);
   App::setLocale($locale);
   return $locale;
});
