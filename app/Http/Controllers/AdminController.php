<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    function index(Request $request){
        if (Session::has('setLanguage')){
            App::setLocale(Session::get('setLanguage'));
        }else{
            App::setLocale('en');
        }

        if ($request->ajax()) {
            return DataTables::of(DB::table('users')->select('id', 'email', 'firstname', 'lastname', 'image', 'company', 'country', 'reg_date')->where('role', 'visitor'))->toJson();
        }

        return view('admin/home', ['language' => app()->getLocale()]);
    }

    function messenger(){
        if (Session::has('setLanguage')){
            App::setLocale(Session::get('setLanguage'));
        }else{
            App::setLocale('en');
        }

        $visitorlist = DB::table('users')->select('id', 'firstname', 'lastname')->where('role', 'visitor')->get()->toArray();
        // print_r($visitorlist);
        return view('admin/messenger', ['visitorlist' => $visitorlist, 'language' => Session::get('setLanguage')]);
    }

    function getdataprofile($userid){
        return DB::table('users')->where('id', $userid)->get()->toJson();
    }

    function user_modify(Request $request){
        $updateuser = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'age' => $request->age,
            'country' => $request->country,
            'city' => $request->city,
            'job' => $request->job,
            'company' => $request->company,
            'education' => $request->education,
        ];

        $return = DB::table('users')->where('id', $request->userid)->update($updateuser);

        if($return){
            return redirect('/admin/home')->with('success', __('languages.notif.modify.warning_modify_success'));
        }else{
            return redirect('/admin/home')->withErrors(__('languages.notif.modify.warning_modify_failed'))->withInput();
        }
    }

}
