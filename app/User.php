<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Traits\UserVerification;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use UserVerification;
//    use Illuminate\Notifications\Notifiable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_number','physical_address','surname','verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
