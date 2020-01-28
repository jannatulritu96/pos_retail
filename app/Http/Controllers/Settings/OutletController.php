<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets= Outlet::get();
        return view('admin.settings.outlet.index',compact('outlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.outlet.create');
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
        $outlet = Outlet::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'address' => $request->address,
            'code' => $request->code,
            'receipt_header' => $request->receipt_header,
            'receipt_footer' => $request->receipt_footer,
        ]);
        if ($outlet) {
            session()->flash('success','Outlet stored successfully');
        } else {
            session()->flash('success','Outlet stored successfully');
        }
        return redirect()->route('outlet.index');
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
        $data['outlet'] = Outlet::findOrFail($id);
        return view('admin.settings.outlet.edit',$data);
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
        $outlet= Outlet::where(['id'=> $id])->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'address' => $request->address,
            'code' => $request->code,
            'receipt_header' => $request->receipt_header,
            'receipt_footer' => $request->receipt_footer,
        ]);
        if ($outlet) {
            session()->flash('success','Outlet stored successfully');
        } else {
            session()->flash('success','Outlet stored successfully');
        }
        return redirect()->route('outlet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Outlet::findOrFail($id)->delete();


        if ($delete == 1) {
            $success = true;
            $message = "Outlet deleted successfully";
        } else {
            $success = true;
            $message = "Outlet not found";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function changeActivity($id)
    {
        $outlet = Outlet::find($id);
        $status = 0;
        if ($outlet->status == 0) {
            $status = 1;
        }
        $outlet = $outlet->update(['status' => $status]);

        if ($outlet) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
