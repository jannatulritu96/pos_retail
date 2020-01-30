<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function relCompany()
    {
        return $this->belongsTo('App\CompanySetting');
    }
}
