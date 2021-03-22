@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Feature Edit
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
                    <h1 class="m-0"><i class="fas fa-sitemap"></i> Edit Feature's Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-sitemap mt-1 mr-1"></i> Edit Feature</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">                                           
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Feature Details</h3>
            </div>
        <form action="{{route('customize.feature.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" name="feature_id" value="{{$feature->id}}" >
                            <label for="exampleInputBorderWidth2">Name :</label>
                            <input type="text" name="feature_name" value="{{$feature->name}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Feature Name">
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
@endsection