@extends('admin.layouts.master')

@section('content')

    <div class="page-breadcrumb border-bottom">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Dashboard</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Company settings form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('.admin.layouts._messages')
                            <div class="box-body">
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_name">Name<span
                                            style="color: red">*</span></label>
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Name" value="{{ old('company_name') }}" required style="width: 98%;">
                                    @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_email">Email</label>
                                    <input id="company_email" type="email" class="form-control @error('company_email') is-invalid @enderror" name="company_email" placeholder="Email" value="{{ old('company_email') }}" style="width: 98%;">
                                    @error('company_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_phone">Phone</label>
                                    <input id="company_phone" type="text" class="form-control @error('company_phone') is-invalid @enderror" name="company_phone"  placeholder="Phone" value="{{ old('company_phone') }}" style="width: 98%;">
                                    @error('company_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_logo">Logo</label>
                                    <input id="company_logo"class="form-control" type="file"  name="company_logo" style="width: 98%;">
                                    @error('company_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="currency_code">Currency code<span
                                            style="color: red">*</span></label>
                                    <input id="currency_code" type="number" class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" placeholder="Currency code" value="{{ old('currency_code') }}" required style="width: 98%;">
                                    @error('currency_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="tax">Tax</label>
                                    <input id="tax" type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Tax" value="{{ old('tax') }}" style="width: 94%;">
                                    <div class="input-group-append float-right">
                                        <span class="input-group-text" style="margin-top: -36px;margin-right: 8px;">%</span>
                                    </div>
                                    @error('tax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="vat">Vat</label>
                                    <input id="vat" type="number" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="Vat" value="{{ old('vat') }}" style="width: 94%;">
                                    <div class="input-group-append float-right">
                                        <span class="input-group-text" style="margin-top: -36px;margin-right: 8px;">%</span>
                                    </div>
                                    @error('vat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="date">Date format<span
                                            style="color: red">*</span></label>
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"  placeholder="Date format" value="{{ old('date') }}" required style="width: 98%;">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="pagination">Pagination<span
                                            style="color: red">*</span></label>
                                    <select class="select2 form-control" name="pagination" style="width: 98%; height:36px;">
                                        <option value="">Pagination</option>
                                        <option value="1">10</option>
                                        <option value="2">25</option>
                                        <option value="3">50</option>
                                        <option value="3">100</option>
                                    </select>
                                    @error('pagination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="year">Year</label>
                                    <select class="select2 form-control" name="year" style="width: 98%; height:36px;">
                                        <option value="1">Year</option>
                                        <option value="2">2019</option>
                                        <option value="3">2020</option>
                                        <option value="4">2021</option>
                                        <option value="5">2022</option>
                                        <option value="6">2023</option>
                                        <option value="7">2024</option>
                                        <option value="8">2025</option>
                                        <option value="9">2026</option>
                                        <option value="10">2027</option>
                                        <option value="11">2028</option>
                                    </select>
                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="stock_out_method">Stock out method</label>
                                    <select class="select2 form-control"  name="year" style="width: 98%; height:36px;">
                                        <option value="">Select</option>
                                        <option value="1">First In First Out</option>
                                        <option value="2">Last In First Out</option>
                                    </select>
                                    @error('stock_out_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="customer">Customer</label>
                                    <select class="form-control select2" name="customer" style="width: 100%;">
                                        <option>Select customer</option>
                                        @foreach($customer as $custom)
                                            <option value="{{$custom->id}}">{{ $custom->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="box-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


{{--<div class="page-content container-fluid">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title">Company settings form</h4>--}}
{{--                    <form method="post" class="form-horizontal" action="{{ route('setting.store',$setting) }}" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <input name="id" value="{{ $setting->id }}" type="hidden">--}}
{{--                        <div class="box-body">--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="company_name">Name<span--}}
{{--                                        style="color: red">*</span></label>--}}
{{--                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Name" value="{{ $setting->company_name }}" required style="width: 98%;">--}}
{{--                                @error('company_name')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="company_email">Email</label>--}}
{{--                                <input id="company_email" type="email" class="form-control @error('company_email') is-invalid @enderror" name="company_email" placeholder="Email" value="{{ $setting->company_email }}" style="width: 98%;">--}}
{{--                                @error('company_email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="company_phone">Phone</label>--}}
{{--                                <input id="company_phone" type="text" class="form-control @error('company_phone') is-invalid @enderror" name="company_phone"  placeholder="Phone" value="{{ $setting->company_phone }}" style="width: 98%;">--}}
{{--                                @error('company_phone')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="company_logo">Logo</label>--}}
{{--                                <input id="company_logo"class="form-control" type="file"  name="company_logo" value="{{ $setting->company_logo }}" style="width: 98%;">--}}
{{--                                @error('company_logo')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="currency_code">Currency code<span--}}
{{--                                        style="color: red">*</span></label>--}}
{{--                                <input id="currency_code" type="number" class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" placeholder="Currency code" value="{{ $setting->currency_code }}" required style="width: 98%;">--}}
{{--                                @error('currency_code')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="tax">Tax</label>--}}
{{--                                <input id="tax" type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Tax" value="{{ $setting->tax }}" style="width: 94%;">--}}
{{--                                <div class="input-group-append float-right">--}}
{{--                                    <span class="input-group-text" style="margin-top: -36px;margin-right: 8px;">%</span>--}}
{{--                                </div>--}}
{{--                                @error('tax')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="vat">Vat</label>--}}
{{--                                <input id="vat" type="number" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="Vat" value="{{ $setting->vat }}" style="width: 94%;">--}}
{{--                                <div class="input-group-append float-right">--}}
{{--                                    <span class="input-group-text" style="margin-top: -36px;margin-right: 8px;">%</span>--}}
{{--                                </div>--}}
{{--                                @error('vat')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="date">Date format<span--}}
{{--                                        style="color: red">*</span></label>--}}
{{--                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"  placeholder="Date format" value="{{ $setting->date }}" required style="width: 98%;">--}}
{{--                                @error('date')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="pagination">Pagination<span--}}
{{--                                        style="color: red">*</span></label>--}}
{{--                                <select class="select2 form-control" name="pagination" style="width: 98%; height:36px;">--}}
{{--                                    <option  value="{{ $setting->pagination }}">Pagination</option>--}}
{{--                                    <option>10</option>--}}
{{--                                    <option>25</option>--}}
{{--                                    <option>50</option>--}}
{{--                                </select>--}}
{{--                                @error('pagination')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="year">Year</label>--}}
{{--                                <select class="select2 form-control" name="year" style="width: 98%; height:36px;">--}}
{{--                                    <option value="{{ $setting->year }}">Year</option>--}}
{{--                                    <option>2019</option>--}}
{{--                                    <option>2020</option>--}}
{{--                                    <option>2021</option>--}}
{{--                                    <option>2022</option>--}}
{{--                                    <option>2023</option>--}}
{{--                                    <option>2024</option>--}}
{{--                                    <option>2025</option>--}}
{{--                                    <option>2026</option>--}}
{{--                                    <option>2027</option>--}}
{{--                                    <option>2028</option>--}}
{{--                                </select>--}}
{{--                                @error('year')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="stock_out_method">Stock out method</label>--}}
{{--                                <select class="select2 form-control"  name="stock_out_method" style="width: 98%; height:36px;">--}}
{{--                                    <option value="{{ $setting->stock_out_method }}">Select</option>--}}
{{--                                    <option>10</option>--}}
{{--                                    <option>25</option>--}}
{{--                                    <option>50</option>--}}
{{--                                </select>--}}
{{--                                @error('stock_out_method')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="margin-left: 5px;">--}}
{{--                                <label for="customer">Customer</label>--}}
{{--                                <select class="form-control select2" name="customer" style="width: 100%;">--}}
{{--                                    <option>Select customer</option>--}}
{{--                                    @foreach($customer as $custom)--}}
{{--                                        <option value="{{$custom->id}}" @if($setting->customer_id == $custom->id) selected @endif>{{ $custom->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('customer')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="box-footer pull-right">--}}
{{--                                <button type="submit" class="btn btn-primary">Update</button>--}}
{{--                                <button type="reset" class="btn btn-warning btn-flat">Clear</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


