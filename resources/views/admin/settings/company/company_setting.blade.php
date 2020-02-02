

@extends('admin.layouts.master')

@section('content')

    <div class="page-breadcrumb border-bottom">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Point of Sales</h5>
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
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Name" value="{{ !empty($setting)?$setting->company_name:'' }}" required style="width: 98%;">
                                    @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_email">Email</label>
                                    <input id="company_email" type="email" class="form-control @error('company_email') is-invalid @enderror" name="company_email" placeholder="Email" value="{{ !empty($setting)?$setting->company_email:'' }}" style="width: 98%;">
                                    @error('company_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_phone">Phone</label>
                                    <input id="company_phone" type="text" class="form-control @error('company_phone') is-invalid @enderror" name="company_phone"  placeholder="Phone" value="{{ !empty($setting)?$setting->company_phone:'' }}" style="width: 98%;">
                                    @error('company_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_logo">Logo</label><br>
                                    <img id="company_logo" style="width:20%;margin-bottom: 8px;margin-left: -6px;margin-top: 8px;" src="{{ asset(!empty($setting)?$setting->company_logo:'') }}"><br>
                                    <input type="file"  name="company_logo"  accept="image/*" onchange="readURL(this);">
                                </div>

                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="currency_code">Currency code<span
                                            style="color: red">*</span></label>
                                    <input id="currency_code" type="number" class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" placeholder="Currency code" value="{{ !empty($setting)?$setting->currency_code:'' }}" required style="width: 98%;">
                                    @error('currency_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
<<<<<<< HEAD
                                    <label for="tax">Tax%</label>
                                    <input id="tax" type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Tax" value="{{ old('tax') }}" aria-label="Username" aria-describedby="basic-addon1" style="width: 91%;margin-left: 5px;">
                                    <div class="input-group-append" style="float: right;margin-top: -35px;">
                                        <span class="input-group-text">%</span>
=======
                                    <label for="tax">Tax</label>
                                    <input id="tax" type="number" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Tax" value="{{ !empty($setting)?$setting->tax:'' }}" style="width: 94%;">
                                    <div class="input-group-append float-right">
                                        <span class="input-group-text" style="margin-top: -36px;margin-right: 8px;">%</span>
>>>>>>> 402c34e047a695cbea41aaa1a470de8e739a1dd7
                                    </div>
                                    @error('tax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
<<<<<<< HEAD
                                    <label for="vat">Vat%</label>
                                    <input id="vat" type="number" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="Vat" value="{{ old('vat') }}" aria-label="Username" aria-describedby="basic-addon1" style="width: 91%;margin-left: 5px;">
                                    <div class="input-group-append" style="float: right;margin-top: -35px;">
                                        <span class="input-group-text">%</span>
=======
                                    <label for="vat">Vat</label>
                                    <input id="vat" type="number" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="Vat" value="{{ !empty($setting)?$setting->vat:'' }}" style="width: 94%;">
                                    <div class="input-group-append float-right">
                                        <span class="input-group-text" style="margin-top: -36px;margin-right: 8px;">%</span>
>>>>>>> 402c34e047a695cbea41aaa1a470de8e739a1dd7
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
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"  placeholder="Date format" value="{{ !empty($setting)?$setting->date:'' }}" required style="width: 98%;">
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
                                    <select class="select2 form-control" name="pagination" value="{{ !empty($setting)?$setting->pagination:'' }}" style="width: 98%; height:36px;">
                                        <option value="1" @if(isset($setting) && $setting->pagination == 1 ) selected @endif>Pagination</option>
                                        <option value="2" @if(isset($setting) &&  $setting->pagination == 2 ) selected @endif>10</option>
                                        <option value="3" @if(isset($setting) &&  $setting->pagination == 3 ) selected @endif>25</option>
                                        <option value="4" @if(isset($setting) &&  $setting->pagination == 4 ) selected @endif>50</option>
                                        <option value="5" @if(isset($setting) &&  $setting->pagination == 5 ) selected @endif>100</option>
                                    </select>
                                    @error('pagination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="year">Year</label>
                                    <select class="select2 form-control" name="year" value="{{ !empty($setting)?$setting->year:'' }}" style="width: 98%; height:36px;">
                                        <option value="1"  @if(isset($setting) &&  $setting->year == 1 ) selected @endif>Year</option>
                                        <option value="2"  @if(isset($setting) &&  $setting->year == 2 ) selected @endif>2019</option>
                                        <option value="3"  @if(isset($setting) &&  $setting->year == 3 ) selected @endif>2020</option>
                                        <option value="4"  @if(isset($setting) &&  $setting->year == 4 ) selected @endif>2021</option>
                                        <option value="5"  @if(isset($setting) &&  $setting->year == 5 ) selected @endif>2022</option>
                                        <option value="6"  @if(isset($setting) &&  $setting->year == 6 ) selected @endif>2023</option>
                                        <option value="7"  @if(isset($setting) &&  $setting->year == 7 ) selected @endif>2024</option>
                                        <option value="8"  @if(isset($setting) &&  $setting->year == 8 ) selected @endif>2025</option>
                                        <option value="9"  @if(isset($setting) &&  $setting->year == 9 ) selected @endif>2026</option>
                                        <option value="10" @if(isset($setting) &&  $setting->year == 10 ) selected @endif>2027</option>
                                        <option value="11" @if(isset($setting) &&  $setting->year == 11) selected @endif>2028</option>
                                    </select>
                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="stock_out_method">Stock out method</label>
                                    <select class="select2 form-control"  name="stock_out_method" value="{{ !empty($setting)?$setting->stock_out_method:'' }}" style="width: 98%; height:36px;">
                                        <option value="1" @if(isset($setting) &&  $setting->stock_out_method == 1 ) selected @endif>Select</option>
                                        <option value="2" @if(isset($setting) &&  $setting->stock_out_method == 2 ) selected @endif>First In First Out</option>
                                        <option value="3" @if(isset($setting) &&  $setting->stock_out_method == 3 ) selected @endif>Last In First Out</option>
                                    </select>
                                    @error('stock_out_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="customer">Customer</label>
                                    <select class="form-control select2" name="customer" value="{{ !empty($setting)?$setting->customer:'' }}" style="width: 100%;">
                                        <option>Select customer</option>
                                        @foreach($customer as $custom)
                                            <option value="{{$custom->id}}" @if(isset($setting) &&  $setting->customer == $custom->id) selected @endif>{{ $custom->name }}</option>
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
@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#company_logo')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
