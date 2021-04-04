<div class="modal fade" id="modal-subCategory">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content bg-secondary">
        <div class="modal-header bg-navy color-palette">
            <h4 class="modal-title">Create a New Sub-category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('customize.subCategory.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">Name :</label>
                            <input type="text" name="subCategory_name" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Sub-category Name">
                        </div>
                        <div class="form-group">
                            <label>Select Category: </label>
                            <select name="category" class="form-control select2 select2-muted" data-dropdown-css-class="select2-muted" style="width: 100%;">
                                <option selected="selected" value="" disabled>Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Image :</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="subCategory_image" type="file" class="custom-file-input imageUpload" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <img id="imagePreview" src="https://www.eduprizeschools.net/wp-content/uploads/2016/06/No_Image_Available.jpg" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="Brand Image Upload">
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