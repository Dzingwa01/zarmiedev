<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Jobs\SendVerificationEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $user=Auth::user();
//        dd($user->hasRole('client'));
        if($user->hasRole('admin')){
            return redirect()->route('admin_home');
        }
        else if($user->hasRole('client'))
        {
            if($user->verified==0){
                if(Auth::check()){
                    Auth::logout();
                    return redirect()->back()->with('user',$user->email);
                }
                else{
                    return view('status.status_message_not_activated',compact('user'));
                }


            }else{
                return view('adminlte::home');
            }
        }else{
            Auth::logout();
        }

    }
    public function resendEmail($email){
//        dd($email);
        $user = User::where('email',$email)->first();
        $user->verification_token = base64_encode($user->email);
        dispatch(new SendVerificationEmail($user));
        return redirect('login');
    }
}