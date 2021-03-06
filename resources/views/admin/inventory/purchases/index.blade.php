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
                        <li class="breadcrumb-item active" aria-current="page">Purchase list</li>
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
                                <h4 class="card-title">Purchase list</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('purchases.create') }}" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Add New Purchase</a>
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
                                <div class="col-sm-12 col-md-6">
                                    <form method="get" class="form-horizontal" action="{{route('purchases.index')}}" >

                                        <div class="dataTables_filter">
                                            <button type="submit" class="btn btn-primary" style="float: right;margin-left: 5px;padding: 2.1px 12px;">Search</button>
                                        </div>
                                        <div id="default_order_filter" class="dataTables_filter mb-2" style="float: right;">
                                            <select class="form-control form-control-sm" name="status">
                                                <option value="">Select Status</option>
                                                <option value="1" @if($status == '1') selected @endif>Active</option>
                                                <option value="0" @if($status == '0') selected @endif>Inactive</option>
                                            </select>
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
                                                <th class="text-center">Purchase No.</th>
                                                <th class="text-center">Purchase Date</th>
                                                <th class="text-center">Purchase Qty</th>
            {{--                                    <th>Received Qty</th>--}}
                                                <th class="text-center">Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $purchase)
                                            <tr>
                                                <td>{{ $purchase->id }}</td>
                                                <td>{{ $purchase->relOutlet->name }}</td>
                                                <td>{{ $purchase->relSupplier->name }}</td>
                                                <td class="text-center">{{ $purchase->purchases_no }}</td>
                                                <td class="text-center">{{ $purchase->purchases_date }}</td>
                                                <td class="text-center">{{ $purchase->quantity }}</td>
            {{--                                    <td>{{ $purchase->amount }}</td>--}}
                                                <td class="text-center">
                                                    @if($purchase->status == 1)
                                                        <span style="font-size: 16px;" class="badge badge-pill badge-success">Active</span>
                                                    @else($purchase->status == 0)
                                                        <span style="font-size: 16px;" class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default">Action</button>
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a class="dropdown-item" href="{{ route('purchases.edit',$purchase->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                                            <li><a class="dropdown-item" href="" onclick="updateStatus({{ $purchase->id }})"><i class="fa fa-fw fa-search-plus"></i> Status</a></li>
                                                            <li><div role="separator" class="dropdown-divider"></div></li>
                                                            <li>
                                                                <a type="button"  onclick="deleteconfirm('{{ $purchase->id }}')" style="margin-left: 20px;color: rebeccapurple;"><i class="fa fa-trash"></i>Delete</a>
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
        function updateStatus(id) {
            let data = {
                _token: '{{ csrf_token() }}'
            };
            $.ajax({
                type: 'post',
                url: 'purchases/change-activity/'+ id,
                cache: false,
                data: data,
                success: function (results) {
                    if (results.success === true) {
                        window.location.reload();
                    }
                }
            });
        }

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
                        type: 'DELETE',
                        url: "purchases/" + id,
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
