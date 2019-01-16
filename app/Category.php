<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];
    
    public function getShortDescriptionAttribute(){
        return str_limit($this->description, 50);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
