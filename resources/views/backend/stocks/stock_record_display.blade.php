@extends('backend.layouts.app')

@section('title')
{{ env('APP_NAME') }} | Stock Records
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
                    <h1 class="m-0"><i class="fab fa-stripe-s"></i> Stock Record Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-stripe-s mt-1 mr-1"></i> Stock Record</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i> Stock Details</h3>
                        </div>
                        <div class="card-body box-profile">
                            <h5><strong>Product:</strong> {{$stock->product->name}}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Color:</strong> {{$stock->color->name}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Size:</strong> {{$stock->size->measurement .' ('.$stock->size->unit.')'}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Buying Price:</strong> {{$stock->product->buying_price .' Tk'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Selling Price:</strong> {{$stock->product->selling_price .' Tk'}}</p>
                                </div>
                            </div>
                            <p><strong>Creator:</strong> {{$stock->user->name}}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Started From:</strong> {{$stock->created_at->format('d.m.Y').' ('. $stock->created_at->format('i:H').')'}}</)}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Last Update:</strong> {{$stock->updated_at->format('d.m.Y').' ('.$stock->updated_at->format('i:H').')'}}</p>
                                </div>
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-history mr-2"></i> Last History</h3>
                        </div>
                        <div class="card-body box-profile text-center">
                            <p><strong>Current:</strong> {{$stock->current_stock}}</p> <hr>
                            <p><strong>Stock In:</strong> {{$stock->stock_in}}</p> <hr>
                            <p><strong>Restock:</strong> {{$stock->restock}}</p> <hr>
                            <p><strong>Status:</strong> {!! App\Models\Stock::getStatus($stock->status) !!}</p>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-5"><strong>Stock Record List ({{$records->count()}})</strong></h3>
                            <a href="{{route('utilize.stockRecord.excel_report', $stock->id)}}" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Convert to Excel</a>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="15%">name</th>
                                    <th width="10%">Current</th>
                                    <th width="10%">Stock In</th>
                                    <th width="10%">Stock Out</th>
                                    <th width="10%">Re-Stock</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Creator</th>
                                    <th width="10%">Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr>
                                        <td width="5%">{{ $record->id }}</td>
                                        <td width="15%">{{ $record->stock->product->name }}</td>
                                        <td width="15%">{{ $record->current_stock }}</td>
                                        <td width="15%">{{ $record->stock_in }}</td>
                                        <td width="15%">{{ $record->stock_out }}</td>
                                        <td width="15%">{{ $record->restock }}</td>
                                        <td width="15%">{!! App\Models\Stock_record::getStatus($record->status) !!}</td>
                                        <td width="15%">{{ isset($record->user->name) ? $record->user->name : 'N/A' }}</td>
                                        <td width="15%">{{ $record->updated_at->format('d.m.Y').' ('.$record->updated_at->format('i:H').')' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{$records->links()}}
                            </ul>
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
    
@endsection