<?php

namespace App\Http\Controllers\Inventory;

use App\Outlet;
use App\Product;
use App\Purchases;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = Purchases::with(['relOutlet','relProduct','relSupplier'])->select('*');
        $products = Product::where('status','1')->get();
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

        if (isset($request->status)) {
            $sql->where('status', $request->status);
            $render['status'] = $request->status;
        }

        $data = $sql->paginate(30);
        $data->appends($render);

        $status = (isset($request->status)) ? $request->status : '';

        return view('admin.inventory.purchases.index',compact('data','products','outlets','status','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::where('status','1')->get();
        $suppliers = Supplier::where('status','1')->get();
        $products = Product::where('status','1')->get();

        return view('admin.inventory.purchases.create',compact('outlets','suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'outlet'=>'required',
            'supplier'=>'required',
            'purchases_no'=>'required',
            'purchases_date'=>'required',
            'note'=>'required',
            'product'=>'required',
            'quantity'=>'required',
        ]);

        $purchases = Purchases::create([
            'outlet' => $request->outlet,
            'supplier' => $request->supplier,
            'purchases_no' => $request->purchases_no,
            'purchases_date' => $request->purchases_date,
            'note' => $request->note,
            'product' => $request->product,
            'quantity' => $request->quantity,
        ]);

        if ($purchases) {
            session()->flash('success','Category stored successfully');
        } else {
            session()->flash('error','Something was wrong!  ');
        }
        return redirect()->route('purchases.index');

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
        $purchases = Purchases::findOrFail($id);
        $outlets = Outlet::where('status','1')->get();
        $suppliers = Supplier::where('status','1')->get();
        $products = Product::where('status','1')->get();

        return view('admin.inventory.purchases.edit',compact('purchases','outlets','suppliers','products'));
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

//        dd($request->all());
        $purchases = Purchases::where(['id'=> $id])->update([
            'outlet' => $request->outlet,
            'supplier' => $request->supplier,
            'purchases_no' => $request->purchases_no,
            'purchases_date' => $request->purchases_date,
            'note' => $request->note,
            'product' => $request->product,
            'quantity' => $request->quantity,
        ]);
        if ($purchases) {
            session()->flash('success','Purchases stored successfully');
        } else {
            session()->flash('error','Something was wrong!  ');
        }
        return redirect()->route('purchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Purchases::findOrFail($id)->delete();

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
    public function changeActivity($id)
    {
        $purchases = Purchases::find($id);
        $status = 0;
        if ($purchases->status == 0) {
            $status = 1;
        }
        $purchases = $purchases->update(['status' => $status]);

        if ($purchases) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
