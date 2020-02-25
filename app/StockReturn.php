<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockReturn extends Model
{
    protected $guarded = ['id'];
    protected $table ="stock_return";

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
        return $this->belongsTo('App\Supplier');
    }
    public function relUnit()
    {
        return $this->belongsTo('App\Unit','unit','id');
    }
    public function relStockIn()
    {
        return $this->belongsTo('App\StockIn','stock_in_id','id');
    }
    public function relReturnQuantity()
    {
        return $this->hasMany('App\ReturnQuantity');
    }
    public static function returnNo($outletId)
    {
        $dtaB = Outlet::find($outletId);
        $data = StockReturn::where('outlet', $outletId)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->first();

        $lastInt = (!empty($data))?intval(substr($data->return_no,5)):0;
        $ref = 1;
        $ref .= $dtaB->code;
        $ref .= date('y');
        $ref .= substr("0000", 0, -strlen($lastInt+1));
        $ref .= $lastInt+1;
        return $ref;
    }
}
