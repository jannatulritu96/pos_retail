<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function relCategory()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
}
