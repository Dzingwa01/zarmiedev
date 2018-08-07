<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

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

        if($user->hasRole('admin')){
            return redirect()->route('admin_home');
        }
        else if($user->hasRole('client'))
        {
            if($user->verified==0){
                return view('status.status_message_not_activated');
            }else{
                return view('adminlte::home');
            }


        }
    }
}