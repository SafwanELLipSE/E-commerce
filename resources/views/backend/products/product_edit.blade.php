@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Edit Product
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
                    <h1 class="m-0"><i class="fab fa-product-hunt"></i> Edit Product Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-product-hunt mt-1 mr-1"></i> Edit Product</li>
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <form id="quickForm" action="{{route('customize.product.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" >
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" value="{{ $product->name }}" id="exampleInputEmail1" placeholder="Enter Product Name">
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="product_brand" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="" disabled>Select a Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" @if ($product->brand_id == $brand->id) {{ 'selected' }} @endif>{{$brand->name}}</option>
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
                                                    <option value="{{$category->id}}" @if ($product->category_id == $category->id) {{ 'selected' }} @endif>{{$category->name}}</option>
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
                                                    <option value="{{$subCategory->id}}" @if ($product->sub_category_id == $subCategory->id) {{ 'selected' }} @endif>{{$subCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $colorArray = explode(",", $product->color_ids);
                                @endphp
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <div class="select2-primary">
                                                <select name="product_color[]" class="form-control select3 select2-info" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                @foreach($colors as $color)
                                                
                                                    <option value="{{$color->id}}" @if ($product->color_ids){{ (in_array($color->id, $colorArray) ? "selected":"") }}@endif>{{$color->name}} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $featureArray = explode(",", $product->feature_ids);
                                    @endphp
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Feature</label>
                                            <div class="select2-primary">
                                                <select name="product_feature[]" class="form-control select3 select2-info" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                @foreach($features as $feature)
                                                    <option value="{{$feature->id}}" @if ($product->feature_ids){{ (in_array($feature->id, $featureArray) ? "selected":"") }}@endif>{{$feature->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Details</label>
                                    <textarea id="summernote" name="product_details">{!! $product->details !!}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="product_image" class="custom-file-input imageUpload" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Product Code</label>
                                            <input type="text" name="code" value="{{ $product->code }}" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Code">
                                        </div>
                                    </div>   
                                    <img id="imagePreview" src="/product_image/{{ $product->image }}" class="rounded mx-auto d-block thumbnail" width="250" height="140" alt="Product Image Upload">
                                </div>
                                <div class="row mb-2 mt-2">
                                    <div class="col-6">
                                        <label>Product Buying Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                            </div>
                                            <input type="number" name="buying_price" value="{{ $product->buying_price }}" class="form-control">
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
                                            <input type="number" name="selling_price" value="{{ $product->selling_price }}" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                        </div>
                                    </div>    
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
    <!-- jquery-validation -->
    <script src="{{asset('assets/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    product_brand: {
                        required: true,
                    },
                    product_category: {
                        required: true,
                    },
                    product_sub_category: {
                        required: true,
                    },
                    "product_color[]": {
                        required: true,
                    },
                    "product_feature[]": {
                        required: true,
                    },
                    code: {
                        required: true,
                    },
                    buying_price: {
                        required: true,
                        number: true,
                    },
                    selling_price: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    product_name: {
                        required: "Please enter your Product Name",
                    },
                    product_brand: {
                        required: "Please enter your Product Brand",
                    },
                    product_category: {
                        required: "Please enter your Product Category",
                    },
                    product_sub_category: {
                        required: "Please enter your Product Sub-Category",
                    },
                    product_color: {
                        required: "Please enter your Product Color",
                    },
                    product_feature: {
                        required: "Please enter your Product Feature",
                    },
                    code: {
                        required: "Please enter your Product Code",
                    },
                    buying_price: {
                        required: "Please provide a Buying Price",
                        number: "Only can use Number",
                    },
                    selling_price: {
                        required: "Please provide a Selling Price",
                        number: "Only can use Number",
                    },
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
        $(document).ready(function(){
            $(".imageUpload").change(function(data){

            var imageFile = data.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(imageFile);

                reader.onload = function(evt){
                $('#imagePreview').attr('src', evt.target.result);
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
                }		
            });
        });
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
        });
    </script>
@endsection