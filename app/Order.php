<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    public $fillable = [
        'full_name', 'street', 'city', 'phone', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->hasMany('App\OrderProducts');
    }
}