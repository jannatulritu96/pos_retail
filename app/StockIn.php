<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outlet;

class StockIn extends Model
{
    protected $guarded = ['id'];

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
    public function relStockItem()
    {
        return $this->hasMany('App\StockItem');
    }
    public function relStockReturn()
    {
        return $this->hasMany('App\StockReturn');
    }
    public function relReturnQuantity()
    {
        return $this->hasMany('App\ReturnQuantity');
    }
    public static function receiveNo($outletId)
    {
        $dtaB = Outlet::find($outletId);
        $data = StockIn::where('outlet', $outletId)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->first();

        $lastInt = (!empty($data))?intval(substr($data->receive_no,5)):0;
        $ref = 1;
        $ref .= $dtaB->code;
        $ref .= date('y');
        $ref .= substr("0000", 0, -strlen($lastInt+1));
        $ref .= $lastInt+1;
        return $ref;
    }
}
