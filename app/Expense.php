<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outlet;

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

    public static function expenseNo($outletId)
    {
        $dtaB = Outlet::find($outletId);
        $data = Expense::where('outlet', $outletId)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->first();

        $lastInt = (!empty($data))?intval(substr($data->receive_no,5)):0;
        $ref = 1;
        $ref .= $dtaB->code;
        $ref .= date('y');
        $ref .= substr("0000", 0, -strlen($lastInt+1));
        $ref .= $lastInt+1;
        return $ref;
    }
}
