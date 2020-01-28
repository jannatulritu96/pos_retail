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
                        <form method="post" class="form-horizontal" action="{{ route('company-settings.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                    <label for="tax">Tax%</label>
                                    <input id="tax" type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Tax" value="{{ old('tax') }}" aria-label="Username" aria-describedby="basic-addon1" style="width: 91%;margin-left: 5px;">
                                    <div class="input-group-append" style="float: right;margin-top: -35px;">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('tax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="vat">Vat%</label>
                                    <input id="vat" type="number" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="Vat" value="{{ old('vat') }}" aria-label="Username" aria-describedby="basic-addon1" style="width: 91%;margin-left: 5px;">
                                    <div class="input-group-append" style="float: right;margin-top: -35px;">
                                        <span class="input-group-text">%</span>
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
                                <div class="form-group col-md-2">
                                    <label class="required">Pagination Per Page</label>
                                    <select class="form-control select2-hidden-accessible" name="pagination_per_page" tabindex="-1" aria-hidden="true">
                                        <option value="15" selected="">15</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 156px;">
                                        <span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-pagination_per_page-o1-container"><span class="select2-selection__rendered" id="select2-pagination_per_page-o1-container" title="15">15</span>
                                                <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span>
                                        <span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="pagination">Pagination<span
                                            style="color: red">*</span></label>
                                    <input id="pagination" type="text" class="form-control @error('pagination') is-invalid @enderror" name="pagination" placeholder="Pagination" value="{{ old('pagination') }}" required style="width: 98%;">
                                    @error('pagination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="year">Year</label>
                                    <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" placeholder="Year" value="{{ old('year') }}" style="width: 98%;">
                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="stock_out_method">Stock out method</label>
                                    <input id="stock_out_method" type="text" class="form-control @error('stock_out_method') is-invalid @enderror" name="stock_out_method" placeholder="Stock out method" value="{{ old('stock_out_method') }}" style="width: 98%;">
                                    @error('stock_out_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="customer">Customer</label>
                                    <input id="customer" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer" placeholder="Customer" value="{{ old('customer') }}" style="width: 98%;">
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




