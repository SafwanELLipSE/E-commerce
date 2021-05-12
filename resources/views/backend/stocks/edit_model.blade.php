<div class="modal fade" id="modal-Edit">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content bg-secondary">
        <div class="modal-header bg-navy color-palette">
            <h4 class="modal-title">Stock In Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('utilize.stock.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <input type="hidden" name="stock_id" id="stock_id" value="">
                <div class="form-group">
                    <label for="exampleInputRestock">Stock Edit</label>
                    <input type="number" name="edit_stock" class="form-control" value="{{ old('edit_stock') }}" id="exampleInputRestock" placeholder="Wanna Edit the Stock ??">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Update</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>