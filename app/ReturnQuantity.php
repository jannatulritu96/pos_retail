<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnQuantity extends Model
{
    protected $guarded = ['id'];
    public function relStockIn()
    {
        return $this->belongsTo('App\StockIn','stock_in_id','id');
    }
    public function relStockItem()
    {
        return $this->belongsTo('App\StockItem','stock_item_id','id');
    }
    public function relStockReturn()
    {
        return $this->belongsTo('App\StockReturn');
    }
}
