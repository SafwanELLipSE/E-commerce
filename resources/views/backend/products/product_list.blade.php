@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Product List
@endsection
@section('additional_headers')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                    <h1 class="m-0"><i class="fab fa-product-hunt"></i> Product List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-product-hunt mt-1 mr-1"></i> Product List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product's Table List</h3>
                            <button type="button" id="delete_all" class="btn btn-warning btn-sm float-right text-light ml-1"><i class="fas fa-exclamation-circle"></i> Deleted All</button>
                            <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-sm float-right ml-1"><i class="fas fa-trash"></i> Selected Delete</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="product_table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">
                                        <select id="brand" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th width="15%">
                                        <select id="category" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th width="15%">
                                        <select id="subCategory" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Sub-Category</option>
                                            @foreach($subCategories as $subCategory)
                                                <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th width="10%">Selling price</th>
                                    <th width="15%">
                                        <select id="status" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Status</option>
                                            <option value="1">No Previous Stock</option>
                                            <option value="2">In Stock</option>
                                            <option value="0">Out Stock</option>
                                        </select>
                                    </th>
                                    <th width="10%">
                                        <select id="status_discount" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Status Discount</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </th>
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
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
    <!-- Toastr -->
    <script src="{{asset('assets/backend')}}/plugins/toastr/toastr.min.js"></script>
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
    <script src="{{asset('js/product.js')}}"></script>
@endsection