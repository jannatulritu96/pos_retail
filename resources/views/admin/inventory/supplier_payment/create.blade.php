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
                        <li class="breadcrumb-item active"><a href="#">Return to Supplier Entry</a></li>
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
                        <h4 class="card-title">Supplier Due Payment Entry Form</h4>
                        <div class="col-6 pull-left">
                            <form method="POST" class="form-horizontal" action="{{ route('supplier_payment.store') }}"  enctype="multipart/form-data">
                                @csrf
                                @include('.admin.layouts._messages')
                                <div class="box-body">
                                    <div class="form-group" style="margin-left: 5px;">
                                        <label for="receive_id">Sell Number<span
                                                style="color: red">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="receive_id" id="receive_id" required onchange="chkDue()">
                                            <option>Select due challan</option>
                                            @foreach($StockIn as $Stock)
                                                <option value="{{$Stock->id}}">{{ $Stock->challan_no }}({{ $Stock->relSupplier->name }})</option>
                                            @endforeach
                                        </select>
                                        @error('receive_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="receive_due">Due Amount</label>
                                        <input id="receive_due" type="text" name="receive_due" class="form-control @error('receive_due') is-invalid @enderror" value="" readonly>
                                        @error('receive_due')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id">Payment Method<span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="payment_method">
                                        <option>Select Payment Method</option>
                                        @foreach($method as $data)
                                            <option value="{{$data->id}}">{{ $data->method_name }}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="receive_note">Payment Details</label>
                                        <textarea type="text" rows="3" class="form-control  @error('payment_details') is-invalid @enderror" name="payment_details" id="payment_details"  placeholder="Payment Details"></textarea>
                                        @error('payment_details')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_date">Payment date<span
                                                style="color: red">*</span></label>
                                        <input id="payment_date" type="date" class="form-control @error('payment_date') is-invalid @enderror" name="payment_date" readonly value="{{ date('Y-m-d') }}">
                                        @error('payment_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_date">Paid Amount (Tk):<span
                                                style="color: red">*</span></label>
                                        <input type="number" step="any" min="0" class="form-control" name="paid_amount" id="paid_amount" value="" onkeyup="chkBill()">
                                        @error('paid_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="box-footer text-center">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="reset" class="btn btn-warning btn-flat">Clear</button>
                                        <a href="{{ route('category.index') }}" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var payData = JSON.parse('{!! json_encode($payData)  !!}');
        function chkDue() {
            var receive_id = $('#receive_id').val();
            $('#receive_due').val(payData[receive_id]);

            chkBill();
        }

        function chkBill() {
            var receive_due = $('#receive_due').val();
            var paid_amount = $('#paid_amount').val();

            if (paid_amount>receive_due) {
                $('#paid_amount').val('');
                $('#paid_amount').focus();
                alert('Check due amount and Paid amount.');
            }
        }
    </script>
@endsection
