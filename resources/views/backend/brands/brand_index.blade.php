@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Brand
@endsection
@section('additional_headers')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                    <h1 class="m-0"><i class="fab fa-bootstrap"></i> Brand</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-bootstrap mt-1 mr-1"></i> Brand</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$count['totalBrand']}}</h3>

                        <p>Total Brands</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-bootstrap"></i>
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
                        <h3>{{$count['activeBrand']}}</h3>

                        <p>Active Brands</p>
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
                        <h3>{{$count['inactiveBrand']}}</h3>

                        <p>Inactive Brands</p>
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
                        <h3>{{$count['creatorBrand']}}</h3>
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
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3"><h3 class="card-title"><i class="fab fa-bootstrap"></i> Brand</h3></li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Brands List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fas fa-folder-plus"></i> Add Brand</a>
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
                                                    <h3 class="card-title">Brand's Table List</h3>
                                                    <button type="button" id="delete_all" class="btn btn-warning btn-sm float-right text-light ml-1"><i class="fas fa-exclamation-circle"></i> Deleted All</button>
                                                    <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-sm float-right ml-1"><i class="fas fa-trash"></i> Selected Delete</button>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <table id="brand_table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%">No.</th>
                                                            <th width="15%">Name</th>
                                                            <th width="15%">Image</th>
                                                            <th width="15%">
                                                                <select id="status" class="custom-select form-control-border border-width-2">
                                                                    <option value="" selected>Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="2">Inactive</option>
                                                                </select>
                                                            </th>
                                                            <th width="15%">Creator</th>
                                                            <th width="10%">Created Date</th>
                                                            <th width="20%">Action</th>
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
                                        <form action="{{route('customize.brand.create')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Create a New Brand</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputBorderWidth2">Name :</label>
                                                                <input type="text" name="brand_name" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Brand Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Image :</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="brand_image" class="custom-file-input imageUpload" id="exampleInputFile">
                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <img id="imagePreview" src="https://www.eduprizeschools.net/wp-content/uploads/2016/06/No_Image_Available.jpg" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="Brand Image Upload">
                                                        </div>
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
                    <!-- /.card -->
                </div>
          
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
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
    {{-- sweet alert 2 --}}
    <script src="{{asset('assets/backend')}}/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="{{asset('js/brand.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
            bsCustomFileInput.init();
        });
    </script>
@endsection