<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $guarded = ['id'];

    public function relCustomer()
    {
        return $this->hasMany('App\Customer');
    }
}
