@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Product Image Slider
@endsection
@section('additional_headers')
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/ekko-lightbox/ekko-lightbox.css">
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
                    <h1 class="m-0"><i class="fab fa-product-hunt"></i> Image Slider of Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-product-hunt mt-1 mr-1"></i> Product Image Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @php
        $count = 0;
    @endphp
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="card-title">Product Slider Image</h4>
                    <button class="btn btn-sm btn-primary float-right" data-toggle="collapse" data-target="#collapseSliderInput" aria-expanded="false" aria-controls="collapseSliderInput"> <i class="far fa-image"></i> Add Image</button>
                </div> 
                <div class="card-body">
                    <div class="row">
                        @if(count($productImages) != null)
                        @php
                            $counts = 0;
                        @endphp
                        @foreach($productImages as $item)
                            <div class="col-sm-3">
                                <a href="/product_image/{{$item}}" data-toggle="lightbox" data-title="Image Slider {{ ++$counts }}" data-gallery="gallery">
                                    <img src="/product_image/{{$item}}" class="img-fluid img-thumbnail mb-2" style="width: 15rem; height: 7rem;" alt="{{$item}}"/>
                                </a>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="collapse" id="collapseImage{{++$count}}">
                                            <form action="{{route('customize.productImages.update')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="hidden" name="product_id" value="{{$productID}}">
                                                        <input type="hidden" name="image_name" value="{{ $item }}">
                                                        <input type="file" class="custom-file-input" name="imageToUpload" id="filesToUpload" />
                                                        <label class="custom-file-label">Choose Images</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-pill btn-success mt-1 mx-auto d-block">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
										<button type="submit" class="btn btn-sm btn-pill btn-success" style="position: absolute; margin-right: 3rem; margin-left: 4rem" data-toggle="collapse" data-target="#collapseImage{{$count}}" aria-expanded="false" aria-controls="collapseImage{{$count}}"><i class="fas fa-pencil-alt"></i></button>
										<form action="{{route('customize.productImages.delete')}}" method="post" style="margin-left: 9rem;">
											@csrf
											<input type="hidden" name="product_id" value="{{ $productID }}">
											<input type="hidden" name="image_name" value="{{ $item }}">
											<button type="submit" class="btn btn-sm btn-pill btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
								    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <div class="h3 text-secondary mx-auto d-block">
                                Sorry!! No image Uploaded.
                            </div>
                        @endif
                    </div>
                    <div class="row mt-4 collapse" id="collapseSliderInput">
                        <div class="col-12">
                            <form id="quickForm" action="{{route('customize.productImages.create')}}" method="POST" enctype="multipart/form-data">
                                @csrf
								<input type="hidden" name="product_id" value="{{ $productID }}">
                                <div class="form-group">
                                    <label class="active">Slider Photos</label>
                                    <div class="input-images-2" style="padding-top: .5rem;"></div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
    <!-- Ekko Lightbox -->
    <script src="{{asset('assets/backend')}}/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    {{-- Image Uploader js --}}
    <script type="text/javascript" src="{{asset('assets/backend')}}/plugins/image-uploader/dist/image-uploader.min.js"></script>
    <script>
    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
        $('.input-images-2').imageUploader({
            imagesInputName: 'image_slider[]',
            maxFiles: 10,
        });
    })
    </script>
    
@endsection