<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id','name','code','unit','purchase','sell','details','status','image'];
    public function relCategory()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function relUnit()
    {
        return $this->hasMany('App\Unit');
    }
}
