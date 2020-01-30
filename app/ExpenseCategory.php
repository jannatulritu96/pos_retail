<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $guarded = ['id'];

    public function relExpense()
    {
        return $this->hasMany('App\Expense','exp_cat','id');
    }
}
