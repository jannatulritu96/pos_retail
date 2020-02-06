<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['outlet','file','expense_no','expense_date','note','exp_cat','amount','status'];

    public function relOutlet()
    {
        return $this->belongsTo('App\Outlet','outlet','id');
    }
    public function relExpenseCategory()
    {
        return $this->belongsTo('App\ExpenseCategory','exp_cat','id');
    }
}
