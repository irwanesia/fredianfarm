<div class="modal fade" id="edit-subcategory-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="<?= route_to('update-subcategory') ?>" method="POST" id="update_subcategory_form">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Large modal
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- --- content here --- -->
                <input type="hidden" name="<?= csrf_token() ?>" class="ci_csrf_data" value="<?= csrf_hash() ?>">
                <input type="hidden" name="subcategory_id">
                <div class="form-group">
                    <label for=""><b>Parent category</b></label>
                    <select name="parent_cat" id="" class="form-control">
                        <option value="">Uncategorized</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""><b>Sub category name</b></label>
                    <input type="text" name="subcategory_name" id="" class="form-control" placeholder="Enter sub category name">
                    <span class="text-danger error-text subcategory_name_error"></span>
                </div>
                <div class="form-group">
                    <label for=""><b>Description</b></label>
                    <textarea name="description" id="" class="form-control" cols="30" rows="30" placeholder="Type....."></textarea>
                    <span class="text-danger error-text description_error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary action">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div>