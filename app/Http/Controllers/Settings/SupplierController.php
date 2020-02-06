<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = Supplier::select('*');
        $render = [];

        if(isset($request->search)){
            $sql->where(function ($q) use($request){
                $q->where('name', '=', $request->search)
                    ->orwhere('email', '=', $request->search)
                    ->orwhere('phone', '=', $request->search)
                    ->orwhere('fax', '=', $request->search)
                    ->orwhere('address', '=', $request->search);
            });
        }

        if (isset($request->status)) {
            $sql->where('status', $request->status);
        }

        $data = $sql->paginate(30);
        $data->appends($render);

        $status = (isset($request->status)) ? $request->status : '';

        return view('admin.settings.supplier.index',compact('data','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.supplier.create');
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
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'fax'=>'required',
            'address'=>'required',
        ]);
        $supplier = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'address' => $request->address,
        ]);
        if ($supplier) {
            session()->flash('success','Supplier stored successfully');
        } else {
            session()->flash('success','Supplier stored successfully');
        }
        return redirect()->route('supplier.index');
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
        $data['supplier'] = Supplier::findOrFail($id);
        return view('admin.settings.supplier.edit',$data);
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
        $supplier= Supplier::where(['id'=> $id])->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->phone,
            'address' => $request->address,
        ]);
        if ($supplier) {
            session()->flash('success','Supplier stored successfully');
        } else {
            session()->flash('success','Supplier stored successfully');
        }
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Supplier::findOrFail($id)->delete();


        if ($delete == 1) {
            $success = true;
            $message = "Supplier deleted successfully";
        } else {
            $success = true;
            $message = "Supplier not found";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function changeActivity($id)
    {
        $supplier = Supplier::find($id);
        $status = 0;
        if ($supplier->status == 0) {
            $status = 1;
        }
        $supplier = $supplier->update(['status' => $status]);

        if ($supplier) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
