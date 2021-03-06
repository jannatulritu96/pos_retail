<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['category','status'];

    public function relProduct()
    {
        return $this->hasMany('App\Product','category_id','id');
    }

}
