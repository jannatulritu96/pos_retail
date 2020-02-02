<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $guarded = ['id'];

    public function relExpense()
    {
        return $this->hasMany('App\Expense','outlet','id');
    }
}
