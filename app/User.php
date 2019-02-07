<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Events\UserCreated;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Function for check is user admin
     */
    public function isAdmin()
    {
        return $this->admin === 1;
    }

    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }

    public function myOrders()
    {
        return $this->hasMany('App\Order');
    }

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];
}
