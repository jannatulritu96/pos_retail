<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
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
}
