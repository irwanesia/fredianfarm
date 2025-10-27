<?= $this->extend('backend/layout/pages-layout') ?>
<?= $this->section('content') ?>
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Post</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home') ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Post
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="<?= route_to('all-posts') ?>" class="btn btn-primary">View all posts</a>
        </div>
    </div>
</div>

<form action="<?= route_to('update-post') ?>" method="post" autocomplete="off" enctype="multipart/form-data" id="updatePostForm">
    <input type="hidden" name="<?= csrf_hash() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
    <input type="hidden" name="post_id" value="<?= $post->id ?>">
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post title</b></label>
                        <input type="text" class="form-control" placeholder="Enter post title" name="title" value="<?= $post->title ?>">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for=""><b>Content</b></label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Type........"><?= $post->content ?></textarea>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                </div>
            </div>
            <div class="card card-box mb-2">
                <h5 class="card-header weight-500">SEO</h5>
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post meta keywords</b><small>(Separated by comma)</small></label>
                        <input type="text" name="meta_keywords" id="" class="form-control" placeholder="Enter post meta keywords" value="<?= $post->meta_keywords ?>">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Post meta description</b></label>
                        <textarea name="meta_description" id="" cols="30" rows="10" class="form-control" placeholder="Type meta description"><?= $post->meta_description ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post category</b></label>
                        <select name="category" id="" class="custtom-select form-control">
                            <?php

                            use App\Libraries\CiAuth;

                            foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>" <?= $category->id == $post->category_id ? 'selected' : '' ?>><?= $category->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=""><b>Post featured image</b></label>
                        <input type="file" name="featured_image" class="form-control-file form-control" height="auto" id="fileInputImage">
                        <span class="text-danger error-text featured_image_error"></span>
                    </div>
                    <div class="d-block mb-3" style="max-width: 250px;">
                        <img src="/images/posts/resized_<?= $post->featured_image ?>" alt="" class="img-thumbnail" id="image-previewer">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Tags</b></label>
                        <input type="text" name="tags" id="" class="form-control" placeholder="Enter tags" data-role="tagsinput" value="<?= $post->tags ?>">
                        <span class="text-danger error-text tags_error"></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for=""><b>Visibility</b></label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio1" class="custom-control-input" value="1" <?= $post->visibility == 1 ? 'checked' : '' ?>>
                            <label for="customRadio1" class="custom-control-label">Public</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio2" class="custom-control-input" value="0" <?= $post->visibility == 0 ? 'checked' : '' ?>>
                            <label for="customRadio2" class="custom-control-label">Private</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>

<?= $this->endSection() ?>

<!-- =============== script css ============== -->
<?= $this->section('stylesheets') ?>
<link rel="stylesheet" href="/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<?= $this->endSection() ?>

<!-- =============== script js ============== -->
<?= $this->section('scripts') ?>
<script src="/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="/extra-assets/ckeditor/ckeditor.js"></script>
<script>
    // ckeditor
    $(function() {
        var elfinderPath = '/extra-assets/elFinder/elfinder.src.php?integration=ckeditor&uid=<?= CiAuth::id() ?>';
        // alert(elfinderPath);
        CKEDITOR.replace('content', {
            filebrowserBrowseUrl: elfinderPath,
            filebrowserImageBrowseUrl: elfinderPath + '&type=image',
            removeDialogTabs: 'link:upload;image:upload'
        });
    });
    // pratinjau untuk gambar sebelum dilakukan upload
    document.getElementById('fileInputImage').addEventListener('change', function(event) {
        previewPostFeaturedImage(event.target.files[0]);
    });

    function previewPostFeaturedImage(file) {
        var reader = new FileReader();

        reader.onload = function(event) {
            var imgElement = document.getElementById('image-previewer');
            imgElement.src = event.target.result;
            imgElement.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }

    $('#updatePostForm').on('submit', function(e) {
        e.preventDefault();
        // alert('submit....');
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        var form = this;
        var content = CKEDITOR.instances.content.getData();
        var formdata = new FormData(form);
        formdata.append(csrfName, csrfHash);
        formdata.append('content', content);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formdata,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(response) {
                // update CSRF hash
                $('.ci_csrf_data').val(response.token);

                if ($.isEmptyObject(response.error)) {
                    if (response.status == 1) {
                        $(form)[0].reset();
                        $('img#image-previewer').attr('src', '');
                        $('input[name="tags"]').tagsinput('removeAll');
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                } else {
                    $.each(response.error, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val);
                    });
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>