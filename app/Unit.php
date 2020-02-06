<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];

    public function relProduct()
    {
        return $this->hasMany('App\Product','unit','id');
    }

}
