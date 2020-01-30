@extends('admin.layouts.master')

@section('content')

<div class="page-breadcrumb border-bottom">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Dashboard</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Expense list</li>
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
                                <h4 class="card-title">Expense list</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('expense.create') }}" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Add New Expense</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
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
                                    <th class="text-center">Status</th>
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
                                    <td>{{ $expense->note }}</td>
                                    <td class="text-center">
                                        @if($expense->status == 1)
                                            <span style="font-size: 16px;" class="badge badge-pill badge-success">Active</span>
                                        @else($expense->status == 0)
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
                                                <li><a class="dropdown-item" href="{{ route('expense.edit',$expense->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="" onclick="updateStatus({{ $expense->id }})"><i class="fa fa-fw fa-search-plus"></i> Status</a></li>
                                                <li><div role="separator" class="dropdown-divider"></div></li>
                                                <li>
                                                    <a type="button"  onclick="deleteconfirm('{{ $expense->id }}')" style="margin-left: 20px;color: rebeccapurple;"><i class="fa fa-trash"></i>Delete</a>
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

@endsection
@section('script')
    <script>
        function updateStatus(id) {
            let data = {
                _token: '{{ csrf_token() }}'
            };
            $.ajax({
                type: 'post',
                url: 'expense/change-activity/'+ id,
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
                        url: "expense/" + id,
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
