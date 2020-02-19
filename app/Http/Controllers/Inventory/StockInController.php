<?php

namespace App\Http\Controllers\Inventory;

use App\Outlet;
use App\Product;
use App\ReturnQuantity;
use App\StockItem;
use App\StockReturn;
use App\StockIn;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function foo\func;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = StockIn::with(['relOutlet','relProduct','relSupplier'])->select('*');
        $products = Product::where('status','1')->get();
        $suppliers = Supplier::where('status','1')->get();
        $outlets = Outlet::where('status','1')->get();
        $render = [];

        $data = $sql->paginate(30);
        $data->appends($render);
        return view('admin.inventory.stock_in.index',compact('data','products','outlets','status','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $rendom = uniqid();
        $outlets = Outlet::where('status','1')->get();
        $suppliers = Supplier::where('status','1')->get();
        $products = Product::where('status','1')->get();
        return view('admin.inventory.stock_in.create',compact('outlets','suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'outlet'=>'required',
            'supplier'=>'required',
            'receive_date'=>'required',
            'challan_no'=>'required',
            'challan_date'=>'required',
            'receive_note'=>'required',
            'product'=>'required',
            'total_qty'=>'required',
            'total_amount'=>'required',
            'tax'=>'required',
            'payable_amount'=>'required',
            'paid_amount'=>'required',
            'due_amount'=>'required',
        ]);
        $receiveNo = StockIn::receiveNo($request->outlet);
        $stockIn = StockIn::create([
            'outlet' => $request->outlet,
            'supplier' => $request->supplier,
            'receive_no' => $receiveNo,
            'receive_date' => $request->receive_date,
            'challan_no' => $request->challan_no,
            'challan_date' => $request->challan_date,
            'receive_note' => $request->receive_note,
            'total_qty' => $request->total_qty,
            'total_amount' => $request->total_amount,
            'tax' => $request->tax,
            'discount_amount' => $request->discount_amount,
            'payable_amount' => $request->payable_amount,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
        ]);


                foreach ($request->product as $key => $product) {
                    if (isset($product)) {
                        $stockItem = new StockItem();
                        $stockItem->stock_in_id = $stockIn->id;
                        $stockItem->product = $product['product'];
                        $stockItem->rcv_qty = $product['rcv_qty'];
                        $stockItem->unit_price = $product['unit_price'];
                        $stockItem->total_price = $product['total_price'];
                        $stockItem->save();
                    }
                }


        if($request->hasFile('challan_doc'))
            {
                $file= $request->file('challan_doc');
                $file->move('assets/stock_file/',$file->getClientOriginalName());
                $stockIn->challan_doc = 'assets/stock_file/'.$file->getClientOriginalName();
            }
        $stockIn->save();


        if ($stockIn) {
            session()->flash('success','Product stock successfully');
        } else {
            session()->flash('error','Something was wrong!  ');
        }
        return redirect()->route('stock_in.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = StockIn::with(['relOutlet','relSupplier','relStockItem' => function($q){
            $q->with(['relProduct','relUnit']);
        }])->find($id);

//        $units = Unit::where('status','1')->get();

        return view('admin.inventory.stock_in.show',compact('data','units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = StockIn::findOrFail($id)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Stock deleted successfully";
        } else {
            $success = true;
            $message = "Stock not found";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function changeActivity($id)
    {
        $stocks = StockIn::find($id);
        $status = 0;
        if ($stocks->status == 0) {
            $status = 1;
        }
        $stocks = $stocks->update(['status' => $status]);

        if ($stocks) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
