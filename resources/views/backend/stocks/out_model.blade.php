<div class="modal fade" id="modal-Out">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content bg-secondary">
        <div class="modal-header bg-navy color-palette">
            <h4 class="modal-title">Stock Out Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('utilize.stock.save_out')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <input type="hidden" name="stock_id" id="stock_id" value="">
                <div class="form-group">
                    <label for="exampleInputRestock">Stock Out</label>
                    <input type="number" name="out_stock" class="form-control" value="{{ old('out_stock') }}" id="exampleInputRestock" placeholder="Stock-Out the Product from Stock-In.">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Save changes</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>