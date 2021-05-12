<div class="modal fade" id="modal-reStock">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content bg-secondary">
        <div class="modal-header bg-navy color-palette">
            <h4 class="modal-title">Re-Supply with New Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('utilize.stock.save_restock')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <input type="hidden" name="stock_id" id="stock_id" value="">
                <div class="form-group">
                    <label for="exampleInputRestock">Restock</label>
                    <input type="number" name="restock" class="form-control" value="{{ old('restock') }}" id="exampleInputRestock" placeholder="Re-supply Product">
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