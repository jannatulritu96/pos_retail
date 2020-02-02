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
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="default_order_length">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;">
                                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="default_order"></label>
                                        </div>
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
                                @foreach($expenses as $expense)
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
