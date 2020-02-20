<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnQuantity extends Model
{
    protected $guarded = ['id'];
    public function relStockIn()
    {
        return $this->belongsTo('App\StockIn');
    }
    public function relStockItem()
    {
        return $this->belongsTo('App\StockItem','stock_item_id','id');
    }
    public function relStockReturn()
    {
        return $this->belongsTo('App\StockReturn','stock_return_id','id');
    }
    public function relProduct()
    {
        return $this->belongsTo('App\Product','product','id');
    }
    public function relOutlet()
    {
        return $this->belongsTo('App\Outlet','outlet','id');
    }

    public function relSupplier()
    {
        return $this->belongsTo('App\Supplier','supplier','id');
    }
    public function relUnit()
    {
        return $this->belongsTo('App\Unit','unit','id');
    }

}
