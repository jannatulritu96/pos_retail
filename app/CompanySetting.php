<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = ['company_name','company_email','company_phone','currency_code','tax','vat','date','pagination','year','stock_out_method','customer','company_logo'];

    public function relCustomer()
    {
        return $this->hasMany('App\Customer');
    }
}
