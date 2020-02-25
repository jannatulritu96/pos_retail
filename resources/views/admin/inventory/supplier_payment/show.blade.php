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
                        <li class="breadcrumb-item active" aria-current="page">Supplier Due Payment List</li>
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
                                    <h4 class="card-title">Supplier Due Payment Details</h4>
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
                                                <th>Outlet</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->relStockIn->relOutlet->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Supplier</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->relStockIn->relSupplier->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Method</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->relPayment->method_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Challan No.</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->relStockIn->challan_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>Challan Date</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->relStockIn->challan_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Date</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->payment_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Due Amount</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->receive_due }}</td>
                                            </tr>
                                            <tr>
                                                <th>Paid Amount</th>
                                                <th>:</th>
                                                <td>{{ $paySupplier->paid_amount }}</td>
                                            </tr>
                                            </tbody>
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


