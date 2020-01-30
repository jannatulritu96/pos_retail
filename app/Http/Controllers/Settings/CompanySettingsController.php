<?php

namespace App\Http\Controllers\Settings;

use App\CompanySetting;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanySettingsController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        return view('admin.settings.company.company_setting');
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//
//        $customer = Customer::where('status','Active')->get();
//        $setting = CompanySetting::findOrFail($id);
//        return view('admin.settings.company.company_setting',compact('customer','setting'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }

    public function Setting()
    {
        $customer = Customer::where('status','1')->get();
        $setting = CompanySetting::first();
        return view('admin.settings.company.company_setting',compact('customer','setting'));

    }
    public function UpdateWebsite(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'company_name'=>'required',
            'company_email'=>'required',
            'company_phone'=>'required',
            'currency_code'=>'required',
            'tax'=>'required',
            'vat'=>'required',
            'date'=>'required',
            'pagination'=>'required',
            'year'=>'required',
            'stock_out_method'=>'required',
            'customer'=>'required',
//            'company_logo'=>'mimes:png,jpg,jpeg'
        ]);

//        $setting= CompanySetting::CreateOrUpdate();
        $setting = new CompanySetting();
        $setting->company_name= $request->company_name;
        $setting->company_email= $request->company_email;
        $setting->company_phone= $request->company_phone;
        $setting->currency_code= $request->currency_code;
        $setting->tax= $request->tax;
        $setting->vat= $request->vat;
        $setting->date= $request->date;
        $setting->pagination= $request->pagination;
        $setting->year= $request->year;
        $setting->stock_out_method= $request->stock_out_method;
        $setting->customer= $request->customer;

        if($request->hasFile('company_logo'))
        {
            $setting= CompanySetting::first();
//            $old_file=$setting->company_logo;
            $image= $request->file('company_logo');
            $image->move('assets',$image->getClientOriginalName());

            $setting->company_logo= 'assets/'.$image->getClientOriginalName();
//            unlink($old_file);
        }
        $setting->save();
        if ($setting) {
            session()->flash('success','Information stored successfully');
        } else {
            session()->flash('success','Information stored successfully');
        }
        return redirect()->back();

        //end update company logo
    }
}
