@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Color Edit
@endsection
@section('additional_headers')
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
                    <h1 class="m-0"><i class="fab fa-cuttlefish"></i> Edit Color's Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-cuttlefish mt-1 mr-1"></i> Edit Color</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">                                           
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Color Details</h3>
            </div>
        <form action="{{route('customize.color.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <input type="hidden" name="color_id" value="{{$color->id}}" >
                            <label for="exampleInputBorderWidth2">Name :</label>
                            <input type="text" name="color_name" value="{{$color->name}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Color Name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Color picker: <p style="background-color:{{$color->code}} !important; border-color: white !important; width:70px; height:20px;" class="btn ml-5 mt-3"></p></label>
                            <input type="text" name="color_code" value="{{$color->code}}" class="form-control my-colorpicker1 form-control-border border-width-2" placeholder="Color Code">
                        </div>
                        <p class="text-center">Tip: Color code example will be "#55acee"</p>
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
    <!-- bootstrap color picker -->
    <script src="{{asset('assets/backend')}}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
             //Colorpicker
            $('.my-colorpicker1').colorpicker()
        });
    </script>
@endsection