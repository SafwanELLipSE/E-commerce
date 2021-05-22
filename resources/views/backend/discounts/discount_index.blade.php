@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Create Discount
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
                    <h1 class="m-0"><i class="fas fa-percent"></i> Create Discount</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-percent mt-1 mr-1"></i> Create Discount</li>
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
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3"><h3 class="card-title"><i class="fas fa-percent"></i> Discount</h3></li>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Create Discount</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                        <div class="container">
                            <div class="row">
                            <div class="col-12">
                            <form id="quickForm" action="{{route('customize.discount.create')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Create a New Stock</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Product</label>
                                            <select name="product" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="" disabled>Select a Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}" @if (old('product') == $product->id) {{ 'selected' }} @endif>{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Starting Date:</label>
                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                        <input name="start_date" value="{{ old('start_date') }}" type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ending Date:</label>
                                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                        <input name="end_date" value="{{ old('end_date') }}" type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputStock">Percentage Of Discount</label>
                                            <input type="text" name="percentage" class="form-control" value="{{ old('percentage') }}" id="exampleInputStock" placeholder="% Of Discount">
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