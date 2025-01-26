@extends('layouts.main')
@section('title'){{ 'Customer' }}@endsection
@section('header.css')
    <style>

    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Customer</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="text-end mb-3">
                                <a href="{{ route('customer.create') }}" class="btn btn-md btn-info "><i class="fa fa-plus"></i>Create New</a>
                            </div> --}}
                            <div class="table-responsive">
                                <table id="customerTable" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@section('footer.js')
    <script>
        $(document).ready(function () {
            $('#customerTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('customer.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'Registered At', data: 'created_at', name: 'created_at', className: "text-center", orderable: true, searchable: true},
                    {title: 'Name', data: 'name', name: 'name', className: "text-center", orderable: true, searchable: true},
                    {title: 'Phone', data: 'phone', name: 'phone', className: "text-center", orderable: true, searchable: true},
                    {title: 'Email', data: 'email', name: 'email', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Company', data: 'company', name: 'company', className: "text-center", orderable: true, searchable: true}, 
                    {title: 'Status', data: 'status', name: 'status', className: "text-center", orderable: true, searchable: true},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.customerId + '" onclick="editCustomer(this)"><i class="fa fa-edit"></i></a>';                              
                        }, orderable: false, searchable: false
                    }
                ]
            });
        });

        function editCustomer(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("customer.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteCustomer(x) {
            let customerId = $(x).data('panel-id');
            if(!confirm("Delete This Customer?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('customer.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'customerId': customerId},
                success: function (data) {
                    toastr.success('Customer Deleted Successfully!');
                    $('#customerTable').DataTable().clear().draw();
                },
            });
        }
        function changeStatus(x) {
            var id = $(x).data('panel-id');
            $.ajax({
                type: 'POST',
                url: "{{route('customer.statusUpdate')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    if (data.active === 'active') {
                        $(x).text('Active');
                    } else {
                        $(x).text('Inactive');
                    }
                   
                    $('#customerTable').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    toastr.error('Something went wrong!');
                }
            });
        }

    </script>
@endsection
