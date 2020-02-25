<?php

namespace App\Http\Controllers\Inventory;

use App\Outlet;
use App\Payment;
use App\StockIn;
use App\Supplier;
use App\SupplierPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = SupplierPayment::with(['relPayment', 'relStockIn' => function($q){
                                        $q->with(['relOutlet','relSupplier']);
                                    }])->select('*');

        $suppliers = Supplier::where('status','1')->get();
        $outlets = Outlet::where('status','1')->get();
        $render = [];

        if (isset($request->outlet)) {
            $sql->where('outlet', 'like', '%'.$request->outlet.'%');
            $render['outlet'] = $request->outlet;
        }
        if (isset($request->supplier)) {
            $sql->where('supplier', 'like', '%'.$request->supplier.'%');
            $render['supplier'] = $request->supplier;
        }

        if(isset($request->search)){
            $sql->where(function ($q) use($request){
                $q->where('payment_method', '=', $request->search);
            });
        }

        $data = $sql->paginate(30);
        $data->appends($render);

        return view('admin.inventory.supplier_payment.index',compact('data','suppliers','outlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $StockIn = StockIn::with('relSupplier')->get();
        $method = Payment::get();
        $payData = [];
        foreach ($StockIn as $val) {
            $payData[$val->id] = $val->due_amount;
        }
     return view('admin.inventory.supplier_payment.create',compact('StockIn','method', 'payData'));
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
            'receive_id'=>'required',
            'receive_due'=>'required',
            'payment_method'=>'required',
            'payment_details'=>'required',
            'payment_date'=>'required',
            'paid_amount'=>'required',
        ]);

        $paySupplier = SupplierPayment::create([
            'receive_id' => $request->receive_id,
            'receive_due' => $request->receive_due,
            'payment_method' => $request->payment_method,
            'payment_details' => $request->payment_details,
            'payment_date' => $request->payment_date,
            'paid_amount' => $request->paid_amount,
        ]);

        if ($paySupplier) {
            session()->flash('success','Payment stored successfully');
        } else {
            session()->flash('error','Something was wrong!  ');
        }
        return redirect()->route('supplier_payment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paySupplier = SupplierPayment::with(['relPayment', 'relStockIn' => function($q){
                            $q->with(['relOutlet','relSupplier']);
                        }])->find($id);;

        return view('admin.inventory.supplier_payment.show',compact('paySupplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paySupplier = SupplierPayment::findOrFail($id);
        $StockIn = StockIn::with('relSupplier')->get();
        $method = Payment::get();
        $payData = [];
        foreach ($StockIn as $val) {
            $payData[$val->id] = $val->due_amount;
        }

        return view('admin.inventory.supplier_payment.edit',compact('StockIn','method', 'payData','paySupplier'));
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
        $paySupplier = SupplierPayment::where(['id'=> $id])->update([
            'receive_id' => $request->receive_id,
            'receive_due' => $request->receive_due,
            'payment_method' => $request->payment_method,
            'payment_details' => $request->payment_details,
            'payment_date' => $request->payment_date,
            'paid_amount' => $request->paid_amount,
        ]);
        if ($paySupplier) {
            session()->flash('success','Due Payment edited successfully');
        } else {
            session()->flash('error','Something was wrong!  ');
        }
        return redirect()->route('supplier_payment.index');
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

    public function duePayment($id){
        $data = StockIn::find($id);

        if($data){
            return response()->json(['status'=>'success', 'data'=>$data]);
        }
        return response()->json(['status'=>'fail']);
    }
}
