<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = ['id'];

    public function relPurchases()
    {
        return $this->hasMany('App\Purchases','supplier','id');
    }
    public function relStockReturn()
    {
        return $this->hasMany('App\StockReturn');
    }
}
