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
                        <li class="breadcrumb-item active"><a href="{{ route('expense.index') }}">Expense list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Expense create</li>
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
                        <h4 class="card-title">Expense create form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('expense.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('.admin.layouts._messages')
                            <div class="box-body">
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="outlet">Outlet<span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="outlet">
                                        <option>Select outlet</option>
                                        @foreach($outlets as $outlet)
                                            <option value="{{$outlet->id}}">{{ $outlet->name }}</option>
                                        @endforeach
                                    </select>
                                   @error('outlet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="file">File</label>
                                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file"  value="{{ old('file') }}"  style="width: 98%;">
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="expense_no">Expense no.</label>
                                        <input id="expense_no" type="text" class="form-control @error('expense_no') is-invalid @enderror" name="expense_no" placeholder="Expense no" value="{{ old('expense_no') }}"  style="width: 98%;">
                                        @error('expense_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="expense_date">Expense date<span
                                                style="color: red">*</span></label>
                                        <input id="expense_date" type="date" class="form-control @error('expense_date') is-invalid @enderror" name="expense_date" value="{{ old('expense_no') }}"  style="width: 98%;">
                                        @error('expense_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="note">Note</label>
                                        <textarea id="note" type="text" rows="3" class="form-control  @error('note') is-invalid @enderror" name="note"  placeholder="Note" value="{{ old('note') }}" style="width: 98%;"></textarea>
                                       @error('note')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="exp_cat">Expense category</label>
                                        <select class="form-control select2" style="width: 100%;" name="exp_cat">
                                            <option>Select expense category</option>
                                            @foreach($exp_cats as $exp_cat)
                                                <option value="{{$exp_cat->id}}">{{ $exp_cat->cat_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('exp_cat')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="amount">Amount</label>
                                        <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Amount" value="{{ old('amount') }}"  style="width: 98%;">
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="box-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                    <a href="{{ route('expense_category.index') }}" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




