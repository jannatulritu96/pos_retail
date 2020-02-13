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
                        <li class="breadcrumb-item active" aria-current="page">Expense report list</li>
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
                                    <h4 class="card-title">Expense Report List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div id="default_order_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="get" class="form-horizontal" action="{{route('expense.search-report')}}" >
                                        <div class="row">

                                            <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-left: 17px">
                                                <select class="form-control form-control-sm" name="exp_cat" id="category_type">
                                                    <option value="">All Category</option>
                                                    @foreach($exp_cats as $exp_cat)
                                                        <option value="{{$exp_cat->id}}">{{ $exp_cat->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-left: 5px">
                                                <select class="form-control form-control-sm" name="outlet" id="outlet">
                                                    <option value="">All Outlet</option>
                                                    @foreach($outlets as $outlet)
                                                        <option value="{{$outlet->id}}">{{ $outlet->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-left: 5px">
                                                <input type="date"  name="expense_date" id="datepicker_start"  placeholder="Date to" class="form-control form-control-sm">
                                            </div>
                                            <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-left: 5px">
                                                <input type="date"  name="expense_date" id="datepicker_start"  placeholder="Date From" class="form-control form-control-sm">
                                            </div>

                                            <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-left: 5px">
                                                <input type="text" class="form-control form-control-sm " name="expense_no" placeholder="Expense No."
                                                       value="{{Request::get('expense_no')}}">
                                            </div>

                                            <div id="default_order_filter" class="dataTables_filter mb-2" style="float: right;margin-left: 5px">
                                                <select class="form-control form-control-sm" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1" @if($status == '1') selected @endif>Active</option>
                                                    <option value="0" @if($status == '0') selected @endif>Inactive</option>
                                                </select>
                                            </div>

                                            <div class="dataTables_filter">
                                                <button type="submit" class="btn btn-primary" style="float: right;margin-left: 5px;padding: 2.1px 12px;">Search</button>
                                            </div>
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
                                    <th>Expense No.</th>
                                    <th>Expense Date</th>
                                    <th>Category</th>
                                    <th>Expense Amount</th>
                                    <th>Document</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $expense)
                                    <tr>
                                        <td>{{ $expense->id }}</td>
                                        <td>{{ $expense->relOutlet->name }}</td>
                                        <td>{{ $expense->expense_no }}</td>
                                        <td>{{ $expense->expense_date }}</td>
                                        <td>{{ $expense->relExpenseCategory->cat_name }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->note }}</td><td class="text-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Action</button>
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li><a class="dropdown-item" href="{{ route('expense.show',$expense->id) }}"><i class="fa fa-eye"></i> view</a></li>
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
        function search_post() {
            $('#search').click()
        }
    </script>
@endsection
