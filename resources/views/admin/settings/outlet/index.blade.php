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
                        <li class="breadcrumb-item active" aria-current="page">Outlet list</li>
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
                                <h4 class="card-title">Outlet list</h4>
                            </div>
                            <div class="col-md-6">
{{--                                <button type="submit" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Create outlet</button>--}}
                                <a href="{{ route('outlet.create') }}" class="btn btn-primary" style="float: right;margin-bottom: 17px;">Create Outlet</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped border display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Code No.</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>fax</th>
                                    <th>Address</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($outlets as $outlet)
                                <tr>
                                    <td>{{ $outlet->id }}</td>
                                    <td>{{ $outlet->name }}</td>
                                    <td>{{ $outlet->code }}</td>
                                    <td>{{ $outlet->email }}</td>
                                    <td>{{ $outlet->phone }}</td>
                                    <td>{{ $outlet->fax }}</td>
                                    <td>{{ $outlet->address }}</td>
                                    <td class="text-center">
                                        @if($outlet->status == 1)
                                            <span style="font-size: 16px;" class="badge badge-pill badge-success">Active</span>
                                        @else($outlet->status == 0)
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
                                                <li><a class="dropdown-item" href="{{ route('outlet.edit',$outlet->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a></li>
                                                <li><a class="dropdown-item" href="" onclick="updateStatus({{ $outlet->id }})"><i class="fa fa-fw fa-search-plus"></i> Status</a></li>
                                                <li><div role="separator" class="dropdown-divider"></div></li>
                                                <li>
                                                    <button type="button"  onclick="deleteconfirm('{{ $outlet->id }}')" style="margin-left: 20px;color: rebeccapurple;"><i class="fa fa-trash"></i>Delete</button>
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
                url: 'outlet/change-activity/' + id,
                cache: false,
                data: data,
                success: function (results) {

                    if (results.success === true) {
                        window.location.reload()
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
                        url: "outlet/" + id,
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
