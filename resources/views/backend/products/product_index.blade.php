@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Create Product
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/summernote/summernote-bs4.min.css">
    {{-- Image Uploader Css --}}
    <link type="text/css" rel="stylesheet" href="{{asset('assets/backend')}}/plugins/image-uploader/dist/image-uploader.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-product-hunt"></i> Create Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-product-hunt mt-1 mr-1"></i> Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create a New Product</h3>
                        </div>
                        <form id="quickForm" action="{{route('customize.product.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" id="exampleInputEmail1" placeholder="Enter Product Name">
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="product_brand" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="" disabled>Select a Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" @if (old('product_brand') == $brand->id) {{ 'selected' }} @endif>{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Select Category: </label>
                                            <select name="product_category" class="form-control select2 select2-muted" data-dropdown-css-class="select2-muted" style="width: 100%;">
                                                <option selected="selected" value="" disabled>Select a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if (old('product_category') == $category->id) {{ 'selected' }} @endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Sub-Category</label>
                                            <select name="product_sub_category" class="form-control select2" data-placeholder="Select a State" style="width: 100%;">
                                                <option selected="selected" value="" disabled>Select a Sub-Category</option>
                                                @foreach($subCategories as $subCategory)
                                                    <option value="{{$subCategory->id}}" @if (old('product_sub_category') == $subCategory->id) {{ 'selected' }} @endif>{{$subCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <div class="select2-primary">
                                                <select name="product_color[]" class="form-control select3 select2-info" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                @foreach($colors as $color)
                                                    <option value="{{$color->id}}" @if (old("product_color")){{ (in_array($color->id, old("product_color")) ? "selected":"") }}@endif>{{$color->name}} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Feature</label>
                                            <div class="select2-primary">
                                                <select name="product_feature[]" class="form-control select3 select2-info" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                @foreach($features as $feature)
                                                    <option value="{{$feature->id}}" @if (old("product_feature")){{ (in_array($feature->id, old("product_feature")) ? "selected":"") }}@endif>{{$feature->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Details</label>
                                    <textarea id="summernote" name="product_details">{{old('product_details')}}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="product_image" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Product Code</label>
                                            <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Code">
                                        </div>
                                    </div>    
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label>Product Buying Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                            </div>
                                            <input type="number" name="buying_price" value="{{ old('buying_price') }}" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Product Selling Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                            </div>
                                            <input type="number" name="selling_price" value="{{ old('selling_price') }}" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label class="active">Slider Photos</label>
                                    <div class="input-images-2" style="padding-top: .5rem;"></div>
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
    <!-- Select2 -->
    <script src="{{asset('assets/backend')}}/plugins/select2/js/select2.full.min.js"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    {{-- Image Uploader js --}}
    <script type="text/javascript" src="{{asset('assets/backend')}}/plugins/image-uploader/dist/image-uploader.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('.select3').select2({})
            // Summernote
            $('#summernote').summernote({
                height: 250,
                minHeight: 250,              
                maxHeight: 400,
            })
            $('.input-images-2').imageUploader({
                imagesInputName: 'image_slider[]',
                maxFiles: 10,
            });
        });

    </script>
@endsection