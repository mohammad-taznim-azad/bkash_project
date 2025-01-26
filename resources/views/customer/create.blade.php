@extends('layouts.main')
@section('title'){{ 'Customer Create' }}@endsection
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
                        <h3>Customer Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="firstName">First Name<span class="text-danger">*</span></label>
                                            <input class="form-control" id="firstName" name="firstName" type="text" placeholder="First Name" value="{{ old('firstName') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('firstName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName">Last Name</label>
                                            <input class="form-control" id="lastName" name="lastName" type="text" placeholder="Last Name" value="{{ old('lastName') }}">
                                            <span class="text-danger"><b>{{  $errors->first('lastName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Phone<span class="text-danger">*</span></label>
                                            <input class="form-control" id="phone" name="phone" type="text" placeholder="Phone" value="{{ old('phone') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('phone') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                                            <span class="text-danger"><b>{{  $errors->first('email') }}</b></span>
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="customerImage">Customer Image</label>
                                            <input class="form-control" id="customerImage" name="customerImage" type="file">
                                            <span class="text-danger"><b>{{ $errors->first('customerImage') }}</b></span>
                                        </div> --}}
                                        <div class="mb-3">
                                            <label for="billingAddress">Billing Address</label>
                                            <input class="form-control" name="billingAddress" id="billingAddress" placeholder="Billing Address" value="{{ old('billingAddress') }}">
                                            <span class="text-danger"><b>{{  $errors->first('billingAddress') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="district">District</label>
                                            <select class="form-control" name="districtId" id="district" onchange="districtChange()">
                                                <option value="">Select District</option>
                                                @foreach($district as $districts)
                                                    <option value="{{ $districts->id }}">{{ $districts->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{ $errors->first('districtId') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="locationId">Location</label>
                                            <select class="form-control" name="locationId" id="location">
                                                <option value="">Select Location</option>
                                                @foreach($location as $locations)
                                                    <option value="{{ $locations->id}}">{{ $locations->locationName }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{ $errors->first('locationId') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="reseller_id">Reseller</label>
                                            <select class="form-control" name="reseller_id" id="reseller_id">
                                                <option value="">Select Location</option>
                                                @foreach($reseller as $resellers)
                                                    <option value="{{ $resellers->id}}">{{ $resellers->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{ $errors->first('reseller_id') }}</b></span>
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="shippingAddress">Shipping Address</label>
                                            <textarea class="form-control" name="shippingAddress" id="shippingAddress" placeholder="Shipping Address">{{ old('shippingAddress') }}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('shippingAddress') }}</b></span>
                                        </div> --}}
                                        {{-- <div class="mb-3">
                                            <label for="fkShipmentZoneId">Shipment Zone</label>
                                            <select class="form-control" name="fkShipmentZoneId" id="fkShipmentZoneId">
                                                <option value="">Select Shipment Zone</option>
                                                @foreach($shipmentZones as $shipmentZone)
                                                    <option value="{{ $shipmentZone->shipmentZoneId }}">{{ $shipmentZone->shipmentZoneName }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{ $errors->first('fkShipmentZoneId') }}</b></span>
                                        </div> --}}
                                        <div class="mb-3">
                                            <label for="status">Status<span class="text-danger">*</span></label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <span class="text-danger"><b>{{ $errors->first('status') }}</b></span>
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('customer.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer.js')
    <script>      
        $(document).ready(function () {   
            $('#district').select2({
                tags:true,
            }); 
            $('#location').select2({
                tags:true,
            }); 
            CKEDITOR.replace( 'details');   
        });

        function districtChange() {
        var districtId = $('#district').val();
        $.ajax({
            type: 'POST',
            url: "{{ route('customer.findlocation') }}",
            data: {
                'districtId': districtId,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                var length = data.location.length;
                $("#location").empty().append('<option value="">Select Location</option>');
                if (length > 0) {
                    $("#location").empty().append('<option value="">Select Location</option>')
                    $.each(data.location, function(index, item) {
                        console.log(index, item);
                        $("#location").append("<option value= " + item.id + ">" + item
                            .locationName + "</option>")
                    });
                }
            }
        });
    }
    </script>
@endsection
