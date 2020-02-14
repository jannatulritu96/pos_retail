<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outlet;

class Stock_in extends Model
{
    protected $guarded = ['id'];

    public static function receiveNo($outletId)
    {
        $dtaB = Outlet::find($outletId);
        $data = Stock_in::where('outlet', $outletId)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->first();

        $lastInt = (!empty($data))?intval(substr($data->receive_no,5)):0;
        $ref = 1;
        $ref .= $dtaB->code;
        $ref .= date('y');
        $ref .= substr("0000", 0, -strlen($lastInt+1));
        $ref .= $lastInt+1;
        return $ref;
    }
}
