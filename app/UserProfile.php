<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public function User(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'country', 'city', 'address', 'phone'
    ];
}
