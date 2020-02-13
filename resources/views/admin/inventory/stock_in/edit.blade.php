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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('purchases.index') }}">Purchases list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Purchases edit</li>
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
                        <h4 class="card-title">Purchases edit form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('purchases.update',$purchases) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.layouts._messages')
                            <div class="box-body">
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="outlet">Outlet<span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="outlet">
                                        <option>Select outlet</option>
                                        @foreach($outlets as $outlet)
                                            <option value="{{$outlet->id}}" @if($purchases->outlet == $outlet->id) selected @endif>{{ $outlet->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('outlet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="outlet">Supplier<span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="supplier">
                                        <option>Select supplier</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}" @if($purchases->supplier == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="purchases_no">Purchases No.</label>
                                        <input id="purchases_no" type="text" class="form-control @error('purchases_no') is-invalid @enderror" name="purchases_no" placeholder="Expense no"  value="{{ $purchases->purchases_no }}">
                                        @error('purchases_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="purchases_date">Purchases date<span
                                                style="color: red">*</span></label>
                                        <input id="purchases_date" type="date" class="form-control @error('purchases_date') is-invalid @enderror" name="purchases_date"  value="{{ $purchases->purchases_date }}">
                                        @error('purchases_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="note">Note</label>
                                        <textarea id="note" type="text" rows="3" class="form-control  @error('note') is-invalid @enderror" name="note"  placeholder="Note">{{ $purchases->note }}</textarea>
                                        @error('note')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="product">Product</label>
                                        <select class="form-control select2" style="width: 100%;" name="product">
                                            <option>Select product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" @if($purchases->product == $product->id) selected @endif>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="quantity">Quantity</label>
                                        <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Amount"  value="{{ $purchases->quantity }}">
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="box-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                    <a href="{{ route('purchases.index') }}" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection









