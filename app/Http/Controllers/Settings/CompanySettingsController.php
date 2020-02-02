<?php

namespace App\Http\Controllers\Settings;

use App\CompanySetting;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanySettingsController extends Controller
{
    public function Setting()
    {
        $customer = Customer::where('status','1')->get();
        $setting = CompanySetting::find(1);
        return view('admin.settings.company.company_setting',compact('customer','setting'));
    }

    public function UpdateWebsite(Request $request)
    {
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

        $data = [
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'currency_code' => $request->currency_code,
            'tax' => $request->tax,
            'vat' => $request->vat,
            'date' => $request->date,
            'pagination' => $request->pagination,
            'year' => $request->year,
            'stock_out_method' => $request->stock_out_method,
            'customer' => $request->customer,
        ];

        if ($request->hasFile('company_logo')) {
            $setting = CompanySetting::first();
//            $old_file = $setting->company_logo;
            $photo= $request->file('company_logo');
            $photo->move('assets/company_logo/',$photo->getClientOriginalName());
            $data['company_logo'] = 'assets/company_logo/'.$photo->getClientOriginalName();
//            unlink($old_file);
        }

        $company = CompanySetting::updateOrCreate(['id' => 1], $data);
        if ($company) {
            session()->flash('success','Information stored successfully');
        } else {
            session()->flash('success','Information stored successfully');
        }
        return redirect()->back();

        //end update company logo
    }
}
