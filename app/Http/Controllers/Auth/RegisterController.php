<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\SendVerificationEmail;
use App\Package;
use App\Role;
use App\User;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    protected $redirectTo = '/account_creation_success';
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('adminlte::auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required',
            'terms' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//        $data['email_token'] = base64_encode($data['email']);
        DB::beginTransaction();
        try {
            $user =User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'physical_address' => $data['physical_address'],
                'password' => bcrypt($data['password']),
                'verification_token'=>base64_encode($data['email']),
                'verified'=>0
            ]);
//            Mail::queue('emails.verify_user',['title'=>$title,'user'=>user],function())

            $role = Role::where('name','client')->first();
            $user->attachRole($role);
            DB::commit();
            event($user);
            dispatch(new SendVerificationEmail($user));

        }
        catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        return response()->view('status.status_message',$user,200);
    }

    public function verify($token)
    {
        $user = User::where('verification_token', $token)->first();
        $user->verified = 1;
        if ($user->save()) {
            return view('emails.registration_success', ['user' => $user]);
        }
    }

    public function accountSuccess(){
        return view('status.status_message');
    }

    public function accountNotRegistered(){
        return view('status.status_message_not_activated');
    }
}
