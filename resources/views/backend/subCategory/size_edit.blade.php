@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Size Edit
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
                    <h1 class="m-0"><i class="fab fa-speakap"></i> Edit Size's Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-speakap mt-1 mr-1"></i> Edit Size</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">                                           
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Size Details</h3>
            </div>
        <form action="{{route('customize.size.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" name="size_id" value="{{$size->id}}" >
                                    <label for="exampleInputBorderWidth2">Name :</label>
                                    <input type="text" name="size" value="{{$size->measurement}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Measurement">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Unit :</label>
                                    <input type="text" name="unit" value="{{$size->unit}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Unit">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Select Category: </label>
                            <select name="sub_category" class="form-control select2 select2-muted" data-dropdown-css-class="select2-muted" style="width: 100%;">
                                @foreach($subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}" @isset($size){{ $size->sub_category_id == $subCategory->id ? 'selected': '' }} @endisset>{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
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
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection