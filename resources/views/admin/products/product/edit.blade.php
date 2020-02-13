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
                        <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">product list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product edit</li>
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
                        <h4 class="card-title">Product edit form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('product.update',$product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('.admin.layouts._messages')
                            <div class="box-body">
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="category_id">Category<span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="category_id">
                                        <option>Select Category</option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->id}}" @if($product->category_id == $cat->id) selected @endif>{{ $cat->category }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="product">Product name<span
                                            style="color: red">*</span></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product name" value="{{ $product->name }}" style="width: 98%;">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="code">Product code<span
                                            style="color: red">*</span></label>
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Product code" value="{{ $product->code }}" style="width: 98%;">
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="unit">Unit<span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="unit">
                                        <option>Select unit</option>
                                        @foreach($unit as $data)
                                            <option value="{{$data->id}}" @if($product->unit == $data->id) selected @endif>{{ $data->unit }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="purchase">Purchase Price (Tk)<span
                                            style="color: red">*</span></label>
                                    <input id="purchase" type="number" class="form-control @error('purchases') is-invalid @enderror" name="purchase" placeholder="Purchase Price" value="{{ $product->purchase }}"  style="width: 98%;">
                                    @error('purchases')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="sell">Sell Price (Tk)<span
                                            style="color: red">*</span></label>
                                    <input id="sell" type="number" class="form-control @error('sell') is-invalid @enderror" name="sell" placeholder="Sell Price" value="{{ $product->sell }}" style="width: 98%;">
                                    @error('sell')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="details">Details</label>
                                    <input id="details" type="text" class="form-control @error('details') is-invalid @enderror" name="details" placeholder="Details" value="{{ $product->details }}"  style="width: 98%;">
                                    @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="image">Image</label><br>
                                    <img id="image" style="width:30%;margin-bottom: 8px;margin-left: -6px;margin-top: 8px;" src="{{ asset($product->image) }}"><br>
                                    <input name="image" type="file" accept="image/*"  required onchange="readURL(this);">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="box-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                    <a href="{{ route('product.index') }}" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
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
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection






