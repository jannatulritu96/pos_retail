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
                        <li class="breadcrumb-item active"><a href="{{ route('stock_in.index') }}">Stock list</a></li>
                        <li class="breadcrumb-item active"><a href="#">Return to Supplier edit</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Return to Supplier edit Form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('stock_return.update',$stock) }}"
                              id="form_stock" enctype="multipart/form-data">
                            @csrf
                            @include('.admin.layouts._messages')
                            <div class="col-md-12">
                                <div class="row">
{{--                                    {{ dd($stock) }}--}}
                                    <input type="hidden" name="stock_in_id" value="{{ $stock->stock_in_id }}">
                                    <input type="hidden" name="return_no" value="{{ $stock->return_no }}">
                                    <div class="form-group col-md-3">
                                        <label for="outlet">Outlet<span
                                                style="color: red">*</span></label>
                                        <input id="outlet" type="text" class="form-control" name="outlet" value="{{ $stock->relOutlet->name }}" readonly>
                                        <input type="hidden" name="outlet[]" value="{{ $stock->outlet }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="supplier">Supplier<span
                                                style="color: red">*</span></label>
                                        <input id="receive_no" type="text" class="form-control" value="{{ $stock->relStockIn->relSupplier->name }}" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="receive_no">Receive No.</label>
                                        <input id="receive_no" type="text" class="form-control" name="receive_no" placeholder="Auto generated" value="{{ $stock->relStockIn->receive_no }}" readonly>
                                        @error('receive_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="receive_date">Receive date</label>
                                        <input id="receive_date" type="date" class="form-control" name="receive_date"  readonly value="{{ $stock->relStockIn->receive_date }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="challan_no">Challan No.</label>
                                        <input id="challan_no" type="text" class="form-control" name="challan_no" placeholder="Challan No." value="{{ $stock->relStockIn->challan_no }}"  readonly>
                                        @error('challan_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="challan_date">Challan date</label>
                                        <input id="challan_date" type="date" class="form-control" name="challan_date" value="{{ $stock->relStockIn->challan_date }}"  readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="return_no">Return No.</label>
                                        <input id="return_no" type="number" class="form-control" name="return_no" value="{{ $stock->return_no }}" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="return_date">Return date<span
                                                style="color: red">*</span></label>
                                        <input id="return_date" type="date" class="form-control"  name="return_date" value="{{ $stock->return_date }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="return_causes">Return Causes<span
                                        style="color: red">*</span></label>
                                <textarea type="text" rows="3" class="form-control" name="return_causes[]" id="return_causes" placeholder="Return Causes">{{ $stock->return_causes }}</textarea>
                                @error('return_causes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="col-md-12" id="productDiv">
                                @foreach($stockItem as $key => $item)
                                    <div class="row" id="productRow0">
                                        <div class="form-group col-md-3">
                                            <label for="product">Product</label>
                                            <input id="product" type="text" class="form-control" name="product" value="{{ $item->relProduct->name }}" readonly>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="unit">Unit</label>
                                            <input id="unit" type="text" class="form-control" name="unit" value="{{ $item->relProduct->relUnit->unit}}" readonly>
                                        </div>
                                        <div class="form-group  col-md-1">
                                            <label for="unit_price">Unit Price (Tk)</label>
                                            <input type="number" class="form-control" value="{{ $item->unit_price }}" id="unit_price0" readonly>
                                            @error('unit_price')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="rcv_qty">Receive Qty</label>
                                            <input type="number" class="form-control" value="{{ $item->rcv_qty }}" id="rcv_qty0" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="returning_qty">Returned Qty</label>
                                            <input class="form-control" readonly value="{{ $item->returnedQty }}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="rem_qty">Rem. Qty</label>
                                            <input type="number" class="form-control" value="{{ $item->rcv_qty }}" id="rem_qty{{$key}}" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="returning_qty">Returning Qty</label>
                                            <input type="number" step="any" min="0" class="form-control" name="returning_qty[]" id="returning_qty{{$key}}" onkeyup="chkQty({{$key}})" required>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3"></div>
                                        <div class="form-group col-md-3"></div>
                                        <div class="form-group col-md-3"></div>
                                        <div class="form-group col-md-1"></div>
                                        <div class="form-group col-md-2">
                                            <label for="total_qty">Total Qty</label>
                                            <input type="number" class="form-control  @error('total_qty') is-invalid @enderror" name="total_qty" id="total_qty" readonly />
                                            @error('total_qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                <a href="{{ route('stock_in.index') }}" class="btn btn-danger btn-flat">
                                    <span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            chkQty(0);
        });

        function chkQty(key) {
            var rem_qty = Number($('#rem_qty'+key).val());
            var returning_qty = Number($('#returning_qty'+key).val());

            if (returning_qty>rem_qty) {
                alert('You can not set return quantity greater then remaining quantity.');
                $('#returning_qty' + key).val('');
                $('#returning_qty' + key).focus();
            }

            var total_qty = 0;
            $("input[id^='returning_qty']").each(function () {
                total_qty += +$(this).val();
            });
            $('#total_qty').val(total_qty.toFixed(2));

            if (total_qty > 0) {
                $("input[id^='returning_qty']").removeAttr('required', 'required');
            } else {
                $("input[id^='returning_qty']").attr('required', 'required');
            }
        }
    </script>
@endsection
