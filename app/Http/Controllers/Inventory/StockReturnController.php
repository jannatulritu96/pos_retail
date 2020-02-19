<?php

namespace App\Http\Controllers\Inventory;

use App\ReturnQuantity;
use App\StockIn;
use App\StockItem;
use App\StockReturn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockReturnController extends Controller
{
    public function create($id){
        $stock = StockIn::with(['relOutlet','relSupplier'])->findOrFail($id);

        $stockItem = StockItem::select('stock_items.*', \DB::raw('IFNULL(A.returnedQty, 0) AS returnedQty'))->with(['relProduct','relUnit'])
            ->leftJoin(\DB::raw("(SELECT stock_item_id, SUM(returning_qty) AS returnedQty FROM return_quantities GROUP BY stock_item_id) AS A"), 'stock_items.id', '=', 'A.stock_item_id')
            ->where('stock_in_id', $id)
            ->get();

        return view('admin.inventory.stock_return.create',compact('stock', 'stockItem'));
    }
    public function store(Request $request, $id)
    {
//        dd($request->all());

        $stockIn = StockIn::find($id);
        $returnNo = StockReturn::returnNo($request->outlet);
        $stockReturn = StockReturn::create([
            'stock_in_id' => $stockIn->id,
            'return_no' => $returnNo,
            'return_date' => $request->return_date,
            'return_causes' => $request->return_causes,
        ]);

        foreach ($request->product as $key => $product) {
            if (isset($product)) {
                $stockItem = new ReturnQuantity();
                $stockItem->stock_item_id = $stockReturn->id;
                $stockItem->product = $product['product'];
                $stockItem->returning_qty = $product['returning_qty'];
                $stockItem->save();
            }
        }

        if ($stockReturn) {
            session()->flash('success','Product return successfully');
        } else {
            session()->flash('error','Something was wrong!  ');
        }
        return redirect()->route('stock_return.index');
    }
}
