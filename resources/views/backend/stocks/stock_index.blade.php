@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Create Stock
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/toastr/toastr.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-stripe-s"></i> Create Stock</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-stripe-s mt-1 mr-1"></i> Create Stock</li>
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
                    <li class="pt-2 px-3"><h3 class="card-title"><i class="fab fa-stripe-s"></i> Stock</h3></li>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Create Stock</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                        <div class="container">
                            <div class="row">
                            <div class="col-12">
                            <form action="{{route('utilize.stock.create')}}" method="POST" enctype="multipart/form-data">
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
                                            @php
                                                $arrayColor = explode(',',$product->color_ids);
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Color</label>
                                                    <select name="color" class="form-control">
                                                        <option selected="selected" value="" disabled>Select a Color</option>
                                                        @foreach ($arrayColor as $color)
                                                            <option value="{{$color}}" @if (old('color') == $color) {{ 'selected' }} @endif>{{ ((App\Models\Product::getColor($color)) == 'N/A') ? 'N/A' : App\Models\Product::getColor($color)->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @php
                                                $sizes = App\Models\Product::getSize($product->sub_category_id);
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Size</label>
                                                    <select name="size" class="form-control">
                                                        <option selected="selected" value="" disabled>Select a Size</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size['id'] }}" @if(old('size') == $size['id']) {{ 'selected' }} @endif>{{ $size['measurement'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputStock">New Stock</label>
                                            <input type="number" name="stock_in" class="form-control" value="{{ old('stock_in') }}" id="exampleInputStock" placeholder="Stock In">
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
    <!-- Toastr -->
    <script src="{{asset('assets/backend')}}/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/backend')}}/plugins/select2/js/select2.full.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
        $(function () {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('.select3').select2({})
        });
    </script>
@endsection