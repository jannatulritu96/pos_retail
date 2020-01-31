<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = Unit::select('*');
        $render = [];
        if (isset($request->unit)) {
            $sql->where('unit', 'like', '%'.$request->unit.'%');
            $render['unit'] = $request->unit;
        }
        if (isset($request->status)) {
            $sql->where('status', $request->status);
            $render['status'] = $request->status;
        }

        $data = $sql->paginate(2);
        $data->appends($render);

        $status = (isset($request->status)) ? $request->status : '';



        return view('admin.settings.unit.index',compact('data','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.unit.create');
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
            'unit'=>'required',
        ]);
        $unit = Unit::create([
            'unit' => $request->unit,
        ]);
        if ($unit) {
            session()->flash('success','Unit stored successfully');
        } else {
            session()->flash('success','Unit stored successfully');
        }
        return redirect()->route('unit.index');
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
        $data['unit'] = Unit::findOrFail($id);
        return view('admin.settings.unit.edit',$data);
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
        $unit= Unit::where(['id'=> $id])->update([
            'unit' => $request->unit,
        ]);
        if ($unit) {
            session()->flash('success','Unit stored successfully');
        } else {
            session()->flash('success','Unit stored successfully');
        }
        return redirect()->route('unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Unit::findOrFail($id)->delete();


        if ($delete == 1) {
            $success = true;
            $message = "Unit deleted successfully";
        } else {
            $success = true;
            $message = "Unit not found";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function changeActivity($id)
    {
        $unit = Unit::find($id);
        $status = 0;
        if ($unit->status == 0) {
            $status = 1;
        }
        $unit = $unit->update(['status' => $status]);

        if ($unit) {
            return response()->json(['success' => true, 'Status updated Successfully', 'status' => 200], 200);
        } else {
            return response()->json(['success' => false, 'Whoops! Status not updated', 'status' => 401], 200);
        }
    }
}
