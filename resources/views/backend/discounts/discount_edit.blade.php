@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Edit Discount
@endsection
@section('additional_headers')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-percent"></i> Edit Discount's Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-percent mt-1 mr-1"></i> Edit Discount's Information</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <!-- /.row -->
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <div class="card-header">
                    <h3 class="card-title">Edit Discount Details</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                        <form id="quickForm" action="{{route('customize.discount.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Discount Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Product</label>
                                        <input type="hidden" name="discount_id" value="{{$discount->id}}">
                                        <select name="product" class="form-control select2" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Select a Product</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}" @if ($discount->product_id == $product->id) {{ 'selected' }} @endif>{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Starting Date:</label>
                                                @php
                                                    $startDate = date('d-m-Y',strtotime($discount->start_date));
                                                @endphp
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input name="start_date" value={{ $startDate }} type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ending Date:</label>
                                                @php
                                                    $endDate = date('d-m-Y',strtotime($discount->end_date));
                                                @endphp
                                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                    <input name="end_date" value={{ $endDate }} type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputStock">Percentage Of Discount</label>
                                        <input type="text" name="percentage" class="form-control" value="{{ $discount->percentage }}" id="exampleInputStock" placeholder="% Of Discount">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm bg-gradient-primary float-right">Create</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
    <!-- Select2 -->
    <script src="{{asset('assets/backend')}}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{asset('assets/backend/plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('assets/backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{asset('assets/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script>
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('.select3').select2({})
            // Date range picker
            $('#reservationdate').datetimepicker({
                format: 'D-M-Y',
            });
            $('#reservationdate2').datetimepicker({
                format: 'D-M-Y',
            });
            $(function () {
            $('#quickForm').validate({
                rules: {
                    product: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                    percentage: {
                        required: true,
                        number: true,
                        digits: true,
                        max: 100,
                        min: 0,
                    },
                },
                messages: {
                    product: {
                        required: "Please select your Product",
                    },
                    start_date: {
                        required: "Please enter your Start Date",
                    },
                    end_date: {
                        required: "Please enter your End Date",
                    },
                    percentage: {
                        required: "Please provide the percentage of discount",
                        number: "Only can use Number",
                        digits: "Only can use Digit",
                        max: "please provide value less than or equal to 100",
                        min: "please provide value greater than or equal to 0",
                    }
                },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection