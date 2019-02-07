<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public $fillable = ['name', 'description', 'price'];

    protected $dates = [
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 50);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(9);
    }
}
