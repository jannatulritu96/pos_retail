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
                        <li class="breadcrumb-item active" aria-current="page">Stock return show</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Return to Supplier Details</h4>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <div id="default_order_wrapper"
                                 class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="default_order" class="table table-striped border display"
                                               style="width:100%">
                                            <tbody>
                                            <tr>
                                                <th style="width:120px;">Outlet</th>
                                                <th style="width:10px;">:</th>
                                                <td>{{ $data->relStockReturn->relStockIn->relOutlet->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Supplier</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->relStockIn->relSupplier->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Receive No.</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->relStockIn->receive_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>Receive Date</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->relStockIn->receive_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Challan No.</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->relStockIn->challan_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>Challan Date</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->relStockIn->challan_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Return No.</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->return_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>Return Date</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->return_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Return Causes</th>
                                                <th>:</th>
                                                <td>{{ $data->relStockReturn->return_causes }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="default_order" class="table table-striped border display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Product</th>
                                                <th>Code</th>
                                                <th>Unit</th>
                                                <th class="text-right" align="right">Return Qty	</th>
                                                <th class="text-right" align="right">Unit Price (Tk)</th>
                                                <th class="text-right" align="right">Total Price (Tk)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->relProduct->name }}</td>
                                                    <td>{{ $data->relProduct->code }}</td>
                                                    <td>{{ $data->relProduct->relUnit->unit }}</td>
                                                    <td class="text-right" align="right">{{ $data->returning_qty }}</td>
                                                    <td class="text-right" align="right">{{ $data->relStockItem->unit_price }}</td>
                                                    <td class="text-right" align="right">{{ $data->relStockItem->total_price }}</td>
                                                </tr>
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th class="text-right" align="right" colspan="4">Total Quantity :</th>
                                                <th class="text-right" align="right">{{ $data->relStockReturn->relStockIn->total_qty }}</th>
                                                <th class="text-right" align="right">Total Amount (Tk) :</th>
                                                <th class="text-right" align="right">{{ $data->relStockReturn->relStockIn->total_amount }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


