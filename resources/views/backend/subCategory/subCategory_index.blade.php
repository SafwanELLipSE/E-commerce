@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Sub-Category & Size
@endsection
@section('additional_headers')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- sweet alert 2 --}}
    <link src="{{asset('assets/backend')}}/plugins/sweetalert2/sweetalert2.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-speakap"></i> Sub-Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-speakap mt-1 mr-1"></i> Sub-Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div id="multi-item-example" class="carousel slide carousel-multi-item mb-3" data-ride="carousel">
            <div class="carousel-inner mb-4" role="listbox">
                <!--First slide-->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$count['totalsubCategory']}}</h3>

                                <p>Total Sub-Categories</p>
                            </div>
                            <div class="icon">
                                <i class="fab fa-speakap"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$count['activesubCategory']}}</h3>

                                <p>Active Sub-Categories</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-thumbs-up"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$count['inactivesubCategory']}}</h3>

                            <p>Inactive Sub-Categories</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-thumbs-down"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                        <div class="inner text-light">
                            <h3>{{$count['creatorsubCategory']}}</h3>

                            <p>Total Creators</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            <span class="text-light">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </span>
                        </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$countSize['totalSize']}}</h3>

                                <p>Total Sizes</p>
                            </div>
                            <div class="icon">
                                <i class="fab fa-speakap"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$countSize['activeSize']}}</h3>

                                    <p>Active Sizes</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-thumbs-up"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$countSize['inactiveSize']}}</h3>

                                <p>Inactive Sizes</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-thumbs-down"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-warning">
                            <div class="inner text-light">
                                <h3>{{$countSize['creatorSize']}}</h3>

                                <p>Total Creators</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                <span class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!--Indicators-->
            <ol class="carousel-indicators" style="top:9rem">
                <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                <li data-target="#multi-item-example" data-slide-to="1"></li>
            </ol>
            <!--/.Indicators-->
        </div>
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3"><h3 class="card-title"><i class="fab fa-speakap"></i> Sub-Category</h3></li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Sub-Category List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Size List</a>
                </li>
                
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Sub-category's Table List</h3>
                                            <button type="button" id="delete_all_subCategory" class="btn btn-warning btn-sm float-right text-light ml-1"><i class="fas fa-exclamation-circle"></i> Deleted All</button>
                                            <button type="button" name="bulk_delete_subCategory" id="bulk_delete_subCategory" class="btn btn-danger btn-sm float-right ml-1"><i class="fas fa-trash"></i> Selected Delete</button>
                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-subCategory"><i class="fas fa-folder-plus"></i> Add Sub-Category</button>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="subCategory_table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">No.</th>
                                                        <th width="15%">Name</th>
                                                        <th width="15%">
                                                            <select id="category" class="custom-select form-control-border border-width-2">
                                                                <option value="" selected>Category</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </th>
                                                        <th width="15%">Image</th>
                                                        <th width="15%">
                                                            <select id="status" class="custom-select form-control-border border-width-2">
                                                                <option value="" selected>Status</option>
                                                                <option value="1">Active</option>
                                                                <option value="2">Inactive</option>
                                                            </select>
                                                        </th>
                                                        <th width="12%">Creator</th>
                                                        <th width="10%">Created Date</th>
                                                        <th width="13%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    <!-- /.card-body -->
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Size's Table List</h3>
                                        <button type="button" id="delete_all_size" class="btn btn-warning btn-sm float-right text-light ml-1"><i class="fas fa-exclamation-circle"></i> Deleted All</button>
                                        <button type="button" name="bulk_delete_size" id="bulk_delete_size" class="btn btn-danger btn-sm float-right ml-1"><i class="fas fa-trash"></i> Selected Delete</button>
                                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-size"><i class="fas fa-folder-plus"></i> Add Size</button>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="size_table" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th width="10%">No.</th>
                                                    <th width="10%">Measurement</th>
                                                    <th width="10%">Unit</th>
                                                    <th width="20%">
                                                        <select id="subCategorySelect" class="custom-select form-control-border border-width-2">
                                                            <option value="" selected>Sub-Category</option>
                                                            @foreach($subCategories as $subCategory)
                                                                <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th width="20%">
                                                        <select id="status" class="custom-select form-control-border border-width-2">
                                                            <option value="" selected>Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </th>
                                                    <th width="15%">Creator</th>
                                                    <th width="10%">Created Date</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>

    @include('backend/subCategory/subCategory_model')
    @include('backend/subCategory/size_model')
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
    {{-- sweet alert 2 --}}
    <script src="{{asset('assets/backend')}}/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('js/subCategory.js')}}"></script>
    <script src="{{asset('js/size.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/backend')}}/plugins/select2/js/select2.full.min.js"></script>
    <script>
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
            //Initialize Select2 Elements
            $('.select2').select2({
            theme: 'bootstrap4'
            })
        });
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection