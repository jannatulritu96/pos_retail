<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $guarded = ['id'];

    public function relUnit()
    {
        return $this->belongsTo('App\Unit','unit','id');
    }
    public function relStockIn()
    {
        return $this->belongsTo('App\StockIn');
    }
    public function relProduct()
    {
        return $this->belongsTo('App\Product','product','id');
    }
    public function relReturnQuantity()
    {
        return $this->hasMany('App\ReturnQuantity','product','id');
    }
}
