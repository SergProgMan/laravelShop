<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ACCEPTED = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_PAID = 2;
    const STATUS_SENT = 3;
    const STATUS_ARCHIVED = 4;

    public $fillable = [
        'full_name', 'np_city', 'np_warehouse', 'phone', 'comment'
    ];
    
    protected $dates = [
        'online_paid_at'
    ];

    public function getStatusStringAttribute()
    {
        switch($this->status) {
            case self::STATUS_ACCEPTED: 
                return 'accepted';
            case self::STATUS_PROCESSING: 
                return 'processsing';
            case self::STATUS_PAID: 
                return 'paid';
            case self::STATUS_SENT: 
                return 'sent';
            case self::STATUS_ARCHIVED: 
                return 'archived';
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->products as $orderProduct) 
        {
            $totalPrice += $orderProduct->getTotalPrice();
        }
        return $totalPrice;
    }

    public function scopeAccepted($query) 
    {
        return $query->where('status', Order::STATUS_ACCEPTED);
    }
}
