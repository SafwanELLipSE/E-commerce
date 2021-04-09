<div class="modal fade" id="modal-size">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content bg-secondary">
        <div class="modal-header bg-navy color-palette">
            <h4 class="modal-title">Create a New Size</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('customize.size.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Measurement :</label>
                                    <input type="text" name="size" value="{{old('size')}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Size">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputBorderWidth2">Unit :</label>
                                    <input type="text" name="unit" value="{{old('unit')}}" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Unit">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Select Sub-Category: </label>
                            <select name="sub_category" class="form-control select2 select2-muted" data-dropdown-css-class="select2-muted" style="width: 100%;">
                                <option selected="selected" value="" disabled>Select a Sub-Category</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}"  @if (old('sub_category') == $subCategory->id) {{ 'selected' }} @endif>{{$subCategory->name}}</option>
                                @endforeach
                            </select>
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