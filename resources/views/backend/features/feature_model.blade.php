<div class="modal fade" id="modal-Feature">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content bg-secondary">
        <div class="modal-header bg-navy color-palette">
            <h4 class="modal-title">Create a New feature_name</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('customize.feature.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Name :</label>
                            <input type="text" name="feature_name" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Feature Name">
                        </div>
                    </div>
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