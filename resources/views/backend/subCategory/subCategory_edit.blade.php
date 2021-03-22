@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Sub-Category Edit
@endsection
@section('additional_headers')

@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-speakap"></i> Edit Sub-Category's Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-speakap mt-1 mr-1"></i> Edit Sub-Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">                                           
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Sub-Category Details</h3>
            </div>
        <form action="{{route('customize.subCategory.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" name="brand_id" value="{{$subCategory->id}}" >
                            <label for="exampleInputBorderWidth2">Name :</label>
                            <input type="text" name="brand_name" value="{{$subCategory->name}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Brand Name">
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
                        <img id="imagePreview" src="/subCategory_image/{{$subCategory->image}}" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="{{$subCategory->name}}">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-sm bg-gradient-primary float-right">Create</button>
            </div>
        </form>
        </div>    
    </section>
    <!-- /.content -->
</div>
@endsection
@section('additional_scripts')
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