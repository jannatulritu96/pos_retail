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
                        <li class="breadcrumb-item active"><a href="{{ route('stock_in.index') }}">Stock In (Receive) list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Stock In (Receive) create</li>
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
                        <h4 class="card-title">Stock In (Receive) create form</h4>
                        <form method="post" class="form-horizontal" action="{{ route('stock_in.store') }}" id="form_stock" enctype="multipart/form-data">
                            @csrf
                            @include('.admin.layouts._messages')
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="outlet">Outlet<span
                                                style="color: red">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="outlet" required>
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

                                    <div class="form-group col-md-3">
                                        <label for="supplier">Supplier<span
                                                style="color: red">*</span></label>
                                        <select class="form-control select2" style="width: 90%;" name="supplier">
                                            <option>Select supplier</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}" required>{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('outlet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="receive_no">Receive No.</label>
                                        <input id="receive_no" type="text" class="form-control @error('receive_no') is-invalid @enderror"  name="receive_no" placeholder="Auto generated" value="" readonly>
                                        @error('receive_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="stock_in_date">Receive date<span
                                                style="color: red">*</span></label>
                                        <input id="receive_date" type="date" class="form-control @error('receive_date') is-invalid @enderror" name="receive_date" readonly value="{{ date('Y-m-d') }}">
                                        @error('receive_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-3" style="margin-left: 5px;">
                                        <label for="note">Challan No.<span
                                                style="color: red">*</span></label>
                                        <input id="challan_no" type="text" class="form-control  @error('challan_no') is-invalid @enderror" name="challan_no"  placeholder="Challan No." value="{{ old('challan_no') }}" required>
                                        @error('challan_no')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3" style="margin-left: 5px;">
                                        <label for="stock_in_date">Challan date<span
                                                style="color: red">*</span></label>
                                        <input id="receive_date" type="date" class="form-control @error('challan_date') is-invalid @enderror" name="challan_date" value="{{ old('challan_date') }}"  required>
                                        @error('challan_date')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="stock_in_date">Challan Document</label>
                                        <input id="challan_doc" type="file" class="form-control @error('challan_doc') is-invalid @enderror" name="challan_doc" placeholder="Challan Document" value="{{ old('challan_doc') }}">
                                        @error('challan_doc')
                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receive_note">Receive note</label>
                                <textarea type="text" rows="3" class="form-control  @error('receive_note') is-invalid @enderror" name="receive_note"  id="receive_note" placeholder="Receive note" value="{{ old('receive_note') }}" style="width: 98%;"></textarea>
                                @error('receive_note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="col-md-12" id="productDiv">
                                <div class="row" id="productRow0">
                                    <div class="form-group col-md-1 mt-4">
                                        <label class="visible-xs invisible">+</label>
                                        <a class="btn btn-warning btn-flat" onclick="addRow()">+</a>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="product">Product</label>
                                        <select class="form-control select2" style="width: 100%;" name="product[0][product]" id="product0">
                                            <option>Select product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="note">Receive Quantity</label>
                                        <input type="number" class="form-control  @error('rcv_qty') is-invalid @enderror" name="product[0][rcv_qty]" id="rcv_qty0" placeholder="Receive Quantity" onkeyup="chkPrice(0)">
                                        @error('rcv_qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <label for="unit_price">Unit Price (Tk)</label>
                                        <input type="number" class="form-control  @error('unit_price') is-invalid @enderror" name="product[0][unit_price]" id="unit_price0" placeholder="Unit Price (Tk)" onkeyup="chkPrice(0)">
                                        @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 float-right">
                                        <label for="total_price">Total Price (Tk)</label>
                                        <input type="number" class="form-control  @error('total_price') is-invalid @enderror" name="product[0][total_price]" id="total_price0" placeholder="Total Price (Tk)" readonly>
                                        @error('total_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-2"></div>
                                    <div class="form-group col-md-2"></div>
                                    <div class="form-group col-md-3">
                                        <label for="total_qty">Total Qty</label>
                                        <input type="number" class="form-control  @error('total_qty') is-invalid @enderror" name="total_qty" id="total_qty" placeholder="Total Quantity" readonly>
                                        @error('total_qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2"></div>
                                    <div class="form-group col-md-3">
                                        <label for="total_amount">Total Amount(Tk)</label>
                                        <input type="number" class="form-control  @error('total_amount') is-invalid @enderror" name="total_amount" id="total_amount" placeholder="Total Amount(Tk)" readonly>
                                        @error('total_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-3"></div>
                                    <div class="form-group col-md-3"></div>
                                    <div class="form-group col-md-3"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tax">Tax(15.00%) (Tk)</label>
                                            <input type="number" class="form-control  @error('tax') is-invalid @enderror" name="tax" id="tax" placeholder="Tax(15.00%) (Tk)" readonly>
                                            @error('tax')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="discount_amount">Discount Amount(Tk)</label>
                                            <input type="number" class="form-control  @error('discount_amount') is-invalid @enderror" name="discount_amount" id="discount_amount" placeholder="Discount Amount(Tk)" onkeyup="totalCal()">
                                        </div>
                                        <div class="form-group">
                                            <label for="payable_amount">Payable Amount(Tk)</label>
                                            <input type="number" class="form-control  @error('payable_amount') is-invalid @enderror" name="payable_amount" id="payable_amount" placeholder="Payable Amount(Tk)" readonly>
                                            @error('payable_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="paid_amount">Paid Amount(Tk)</label>
                                            <input type="number" class="form-control  @error('paid_amount') is-invalid @enderror" name="paid_amount" id="paid_amount" placeholder="Paid Amount(Tk)" onkeyup="totalCal()">
                                            @error('paid_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="due_amount">Due Amount(Tk)</label>
                                            <input type="number" class="form-control  @error('due_amount') is-invalid @enderror" name="due_amount" id="due_amount" placeholder="Due Amount(Tk)" readonly>
                                            @error('due_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
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


    <section class="content">
        <!-- /.modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title pull-right">New Supplier Entry</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="margin-left: 5px;">
                            <label class="required">Name</label>
                            <input type="text" class="form-control" name="supplier_name" required>
                        </div>
                        <div class="form-group" style="margin-left: 5px;">
                            <label>Email</label>
                            <input type="email" class="form-control" name="supplier_email">
                        </div>
                        <div class="form-group" style="margin-left: 5px;">
                            <label class="required">Mobile</label>
                            <input type="text" class="form-control" name="supplier_mobile" required>
                        </div>
                        <div class="form-group" style="margin-left: 5px;">
                            <label>Fax</label>
                            <input type="text" class="form-control" name="supplier_fax">
                        </div>
                        <div class="form-group" style="margin-left: 5px;">
                            <label class="required">Address</label>
                            <textarea type="text" class="form-control" name="supplier_address" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-primary btn-flat">Save as New</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var i = 1;
        function addRow() {
            var productOptions = $('#product0').html();
            var productDiv = $('#productDiv .row').length;

            var html = `<div class="row" id="productRow`+productDiv+`">`;
            if(productDiv > 0) {
                html += `<div class="form-group col-md-1 mt-4">
                    <label class="visible-xs invisible">X</label>
                    <a class="btn btn-warning btn-flat" onclick="removeRow(`+productDiv+`)">X</a>
                </div>`;
            } else {
                html += `<div class="form-group col-md-1 mt-4">
                    <label class="visible-xs invisible">+</label>
                    <a class="btn btn-warning btn-flat" onclick="addRow()">+</a>
                </div>`;
            }

            html += `<div class="form-group col-md-3">
                        <label for="product">Product</label>
                        <select class="form-control select2" style="width: 100%;" name="product[`+ i +`][product]" id="product`+productDiv+`" onchange="setUnitPrice(`+productDiv+`)">
                            `+productOptions+`
                        </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="note">Receive Quantity</label>
                            <input type="number" class="form-control" name="product[`+ i +`][rcv_qty]" id="rcv_qty`+productDiv+`" placeholder="Receive Quantity" onkeyup="chkPrice(`+productDiv+`)">
                        </div>
                        <div class="form-group  col-md-2">
                            <label for="unit_price">Unit Price (Tk)</label>
                            <input type="number" class="form-control" name="product[`+ i +`][unit_price]" id="unit_price`+productDiv+`" placeholder="Unit Price (Tk)" onkeyup="chkPrice(`+productDiv+`)">
                        </div>
                        <div class="form-group col-md-3 float-right">
                            <label for="total_price">Total Price (Tk)</label>
                            <input type="number" class="form-control" name="product[`+ i +`][total_price]" id="total_price`+productDiv+`" placeholder="Total Price (Tk)" readonly>
                        </div>
                    </div>`;

            $('#productDiv').append(html);
            i++;
            $('#product'+productDiv).val('');
        }

        function removeRow(productDiv) {
            $('#productRow'+productDiv).remove();
        }

        function chkPrice(key) {
            var rcv_qty = Number($('#rcv_qty'+key).val());
            var unit_price = Number($('#unit_price'+key).val());

            var total_price = (rcv_qty*unit_price)
            $('#total_price'+key).val(total_price.toFixed(2));

            totalCal();
        }

        function totalCal() {
            var rcv_qty = 0;
            $("input[id^= 'rcv_qty']").each(function(){
                rcv_qty += +$(this).val();
            });
            $('#total_qty').val(rcv_qty.toFixed(2));

            var total_price = 0;
            $("input[id^= 'total_price']").each(function(){
                total_price += +$(this).val();
            });
            $('#total_amount').val(total_price.toFixed(2));

            var tax = ((total_price*15)/100);
            $('#tax').val(tax.toFixed(2));

            var discount_amount = Number($('#discount_amount').val());

            var payable_amount = ((total_price+tax)-discount_amount);
            $('#payable_amount').val(payable_amount.toFixed(2));

            var paid_amount = Number($('#paid_amount').val());

            var due_amount = (payable_amount-paid_amount);
            $('#due_amount').val(due_amount.toFixed(2));
        }
    </script>
@endsection
