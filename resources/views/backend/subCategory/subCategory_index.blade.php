@extends('backend.layouts.app')

@section('title')
OneTechShop | Sub-Category
@endsection
@section('additional_headers')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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

        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3"><h3 class="card-title"><i class="fab fa-speakap"></i> Sub-Category</h3></li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Sub-Category List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fas fa-folder-plus"></i> Add Sub-Category</a>
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
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="subCategory_table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">No.</th>
                                                        <th width="15%">Name</th>
                                                        <th width="10%">Category</th>
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
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Create a New Sub-category</h3>
                                    </div>
                                  <form action="{{route('customize.subCategory.create')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputBorderWidth2">Name :</label>
                                                    <input type="text" name="subCatgory_name" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Sub-category Name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Select Category: </label>
                                                    <select name="category" class="form-control select2 select2-muted" data-dropdown-css-class="select2-muted" style="width: 100%;">
                                                        <option selected="selected" value="" disabled>Select a Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Image :</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="subCatgory_image" type="file" class="custom-file-input imageUpload" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img id="imagePreview" src="https://www.eduprizeschools.net/wp-content/uploads/2016/06/No_Image_Available.jpg" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="Brand Image Upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm bg-gradient-primary float-right">Create</button>
                                    </div>
                                    <!-- /.card-body -->
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
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
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/backend')}}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{asset('js/subCategory.js')}}"></script>
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
            // $("#example1").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection