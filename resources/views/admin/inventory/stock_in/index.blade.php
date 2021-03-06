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
                        <li class="breadcrumb-item active" aria-current="page">Stock In (Receive) list</li>
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
                                <h4 class="card-title">Stock In (Receive) list</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('stock_in.create') }}" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Add New Stock In (Receive)</a>
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
                                    <form method="get" class="form-horizontal" action="{{route('stock_in.index')}}" >

                                        <div class="dataTables_filter">
                                            <button type="submit" class="btn btn-primary" style="float: right;margin-left: 5px;padding: 2.1px 12px;">Search</button>
                                        </div>

                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-right: 5px">
                                            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search"
                                                   value="{{Request::get('stock_in')}}" onchange="search_post()">
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
                                                <th class="text-center">Receive No.	</th>
                                                <th class="text-center">Receive Date</th>
                                                <th class="text-center">Challan No.</th>
                                                <th class="text-center">Challan Date</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Amount (Tk)	</th>
                                                <th class="text-center">Due Amount (Tk)	</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($data as $stock)
                                           <tr>
                                               <td>{{ $stock->id }}</td>
                                               <td>{{ $stock->relOutlet->name }}</td>
                                               <td>{{ $stock->relSupplier->name }}</td>
                                               <td class="text-center">{{ $stock->receive_no }}</td>
                                               <td class="text-center">{{ $stock->receive_date }}</td>
                                               <td class="text-center">{{ $stock->challan_no }}</td>
                                               <td class="text-center">{{ $stock->challan_date }}</td>
                                               <td class="text-center">{{ $stock->total_qty }}</td>
                                               <td class="text-center">{{ $stock->total_amount }}</td>
                                               <td class="text-center">{{ $stock->due_amount }}</td>
                                               <td class="text-center">
                                                   @if($stock->status == 1)
                                                       <span style="font-size: 16px;" class="badge badge-pill badge-success">Active</span>
                                                   @else($stock->status == 0)
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
                                                           <li><a class="dropdown-item" href="{{ route('stock_in.show',$stock->id) }}"><i class="fa fa-eye"></i> Show row</a></li>
                                                           <li><a class="dropdown-item" href="{{ route('stock_in.edit',$stock->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                                           <li><a class="dropdown-item" href="" onclick="updateStatus({{ $stock->id }})"><i class="fa fa-fw fa-search-plus"></i> Status</a></li>
                                                           <li><div role="separator" class="dropdown-divider"></div></li>
                                                           <li>
                                                               <a type="button"  onclick="deleteconfirm('{{ $stock->id }}')" style="margin-left: 20px;color: rebeccapurple;"><i class="fa fa-trash"></i>Delete</a>
                                                           </li>
                                                           <li><div role="separator" class="dropdown-divider"></div></li>
                                                           <li><a class="btn btn-danger" data-toggle="tooltip" title="Return to Suppliper" href="{{ route('stock_return.create',$stock->id) }}" style="margin-left: 18px"><i class="fa fa-minus"></i> Return</a>
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
                        type: 'DELETE',
                        url: "stock_in/" + id,
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
