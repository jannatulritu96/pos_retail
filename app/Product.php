<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id','name','code','unit','purchases','sell','details','status','image'];
    public function relCategory()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function relUnit()
    {
        return $this->belongsTo('App\Unit','unit','id');
    }
    public function relPurchases()
    {
        return $this->hasOne('App\Purchases','product','id');
    }
}
