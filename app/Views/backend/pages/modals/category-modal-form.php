<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="<?= route_to('add-category') ?>" method="POST" id="add_category_form">
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
                <div class="form-group">
                    <label for="">Category name</label>
                    <input type="text" name="category_name" id="" class="form-control" placeholder="Enter category name">
                    <span class="text-danger error-text category_name_error"></span>
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