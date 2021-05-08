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
                        Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum.
                    </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                        Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. 
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