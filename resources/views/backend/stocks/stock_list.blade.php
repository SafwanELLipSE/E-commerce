@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | All Stock List
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
                    <h1 class="m-0"><i class="fab fa-stripe-s"></i> All Stock of Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-stripe-s mt-1 mr-1"></i> All Stock</li>
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
                            <h3 class="card-title">Stock's Table List</h3>
                            <a href="{{route('utilize.stock.index')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-folder-plus"></i> Add Stock</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="stock_table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="15%">Name</th>
                                    <th width="9%">Color</th>
                                    <th width="7%">Size</th>
                                    <th width="8%">Current</th>
                                    <th width="10%">Stock In</th>
                                    <th width="8%">Restock</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Created Date</th>
                                    <th width="10%">Action</th>
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
    @include('backend/stocks/in_model')
    @include('backend/stocks/out_model')
    @include('backend/stocks/restock_model')
    @include('backend/stocks/edit_model')
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
    <script src="{{asset('js/stock.js')}}"></script>

    <script>
        $('#modal-In').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var stock_id = button.data('stockid')
            var modal = $(this)
            modal.find('.modal-body #stock_id').val(stock_id);
        })
        $('#modal-Out').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var stock_id = button.data('stockid')
            var modal = $(this)
            modal.find('.modal-body #stock_id').val(stock_id);
        })
        $('#modal-reStock').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var stock_id = button.data('stockid')
            var modal = $(this)
            modal.find('.modal-body #stock_id').val(stock_id);
        })
        $('#modal-Edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var stock_id = button.data('stockid')
            var modal = $(this)
            modal.find('.modal-body #stock_id').val(stock_id);
        })
    </script>
@endsection