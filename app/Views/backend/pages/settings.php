<?= $this->extend('backend/layout/pages-layout') ?>
<?= $this->section('content') ?>
<!-- ---------- pages content here --------- -->
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Settings</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Settings
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- tab -->
<div class="pd-20 card-box mb-4">
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#general_settings" role="tab" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo & Favicon</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#social_media" role="tab" aria-selected="false">Social media</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="general_settings" role="tabpanel">
                <div class="pd-20">
                    <!-- ------ general settings ------ -->
                    <form action="<?= route_to('update-general-settings') ?>" method="POST" id="general_settings_form">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog title</label>
                                    <input type="text" class="form-control" name="blog_title" placeholder="Enter blog title" value="<?= get_settings()->blog_title ?>">
                                    <span class="text-danger error-text blog_title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog email</label>
                                    <input type="text" class="form-control" name="blog_email" placeholder="Enter blog email" value="<?= get_settings()->blog_email ?>">
                                    <span class="text-danger error-text blog_email_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog phone no</label>
                                    <input type="text" class="form-control" name="blog_phone" placeholder="Enter blog phone" value="<?= get_settings()->blog_phone ?>">
                                    <span class="text-danger error-text blog_phone_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Blog meta keywords</label>
                                    <input type="text" class="form-control" name="blog_meta_keywords" placeholder="Enter blog meta keywords" value="<?= get_settings()->blog_meta_keywords ?>">
                                    <span class="text-danger error-text blog_meta_keywords_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Blog meta description</label>
                            <textarea name="blog_meta_description" id="" cols="4" rows="3" class="form-control" placeholder="Write blog meta description"><?= get_settings()->blog_meta_description; ?></textarea>
                            <span class="text-danger error-text blog_meta_description_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="logo_favicon" role="tabpanel">
                <div class="pd-20">
                    <!-- ------ Logo Favicon ------ -->
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Set blog logo</h5>
                            <div class="mb-2 mt-1" style="max-width: 200px;">
                                <img src="/images/blog/<?= get_settings()->blog_logo ?>" alt="" class="img-thumbnail" id="logo-image-preview">
                            </div>
                            <form action="<?= route_to('update-blog-logo') ?>" method="POST" id="changeBlogLogoForm" enctype="multipart/form-data">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                                <div class="mb-2">
                                    <input type="file" name="blog_logo" id="fileInputLogo" class="form-control">
                                    <span class="text-danger error-text"></span>
                                </div>
                                <button type="submit" class="mt-2 btn btn-primary">Change logo</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Set blog favicon</h5>
                            <div class="mb-2 mt-1" style="max-width: 80px;">
                                <img src="/images/blog/<?= get_settings()->blog_favicon ?>" alt="" class="img-thumbnail" id="favicon-image-preview">
                            </div>
                            <form action="<?= route_to('update-blog-favicon') ?>" method="POST" id="changeBlogFaviconForm" enctype="multipart/form-data">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                                <div class="mb-2">
                                    <input type="file" name="blog_favicon" id="fileInputFavicon" class="form-control">
                                    <span class="text-danger error-text"></span>
                                </div>
                                <button type="submit" class="mt-2 btn btn-primary">Change favicon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="social_media" role="tabpanel">
                <div class="pd-20">
                    <!-- ------ Social Media ------ -->
                    <form action="<?= route_to('update-social-media') ?>" method="post" id="social_media_form">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Facebook URL</label>
                                    <input type="text" class="form-control" name="facebook_url" id="" placeholder="Enter facebook URL" value="<?= get_social_media()->facebook_url ?>">
                                    <span class="text-dengen error-text facebook_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Twitter URL</label>
                                    <input type="text" class="form-control" name="twitter_url" id="" placeholder="Enter twitter URL" value="<?= get_social_media()->twitter_url ?>">
                                    <span class="text-dengen error-text twitter_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Instagram URL</label>
                                    <input type="text" class="form-control" name="instagram_url" id="" placeholder="Enter instagram URL" value="<?= get_social_media()->instagram_url ?>">
                                    <span class="text-dengen error-text instagram_url_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Youtube URL</label>
                                    <input type="text" class="form-control" name="youtube_url" id="" placeholder="Enter youtube URL" value="<?= get_social_media()->youtube_url ?>">
                                    <span class="text-dengen error-text youtube_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">TikTok URL</label>
                                    <input type="text" class="form-control" name="github_url" id="" placeholder="Enter github URL" value="<?= get_social_media()->github_url ?>">
                                    <span class="text-dengen error-text github_url_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Linkedin URL</label>
                                    <input type="text" class="form-control" name="linkedin_url" id="" placeholder="Enter linkedin page URL" value="<?= get_social_media()->linkedin_url ?>">
                                    <span class="text-dengen error-text linkedin_url_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $('#general_settings_form').on('submit', function(e) {
        // Mencegah perilaku default dari formulir (yaitu, mengirim formulir dan memuat ulang halaman)
        e.preventDefault();
        // alert('submit......!');

        // CSRF HASH
        var csrfName = $('.ci_csrf_data').attr('name'); // CSRF token name
        var csrfHash = $('.ci_csrf_data').val(); // CSRF HASH
        var form = this;
        var formdata = new FormData(form);
        formdata.append(csrfName, csrfHash);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formdata,
            processData: false,
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                toastr.remove();
                $(form).find('span-error-text').text();
            },
            success: function(response) {
                // Update CSRF Hash
                $('.ci_csrf_data').val(response.token);

                if ($.isEmptyObject(response.error)) {
                    if (response.status == 1) {
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

    // $('input[type:"file"][name="blog_logo"]').ijaboViewer({
    //     preview: '#logo-image-preview',
    //     imageShape: 'rectangular', // or square if is avatar
    //     allowedExtensions: ['jpg', 'jpeg', 'png'],
    //     onErrorShape: function(message, element) {
    //         alert(message);
    //     },
    //     onInvalidType: function(message, element) {
    //         alert(message);
    //     },
    //     onSuccess: function(message, element) {

    //     }
    // });

    // penangani pratinjau image sebelum di upload
    document.getElementById('fileInputLogo').addEventListener('change', function(event) {
        previewImageLogo(event.target.files[0]);
    });

    document.getElementById('fileInputFavicon').addEventListener('change', function(event) {
        previewImageFavicon(event.target.files[0]);
    });

    function previewImageLogo(file) {
        var reader = new FileReader();

        reader.onload = function(event) {
            var imgElement = document.getElementById('logo-image-preview');
            imgElement.src = event.target.result;
            imgElement.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }

    function previewImageFavicon(file) {
        var reader = new FileReader();

        reader.onload = function(event) {
            var imgElement = document.getElementById('favicon-image-preview');
            imgElement.src = event.target.result;
            imgElement.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }

    $('#changeBlogLogoForm').on('submit', function(e) {
        e.preventDefault();
        // alert('submit...');
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        var form = this;
        var formdata = new FormData(form);
        formdata.append(csrfName, csrfHash);

        var inputFileVal = $(form).find('input[type="file"][name="blog_logo"]').val();

        if (inputFileVal.length > 0) {
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
                    // update CSRF_Hash
                    $('.ci_csrf_data').val(response.token);

                    if (response.status == 1) {
                        toastr.success(response.msg);
                        $(form)[0].reset();
                    } else {
                        toastr.error(response.msg);
                    }
                }
            });
        } else {
            $(form).find('span.error-text').text('Please, select logo image file. PNG file type is recommended.');
        }
    });

    $('#changeBlogFaviconForm').on('submit', function(e) {
        e.preventDefault();
        // alert('submit...');
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        var form = this;
        var formdata = new FormData(form);
        formdata.append(csrfName, csrfHash);

        var inputFileVal = $(form).find('input[type="file"][name="blog_favicon"]').val();

        if (inputFileVal.length > 0) {
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
                    // update CSRF_Hash
                    $('.ci_csrf_data').val(response.token);

                    if (response.status == 1) {
                        toastr.success(response.msg);
                        $(form)[0].reset();
                    } else {
                        toastr.error(response.msg);
                    }
                }
            });
        } else {
            $(form).find('span.error-text').text('Please, select favicon image file. PNG file type is recommended.');
        }
    });

    $('#social_media_form').on('submit', function(e) {
        e.preventDefault();
        // alert('submit...');

        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        var form = this;
        var formdata = new FormData(form);
        formdata.append(csrfName, csrfHash);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formdata,
            processData: false,
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                toastr.remove();
                $(form).find('span.error-text').text('');
            },
            success: function(response) {
                // update csrf
                $('.ci_csrf_data').val(response.token);

                if ($.isEmptyObject(response.error)) {
                    if (response.status == 1) {
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