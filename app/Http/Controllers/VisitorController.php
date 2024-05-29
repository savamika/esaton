<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    function index(){
        if (Session::has('setLanguage')){
            App::setLocale(Session::get('setLanguage'));
        }else{
            App::setLocale('en');
        }
        $chathistory = DB::table('messages')->where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get()->toArray();
        return view('visitor/home', ['userid' => Auth::user()->id, 'chathistory' => $chathistory]);
    }
}
