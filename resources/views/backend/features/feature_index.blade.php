@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Feature & Color
@endsection
@section('additional_headers')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-sitemap"></i> Feature</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-sitemap mt-1 mr-1"></i> Feature</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="offset-lg-3 offset-md-3 col-lg-6 col-md-6 col-12">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$count['totalFeature']}}</h3>
                        <p>Total Features</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3"><h3 class="card-title"><i class="fas fa-sitemap"></i> Feature</h3></li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Features List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Colors List</a>
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
                                            <h3 class="card-title">Feature's Table List</h3>
                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-Feature"><i class="fas fa-folder-plus"></i> Add Feature</button>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="feature_table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="10%">No.</th>
                                                    <th width="50%">Name</th>
                                                    <th width="40%">Action</th>
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
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Feature's Table List</h3>
                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-Color"><i class="fas fa-folder-plus"></i> Add Color</button>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="color_table" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th width="10%">No.</th>
                                                    <th width="15%">Name</th>
                                                    <th width="10%">Code</th>
                                                    <th width="10%">Look</th>
                                                    <th width="15%">Creator</th>
                                                    <th width="15%">Created At</th>
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
            </div>
            <!-- /.card -->
        </div>
        <!--/. container-fluid -->
    </section>
    @include('backend/features/feature_model')
    @include('backend/features/color_model')
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
    <!-- bootstrap color picker -->
    <script src="{{asset('assets/backend')}}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    
    <script src="{{asset('js/feature.js')}}"></script>
    <script src="{{asset('js/color.js')}}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            //Colorpicker
            $('.my-colorpicker1').colorpicker()
        });
    </script>
@endsection