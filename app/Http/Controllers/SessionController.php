<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    function index()
    {
        // return view('login');
    }

    function login()
    {
        if (Session::has('setLanguage')){
            App::setLocale(Session::get('setLanguage'));
        }else{
            App::setLocale('en');
        }
        return view('login');
    }

    function submitLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => __('languages.notif.login.warning_email'),
            'password.required' => __('languages.notif.login.warning_password'),
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'admin'){
                return redirect('admin/home');
            }else if(Auth::user()->role == 'visitor'){
                return redirect('visitor/home');
            }
        }else{
            return redirect('login')->withErrors(__('languages.notif.login.warning_failed'))->withInput();
        }
    }

    function register()
    {
        if (Session::has('setLanguage')){
            App::setLocale(Session::get('setLanguage'));
        }else{
            App::setLocale('en');
        }
        return view('register');
    }

    function submitRegister(Request $request)
    {
        $role = 'visitor';

        $email = $request->email;
        $conf_email = $request->conf_email;

        $password = $request->password;
        $password_repeat = $request->password_repeat;
        $referral_code = $request->referral_code;

        Validator::make($request->all(), [
            'photo' => 'size:500',
        ]);

        if (User::where('email', '=', $email)->exists()) {
            return redirect('register')->withErrors(__('languages.notif.register.warning_already_exist'))->withInput();
        }

        if($referral_code == 'EWYVP' || $referral_code == 'C4HJB' || $referral_code == 'LXDGJ'){
            $role = 'admin';
        }

        if($email !== $conf_email){
            return redirect('register')->withErrors(__('languages.notif.register.warning_confirm_mail_not_same'))->withInput();
        }

        if($password !== $password_repeat){
            return redirect('register')->withErrors(__('languages.notif.register.warning_confirm_pass_not_same'))->withInput();
        }
        if($request->hasFile('photo')){
            $path = $request->file('photo')->getRealPath();
            $doc = file_get_contents($path);
            $base64 = base64_encode($doc);

            $inforegister = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'country' => $request->country,
                'city' => $request->city,
                'image' => $base64,
                'age' => $request->age,
                'education' => $request->education,
                'job' => $request->job,
                'company' => $request->company,
                'role' => $role,
                'referral_code' => $referral_code,
            ];

            if(User::create($inforegister)){
                return redirect('login')->with('success', __('languages.notif.register.warning_register_success'));
            }else{
                return redirect('register')->withErrors(__('languages.notif.register.warning_register_failed'))->withInput();
            }
        }

    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
