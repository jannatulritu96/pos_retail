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
                        <li class="breadcrumb-item active" aria-current="page">product list</li>
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
                                <h4 class="card-title">Unit list</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('product.create') }}" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Create product</a>
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
                                    <form method="get" class="form-horizontal" action="{{route('product.index')}}" >
                                        <div id="default_order_filter" class="dataTables_filter mb-2" style="float: right;">
                                            <select class="form-control form-control-sm" name="status" onchange="search_post()">
                                                <option value="">Select Status</option>
                                                <option value="1" @if($status == '1') selected @endif>Active</option>
                                                <option value="0" @if($status == '0') selected @endif>Inactive</option>
                                            </select>
                                        </div>

                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-right: 5px">
                                            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search"
                                                   value="{{Request::get('product')}}" onchange="search_post()">
                                        </div>

                                        <div id="default_order_filter" class="dataTables_filter" style="float: right;margin-right: 5px">
                                            <select class="form-control form-control-sm" name="category_id" id="category_type" onchange="search_post()">
                                                <option value="">All Category</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}">{{ $cat->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-2" style="margin-left: 1144px; margin-top: -38px;display: none">
                                            <button id="search" type="submit" class="btn btn-primary">Search</button>
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
                                                <th>Image</th>
                                                <th>Barcode</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Code</th>
                                                <th>Unit</th>
                                                <th class="text-right">Purchase Price (Tk)</th>
                                                <th class="text-right">Sell Price (Tk)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td><img style="width: 60px;" src="{{ asset($product->image) }}"></td>
                                                <td>{{ $product->barcode }}</td>
                                                <td>{{ $product->relCategory->category }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->relUnit->unit }}</td>
                                                <td class="text-right">{{ $product->purchases }}/-</td>
                                                <td class="text-right">{{ $product->sell }}/-</td>
                                                <td class="text-center">
                                                    @if($product->status == 1)
                                                        <span style="font-size: 16px;" class="badge badge-pill badge-success">Active</span>
                                                    @else($product->status == 0)
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
                                                            <li><a class="dropdown-item" href="{{ route('product.edit',$product->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                                            <li><a class="dropdown-item" href="" onclick="updateStatus({{ $product->id }})"><i class="fa fa-fw fa-search-plus"></i> Status</a></li>
                                                            <li><div role="separator" class="dropdown-divider"></div></li>
                                                            <li>
                                                                <a type="button"  onclick="deleteconfirm('{{ $product->id }}')" style="margin-left: 20px;color: rebeccapurple;"><i class="fa fa-trash"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
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
                url: 'product/change-activity/'+ id,
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
                        url: "product/" + id,
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

        function search_post() {
            $('#search').click()
        }
    </script>
@endsection
