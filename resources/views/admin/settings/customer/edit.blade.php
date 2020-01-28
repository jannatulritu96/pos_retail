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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('customer.index') }}">Customer list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer create</li>
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
                        <h4 class="card-title">Customer create form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('customer.update',$customer) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.layouts._messages')
                            <div class="box-body">
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="name">Name<span
                                            style="color: red">*</span></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $customer->name }}"  style="width: 98%;">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $customer->email }}" style="width: 98%;">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="company_phone">Phone</label>
                                    <input id="company_phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  placeholder="Phone" value="{{ $customer->phone }}" style="width: 98%;">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="address">Address</label>
                                    <input id="address" type="text" rows="3" class="form-control  @error('address') is-invalid @enderror" name="address"  placeholder="Address" value="{{ $customer->address }}" style="width: 98%;"></input>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="box-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                    <a href="{{ route('customer.index') }}" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





