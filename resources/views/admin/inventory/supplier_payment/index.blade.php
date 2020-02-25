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
                        <li class="breadcrumb-item active" aria-current="page">Return to Supplier list</li>
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
                                <h4 class="card-title">Supplier Due Payment List</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('supplier_payment.create') }}" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Add New Supplier Due Payment</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <div id="default_order_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="default_order_length">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-2">
                                    <form method="get" class="form-horizontal" action="{{route('supplier_payment.index')}}" >

                                        <div class="dataTables_filter">
                                            <button type="submit" class="btn btn-primary" style="float: right;margin-left: 5px;padding: 2.1px 12px;">Search</button>
                                        </div>

                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-right: 5px">
                                            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search"
                                                   value="{{Request::get('supplier_payment')}}" onchange="search_post()">
                                        </div>

                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-right: 5px">
                                            <select class="form-control form-control-sm" name="supplier" id="supplier">
                                                <option value="">All supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-right: 5px">
                                            <select class="form-control form-control-sm" name="outlet" id="outlet">
                                                <option value="">All outlet</option>
                                                @foreach($outlets as $outlet)
                                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="default_order" class="table table-striped border display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Outlet</th>
                                                <th>Supplier</th>
                                                <th class="text-center">Pay. Method</th>
                                                <th class="text-center">Challan No.</th>
                                                <th class="text-center">Challan Date</th>
                                                <th class="text-center">Payment Date</th>
                                                <th class="text-center">Due Amount (Tk)</th>
                                                <th class="text-center">Paid Amount (Tk)</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($data as $payDeu)
                                           <tr>
                                               <td>{{ $payDeu->id }}</td>
                                               <td>{{ $payDeu->relStockIn->relOutlet->name }}</td>
                                               <td>{{ $payDeu->relStockIn->relSupplier->name }}</td>
                                               <td class="text-center">{{ $payDeu->relPayment->method_name }}</td>
                                               <td class="text-center">{{ $payDeu->relStockIn->challan_no }}</td>
                                               <td class="text-center">{{ $payDeu->relStockIn->challan_date }}</td>
                                               <td class="text-center">{{ $payDeu->payment_date }}</td>
                                               <td class="text-center">{{ $payDeu->receive_due }}</td>
                                               <td class="text-center">{{ $payDeu->paid_amount }}</td>
                                               <td class="text-right">
                                                   <div class="btn-group">
                                                       <button type="button" class="btn btn-default">Action</button>
                                                       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                           <span class="caret"></span>
                                                           <span class="sr-only">Toggle Dropdown</span>
                                                       </button>
                                                       <ul class="dropdown-menu pull-right" role="menu">
                                                           <li><a class="dropdown-item" href="{{ route('supplier_payment.show',$payDeu->id) }}"><i class="fa fa-eye"></i> Show row</a></li>
                                                           <li><a class="dropdown-item" href="{{ route('supplier_payment.edit',$payDeu->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                                           <li>
                                                               <div role="separator" class="dropdown-divider"></div>
                                                           </li>
                                                           <li>
                                                               <a type="button"  onclick="deleteconfirm('{{ $payDeu->id }}')" style="margin-left: 20px;color: rebeccapurple;"><i class="fa fa-trash"></i>Delete</a>
                                                           </li>
                                                       </ul>
                                                   </div>
                                               </td>
                                           </tr>
                                       @endforeach
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
@section('script')
    <script>
        function deleteconfirm(id) {
            swal({
                title: "Delete?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    $.ajax({
                        type: 'POST',
                        url: "stock_return/destroy/" + id,
                        data: {_token: '{{  @csrf_token() }}' },
                        dataType: 'JSON',
                        success: function (results) {

                            if (results.success === true) {
                                swal("Done!", results.message, "success").then(function () {

                                    window.location.reload()
                                })
                            } else {
                                swal("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
    </script>
@endsection
