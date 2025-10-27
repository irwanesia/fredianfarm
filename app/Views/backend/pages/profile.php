<?= $this->extend('backend/layout/pages-layout') ?>
<?= $this->section('content') ?>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <a href="modal" class="edit-avatar btn-block" data-toggle="modal" data-target="#user_upload_picture" type="button"><i class="fa fa-pencil"></i></a>
                <img src="<?= get_user()->picture == null ? '/images/users/default-avatar.png' : '/images/users/' . get_user()->picture ?>" alt="" class="avatar-photo">
            </div>
            <h5 class="text-center h5 mb-0 ci-user-name"><?= get_user()->name ?></h5>
            <p class="text-center text-muted font-14">
                <?= get_user()->email ?>
            </p>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal_details" role="tab">Personal Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#change_password" role="tab">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- personal details Tab start -->
                        <div class="tab-pane fade show active" id="personal_details" role="tabpanel">
                            <div class="pd-20">
                                <!-- ------ personal details -------- -->
                                <form action="<?= route_to('update-personal-details') ?>" method="POST" id="personal_details_form">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter full name" value="<?= get_user()->name ?>">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?= get_user()->username ?>">
                                                <span class="text-danger error-text username_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bio</label>
                                        <textarea type="text" name="bio" cols="30" rows="10" class="form-control" placeholder="Bio..."><?= get_user()->bio ?></textarea>
                                        <span class="text-danger error-text bio_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- personal details Tab End -->
                        <!-- change password Tab start -->
                        <div class="tab-pane fade" id="change_password" role="tabpanel">
                            <div class="pd-20 profile-task-wrap">
                                <!-- ------ change password -------- -->
                                <form action="<?= route_to('change-password') ?>" method="post" id="change_password_form">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="ci_csrf_data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Current password</label>
                                                <input type="password" class="form-control" name="current_password" placeholder="Enter current password">
                                                <!-- <div class="input-group-append custom">
                                                    <span class="input-group-text" id="togglePassword">
                                                        <i class="dw dw-eye mr-2" onclick="togglePassword()"></i>
                                                        <i class="dw dw-padlock1"></i>
                                                    </span>
                                                </div> -->
                                                <span class="text-danger error-text current_password_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">New password</label>
                                                <input type="password" class="form-control" name="new_password" placeholder="Enter new password">

                                                <span class="text-danger error-text new_password_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Confirm new password</label>
                                                <input type="password" class="form-control" name="confirm_new_password" placeholder="Enter confirm new password">
                                                <span class="text-danger error-text confirm_new_password_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Change password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- change password Tab End -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal untuk edit picture -->
<div class="col-md-4 col-sm-12 mb-30">
    <div class="modal fade" id="user_upload_picture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h4 class="modal-title" id="myLargeModalLabel">
                        Large modal
                    </h4> -->
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="<?= get_user()->picture == null ? '/images/users/default-avatar.png' : '/images/users/' . get_user()->picture ?>" alt="profile-picture" class="img-thumbnail" width="200" class="avatar-photo">
                        </div>
                        <div class="col-md-7">
                            <form action="<?= route_to('admin.upload-picture') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Picture Upload</label>
                                    <input type="file" name="pic" id="" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- akhir modal untuk edit picture -->

<?= $this->endSection() ?>

<!-- kode jquery/javascripts -->
<?= $this->section('scripts') ?>
<script>
    // Menentukan event handler untuk event submit dari formulir dengan ID personal_details_form
    $('#personal_details_form').on('submit', function(e) {
        // Mencegah perilaku default dari formulir (yaitu, mengirim formulir dan memuat ulang halaman)
        e.preventDefault();
        // alert('submit......!');
        var form = this; // Menyimpan referensi ke elemen formulir.
        var formdata = new FormData(form); // Membuat objek FormData dari formulir. FormData adalah objek built-in JavaScript yang dapat digunakan untuk mengelola data formulir

        $.ajax({
            url: $(form).attr('action'), // URL tujuan permintaan AJAX diambil dari atribut action dari formulir.
            method: $(form).attr('method'), // Metode HTTP untuk permintaan diambil dari atribut method dari formulir.
            data: formdata, // Data yang dikirim adalah objek FormData yang telah dibuat sebelumnya.
            processData: false, // Menginstruksikan jQuery untuk tidak memproses data yang dikirim (karena data sudah dalam bentuk FormData)
            dataType: 'json', // Mengharapkan respons dari server dalam format JSON 
            contentType: false, // Menginstruksikan jQuery untuk tidak mengatur tipe konten (karena FormData akan mengatur tipe konten secara otomatis).
            beforeSend: function() { // 1. Callback Sebelum Mengirim Data:
                toastr.remove(); // Menghapus semua notifikasi toastr yang ada (untuk membersihkan layar dari notifikasi sebelumnya).
                $(form).find('span.error-text').text(''); // Menghapus teks kesalahan sebelumnya dari elemen span dengan kelas error-text
            },
            success: function(response) { // 2. Callback Ketika Permintaan Berhasil:
                if ($.isEmptyObject(response.error)) { //  Memeriksa apakah objek error dalam respons kosong (tidak ada kesalahan).
                    if (response.status = 1) { // if (response.status == 1) { ... }: Memeriksa apakah status dalam respons adalah 1 (berhasil)
                        $('.ci-user-name').each(function() { //  Mengubah teks elemen dengan kelas ci-user-name menjadi name dari user_info dalam respons
                            $(this).html(response.user_info.name);
                        });
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                } else {
                    $.each(response.error, function(prefix, val) {
                        // jika ada kesalahan dalam respons, iterasi melalui kesalahan dan tampilkan di elemen span yang sesuai dalam formulir.
                        $(form).find('span.' + prefix + '_error').text(val);
                    });
                }
                //          FormData:

                // FormData adalah objek yang dapat menyimpan pasangan kunci/nilai, biasanya untuk mewakili data formulir, dan dapat dikirim menggunakan AJAX.
                // Toastr:

                // toastr adalah pustaka JavaScript untuk menampilkan notifikasi di halaman web.
                // Kesimpulan
                // Kode di atas adalah contoh yang baik dari bagaimana menangani pengiriman formulir secara asinkron menggunakan jQuery dan AJAX. Ini memastikan bahwa pengguna tidak perlu menunggu halaman dimuat ulang dan memberikan umpan balik instan melalui notifikasi saat formulir berhasil dikirim atau jika terjadi kesalahan
            }
        });
    });

    // change password
    $('#change_password_form').on('submit', function(e) {
        e.preventDefault();
        // alert('submit...');
        // csrf hash
        var csrfName = $('.ci_csrf_data').attr('name'); // csrf token name
        var csrfHash = $('.ci_csrf_hash').val();
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
                // update csrf hash
                $('.ci_csrf_data').val(response.token);
                if ($.isEmptyObject(response.error)) {
                    if (response.status = 1) {
                        $(form)[0].reset();
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

    // togle password untuk fitur lihat password
    function togglePassword() {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.getElementById('togglePassword').childNodes[1];
        // console.log(toggleIcon);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('dw-eye');
            toggleIcon.classList.add('dw-hide');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('dw-hide');
            toggleIcon.classList.add('dw-eye');
        }
    }
</script>
<?= $this->endSection() ?>