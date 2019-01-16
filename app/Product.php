<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function getShortDescriptionAttribute(){
        return str_limit($this->description, 50);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
