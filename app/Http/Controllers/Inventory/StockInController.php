<?php

namespace App\Http\Controllers\Inventory;

use App\Outlet;
use App\Product;
use App\Stock_in;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Stock_in::select('*');
//        $render = [];
        return view('admin.inventory.stock_in.index',compact('data'));
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
        // dd($request->all());
        $request->validate([
            'outlet'=>'required',
            'supplier'=>'required',
            'receive_date'=>'required',
            'challan_no'=>'required',
            'challan_date'=>'required',
            'receive_note'=>'required',
            'product'=>'required',
            'rcv_qty'=>'required',
            'unit_price'=>'required',
            'total_price'=>'required',
            'total_qty'=>'required',
            'total_amount'=>'required',
            'tax'=>'required',
            'discount_amount'=>'required',
            'payable_amount'=>'required',
            'paid_amount'=>'required',
            'due_amount'=>'required',
        ]);
        
        $receiveNo = Stock_in::receiveNo($request->outlet);
        $stocks = Stock_in::create([
            'outlet' => $request->outlet,
            'supplier' => $request->supplier,
            'receive_no' => $receiveNo,
            'receive_date' => $request->receive_date,
            'challan_no' => $request->challan_no,
            'challan_date' => $request->challan_date,
            'receive_note' => $request->receive_note,
            'product' => $request->product,
            'rcv_qty' => $request->rcv_qty,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'total_qty' => $request->total_qty,
            'total_amount' => $request->total_amount,
            'tax' => $request->tax,
            'discount_amount' => $request->discount_amount,
            'payable_amount' => $request->payable_amount,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
        ]);

        if($request->hasFile('challan_doc'))
            {
                $file= $request->file('challan_doc');
                $file->move('assets/stock_file/',$file->getClientOriginalName());
                $stocks->challan_doc = 'assets/stock_file/'.$file->getClientOriginalName();
            }
            $stocks->save();


        if ($stocks) {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
