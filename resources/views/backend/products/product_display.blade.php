@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Product Display
@endsection
@section('additional_headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css ">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-product-hunt"></i> Product Display</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-product-hunt mt-1 mr-1"></i> Product Display</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                    <div class="col-12">
                        <img src="/product_image/{{$product->image}}" class="product-image" alt="Product Image">
                    </div>
                    @php
                        $arryImage = explode(',',$product->image_slider);
                        $count = 1;
                        $arrayFeature = explode(',',$product->feature_ids);
                    @endphp
                    <div class="col-12 product-image-thumbs">      
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <div class="item product-image-thumb active"><img src="/product_image/{{$product->image}}" style="width: 300px !important; height: 85px !important;" alt="Owl Image{{$count++}}"/></div>
                            @foreach ($arryImage as $image)
                                <div class="item product-image-thumb"><img src="/product_image/{{$image}}" style="width: 300px !important; height: 85px !important;" alt="Owl Image{{$count++}}"/></div>
                            @endforeach
                        </div>
                    </div>
                    <h4 class="mt-3">Feature </h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach ($arrayFeature as $feature)
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                <span class="text-sm">{{ ((App\Models\Product::getFeature($feature)) == 'N/A') ? 'N/A' : App\Models\Product::getFeature($feature)->name }}</span>
                                <br>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                <h3 class="my-3">{{$product->name}}</h3>
                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p><strong>Brand: </strong> {{ isset($product->brand->name) ? $product->brand->name : 'No Longer Available' }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>Category: </strong> {{ isset($product->category->name) ? $product->category->name : 'No Longer Available' }}</p>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-12 col-md-12">
                        <p><strong>Sub-Category: </strong> {{ isset($product->subCategory->name) ? $product->subCategory->name : 'No Longer Available' }}</p>
                    </div>
                </div>      
                    @php
                        $arrayColor = explode(',',$product->color_ids);
                    @endphp
                <hr>
                <h4>Available Colors</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @foreach ($arrayColor as $color)
                        <label class="btn btn-default text-center active">
                            <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                            {{ ((App\Models\Product::getColor($color)) == 'N/A') ? 'N/A' : App\Models\Product::getColor($color)->name }}
                            <br>
                        <i class="fas fa-circle fa-2x" style="color:{{ ((App\Models\Product::getColor($color)) == 'N/A') ? 'N/A' : App\Models\Product::getColor($color)->code }} !important;"></i>
                    </label>
                    @endforeach
                </div>
                    @php
                        $sizes = App\Models\Product::getSize($product->sub_category_id);
                    @endphp
                <h4 class="mt-3">Size </h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @if(count($sizes) != 0)
                        @foreach ($sizes as $size)
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                <span class="text-xl">{{ $size['measurement'] }}</span>
                                <br>
                                {{ $size['unit'] }}
                            </label>
                        @endforeach
                    @endif
                </div>
                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        {{$product->selling_price}} BDT <small><del>{{$product->buying_price}} BDT</del></small>
                    </h2>
                    <h4 class="mt-0">
                        <small>Ex Tax: $80.00 </small>
                    </h4>
                </div>

                <div class="mt-4">
                    <a href="{{route('customize.productImages.internals',$product->id)}}" class="btn btn-primary btn-lg btn-flat">
                    <i class="fas fa-images fa-lg mr-2"></i>
                        Image Slider
                    </a>

                    <a href="{{route('customize.product.edit',$product->id)}}" class="btn btn-default btn-lg btn-flat">
                    <i class="fas fa-edit"></i>
                        Edit
                    </a>
                </div>

                <div class="mt-4 product-share">
                    <a href="#" class="text-gray">
                    <i class="fab fa-facebook-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                    <i class="fab fa-twitter-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                    <i class="fas fa-envelope-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                    <i class="fas fa-rss-square fa-2x"></i>
                    </a>
                </div>

                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                        <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                        {!!$product->details!!}
                    </div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                        <div class="post">
                            <div class="user-block">
                                <div class="row">
                                    <div class="col-6">
                                        <img class="img-circle img-bordered-sm" src="{{asset('assets/backend')}}/dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                        <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>
                                    <div class="col-6">
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-sm btn-default">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-default">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore.
                            </p>

                            <p>
                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                            </p>
                        </div>
                        <div class="post">
                            <div class="user-block">
                                <div class="row">
                                    <div class="col-6">
                                        <img class="img-circle img-bordered-sm" src="{{asset('assets/backend')}}/dist/img/user7-128x128.jpg" alt="User Image">
                                        <span class="username">
                                        <a href="#">Sarah Ross</a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <div class="col-6">
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-sm btn-default">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-default">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore.
                            </p>
                            <p>
                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                            </p>
                        </div>
                        <div class="post">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <div class="content text-center">
                                        <div class="ratings"> <span class="product-rating">4.6</span><span>/5</span>
                                            <div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                            <div class="rating-text"> <span>46 ratings & 15 reviews</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items : 4,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function () {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
            })
        })
    </script>
@endsection