<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = Payment::select('*');

        $render = [];
        if (isset($request->method_name)) {
            $sql->where('method_name', 'like', '%'.$request->method_name.'%');
            $render['method_name'] = $request->method_name;
        }
        if (isset($request->status)) {
            $sql->where('status', $request->status);
            $render['status'] = $request->status;
        }

        $data = $sql->paginate(2);
        $data->appends($render);

        $status = (isset($request->status)) ? $request->status : '';
        return view('admin.settings.payment.index',compact('data','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.payment.create');
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
            'method_name'=>'required',
        ]);
        $payment = Payment::create([
            'method_name' => $request->method_name,
        ]);
        if ($payment) {
            session()->flash('success','Payment stored successfully');
        } else {
            session()->flash('success','Payment stored successfully');
        }
        return redirect()->route('payment.index');
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
        $data['payment'] = Payment::findOrFail($id);
        return view('admin.settings.payment.edit',$data);
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
        $payment= Payment::where(['id'=> $id])->update([
            'method_name' => $request->method_name,
        ]);
        if ($payment) {
            session()->flash('success','Payment stored successfully');
        } else {
            session()->flash('success','Payment stored successfully');
        }
        return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Payment::findOrFail($id)->delete();


        if ($delete == 1) {
            $success = true;
            $message = "Payment deleted successfully";
        } else {
            $success = true;
            $message = "Payment not found";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function changeActivity($id)
    {
        $payment = Payment::find($id);
        $status = 0;
        if ($payment->status == 0) {
            $status = 1;
        }
        $payment = $payment->update(['status' => $status]);

        if ($payment) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
