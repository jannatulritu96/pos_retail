<?php

namespace App\Http\Controllers\Inventory;

use App\Outlet;
use App\ReturnQuantity;
use App\StockIn;
use App\StockItem;
use App\StockReturn;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockReturnController extends Controller
{
    public function index(Request $request)
    {
        $sql = ReturnQuantity::with(['relStockReturn' => function($q){
                                $q->with(['relStockIn' => function($q){
                                    $q->with(['relOutlet','relSupplier']);
                                }]);
                            }])->select('*');

        $suppliers = Supplier::where('status','1')->get();
        $outlets = Outlet::where('status','1')->get();
        $render = [];

//        if(isset($request->search)){
//                $sql->ReturnQuantity::with(['relStockReturn' => function($q){
//                        $q->with(['relStockIn' => function($q){
//                            $q->with(['relOutlet','relSupplier']);
//                        }]);
//                     }])->where(function ($q) use($request){
//                    $q->where('return_no', '=', $request->search)
//                        ->orwhere('receive_no', '=', $request->search)
//                        ->orwhere('challan_no', '=', $request->search);
//                });
//        }

//        if (isset($request->outlet)) {
//            $sql->where('outlet', 'like', '%'.$request->outlet.'%');
//            $render['outlet'] = $request->outlet;
//        }
//        if (isset($request->supplier)) {
//            $sql->where('supplier', 'like', '%'.$request->supplier.'%');
//            $render['supplier'] = $request->supplier;
//        }

        $data = $sql->paginate(30);
        $data->appends($render);

        return view('admin.inventory.stock_return.index',compact('data','suppliers','outlets'));
    }
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
        $stock = StockItem::find($id);
        $stockReturn = StockReturn::find($id);
        $returnNo = StockReturn::returnNo($request->outlet);
        $stockReturn = StockReturn::create([
            'stock_in_id' => $stockIn->id,
            'outlet' => $request->outlet,
            'return_no' => $returnNo,
            'return_date' => $request->return_date,
            'return_causes' => $request->return_causes,
        ]);

        foreach ($request->product_id as $key => $product) {
            if (isset($product)) {
                $stockItem = new ReturnQuantity();
                $stockItem->stock_item_id = $stock->id;
                $stockItem->stock_return_id = $stockReturn->id;
                $stockItem->product = $product;
                $stockItem->returning_qty = $request->returning_qty[$key];
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

    public function show($id)
    {
        $data = ReturnQuantity::with(['relProduct','relStockItem','relStockReturn' => function($q){
            $q->with(['relStockIn' => function($q){
                $q->with(['relOutlet','relSupplier']);
            }]);
        }])->find($id);


        return view('admin.inventory.stock_return.show',compact('data'));
    }

    public function edit($id)
    {

        $stock = StockIn::with(['relOutlet','relSupplier'])->findOrFail($id);

        $stockItem = StockItem::select('stock_items.*', \DB::raw('IFNULL(A.returnedQty, 0) AS returnedQty'))->with(['relProduct','relUnit'])
            ->leftJoin(\DB::raw("(SELECT stock_item_id, SUM(returning_qty) AS returnedQty FROM return_quantities GROUP BY stock_item_id) AS A"), 'stock_items.id', '=', 'A.stock_item_id')
            ->where('stock_in_id', $id)
            ->get();

        return view('admin.inventory.stock_return.create',compact('stock', 'stockItem'));
    }

    public function update(Request $request, $id){
        dd($request->all());
        $stock = StockItem::find($id);
        $stockReturn = StockReturn::where(['id'=> $id])->Update([
            'return_causes' => $request->return_causes,
        ]);

        foreach ($request->id as $key => $return_quantities_id) {
            if (isset($return_quantities_id)) {
                ReturnQuantity::where(['id' => $return_quantities_id])->Update([
                    'stock_item_id' => $stock->id,
                    'stock_return_id' => $stockReturn->id,
                    'returning_qty' => $request->returning_qty[$key],
                ]);
            }
        }
    }

    public function destroy($id)
    {

        $delete = ReturnQuantity::findOrFail($id)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Customer deleted successfully";
        } else {
            $success = true;
            $message = "Customer not found";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
