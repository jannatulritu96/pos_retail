<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $guarded = ['id'];
    protected $table ="supplier_payments";

    public function relStockIn()
    {
        return $this->belongsTo('App\StockIn','receive_id','id');
    }
    public function relPayment()
    {
        return $this->belongsTo('App\Payment','payment_method','id');
    }

}
