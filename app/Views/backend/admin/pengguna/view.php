<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?>
    <!-- end css -->
<?= $this->section('content'); ?>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2><?= $judul ?></h2>

            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span><?= $judul ?></span></li>
                </ol>

                <span class="sidebar-right-toggle"><i class="fas fa-angle-double-down"></i></span>
            </div>
        </header>

        <div class="row mb-2">
            <div class="col-lg-12 col-xl-12 mb-4 mb-xl-0">

                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                        </div>

                        <h2 class="card-title">
                        <span
                                class="badge badge-primary label-sm font-weight-normal va-middle mr-3"><?= $jumlah_pengguna ?></span>
                            <span class="va-middle">Data Pengguna</span>
                        </h2>
                    </header>
                    <div class="card-body">
                        <div class="content">
                            <?= $this->include('backend/loaderData'); ?>
                            <div id="getViewData">
                                <?= $this->include('backend/admin/pengguna/tampildata'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-8 col-xl-8">
                                <form method="get" id="formCari" name="formCari" action="javascript:getSearchData();"
                                      style="width: 100%">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <input type="search" class="form-control" id="teks" name="teks"
                                                   placeholder="Cari Pengguna dan tekan enter...">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <select class="form-control" id="level_select" name="level_select">
                                                <option value="">-Seluruh Level-</option>
                                                <option value="admin">ADMIN</option>
                                                <option value="pimpinan">PIMPINAN</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <button class="btn btn-success waves-effect waves-light"><i
                                                        class="fas fa-search mr-1" type="submit"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light"
                                       onclick="add()"><i class="fas fa-plus mr-1"></i> Tambah Pengguna</a>
                                </div>
                            </div><!-- end col-->
                        </div>
                    </div>

            </div><!-- end col-->
        </div>
        <!-- end row -->

        <!-- end row -->

    </section> <!-- content -->
<?= $this->endSection(); ?>
    <!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->include('backend/admin/pengguna/modal'); ?>
<?= $this->endSection(); ?>
    <!-- end modal -->

<?= $this->section('js'); ?>

    <script>
        var mode = 'tampil';
        var token = "<?=csrf_hash()?>";
        var base_url = '<?=base_url();?>';


        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('id').split('page_link=')[1];
            if (mode == 'tampil') {
                getViewData(page);
            } else {
                getSearchData(page);
            }
        });


        function getViewData(page) {
            $(".loaderData").show();
            var urlData = '<?=base_url('dashboard/pengguna/getViewData?page_link=')?>';
            $.ajax({
                url: urlData + page,
                success: function (data) {
                    $('#getViewData').html(data);
                    $(".loaderData").hide();
                    mode = 'tampil';
                }
            });
        }

        function getSearchData(page = 1) {
            $(".loaderData").show();
            var teks = $("#teks").val();
            var level_select = $("#level_select").val();
            if (teks == '') {
                var urlData = '<?=base_url('dashboard/pengguna/getSearchData?level=')?>' + level_select + '&page_link=';
                mode = 'tampil';
            } else {
                var urlData = '<?=base_url('dashboard/pengguna/getSearchData?teks=')?>' + teks + '&level=' + level_select +
                    '&page_link=';
                mode = 'cari';
            }
            $.ajax({
                url: urlData + page,
                // data:{teks:teks},
                success: function (data) {
                    $('#getViewData').html(data);
                    $(".loaderData").hide();
                }
            });
        }

        $(document).ready(function () {
            $(".loaderData").hide();
        });

        function delete_id(id) {
            var data_token = {
                <?=csrf_token()?>: token
            };
            Swal.fire({
                title: 'Apakah anda ingin menghapus data ini',
                text: "Data yang anda hapus, tidak akan kembali",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?=base_url('dashboard/pengguna/delete')?>/" + id,
                        type: "GET",
                        data: data_token,
                        dataType: "JSON",
                        success: function (data) {
                            new_csrf_token = data.csrf_token;
                            token = new_csrf_token;
                            getViewData(1);
                            Swal.fire({
                                title: "Data berhasil dihapus",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1000,
                            })
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Data gagal dihapus",
                                type: "error",
                                showConfirmButton: false,
                                timer: 1000,
                            })
                        }
                    });
                }
            })
        }

        function add() {
            $('#modal_form').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-control').removeClass('is-invalid'); // clear error class
            $('.invalid-feedback').empty(); // clear error string
            $('#modal_form').appendTo("body");
            $('#modal_form').modal('show'); // show bootstrap modal
            $('#lblpassword').text('Password \n');
            $('#lblkonfirmasi').text('Konfirmasi Password\n');
            $('#lblpassword').attr("placeholder", "ketik password");
            $('#lblkonfirmasi').attr("placeholder", "ketik konfirmasi password");
            $('#gantijudul').text('TAMBAH PENGGUNA'); // Set Title to Bootstrap modal title
            $('#btnsave').html('<i class="fas fa-save"></i> Simpan');
            $('#label_hapus').hide();
            $('#remove_avatar').hide();
        }

        function edit(id) {
            $('#modal_form').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
            save_method = 'edit';
            $('#form')[0].reset(); // reset form on modals
            $('.form-control').removeClass('is-invalid'); // clear error class
            $('.invalid-feedback').empty(); // clear error string
            //Ajax Load data from ajax
            $.ajax({
                url: "<?=base_url('dashboard/pengguna/edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#btnsave').html('<i class="fas fa-save"></i> Simpan Perubahan');
                    $('#gantijudul').text('UBAH DATA PENGGUNA'); // Set Title to Bootstrap modal title
                    $('[name="id"]').val(id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="email"]').val(data.email);
                    $('[name="username"]').val(data.username);
                    $('[name="notelepon"]').val(data.notelepon);
                    $('[name="level"]').val(data.level);
                    $('[name="active"]').val(data.active);
                    $('#lblpassword').text('Password (Jika Merubah Password) \n');
                    $('#lblkonfirmasi').text('Konfirmasi Password (Jika Merubah Password) \n');
                    $('#lblpassword').attr("placeholder", "ketik password jika ingin dirubah");
                    $('#lblkonfirmasi').attr("placeholder", "ketik konfirmasi password jika ingin dirubah");

                    if (data.avatar) {
                        const logoPreview = document.querySelector('.img-preview');
                        logoPreview.src = base_url + '/public/uploads/' + data.avatar;
                        $('[name="remove_avatar"]').val(data.avatar);
                        $('#label_hapus').show();
                        $('#remove_avatar').show();
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.status);
                }
            });
        }

        function save() {
            var url;
            if (save_method == 'add') {
                url = "<?=base_url('dashboard/pengguna/create')?>";
            } else {
                url = "<?=base_url('dashboard/pengguna/update')?>";
            }
            var formData = new FormData($('#form')[0]);
            formData.append('<?=csrf_token()?>', token);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    new_csrf_token = data.csrf_token;
                    // alert(new_csrf_token);
                    token = new_csrf_token;
                    if (data.status_ajax) //if success close modal and reload ajax table
                    {
                        if (save_method == 'add') {

                            $('#modal_form').modal('hide');
                            getViewData(1);
                            Swal.fire({
                                title: "Berhasil Input Data",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                        } else {
                            $('#modal_form').modal('hide');
                            getViewData(1);
                            Swal.fire({
                                title: "Berhasil Ubah Data",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1000,
                            });
                        }
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').addClass(
                                'is-invalid'); //select parent twice to
                            $('#' + data.komponen_error[i] + '').text(data.error_string[i]);
                            $('[name="' + data.inputerror[i] + '"]').focus();
                        }
                    }

                },
                error: function (data) {
                    //alert(jqXHR.status);
                    new_csrf_token = data.csrf_token;
                    // alert(new_csrf_token);
                    token = new_csrf_token;
                    new PNotify({
                        title: 'Gagal',
                        text: 'Kesalahan Server (500)',
                        type: 'error',
                        icon: 'fas fa-times'
                    });
                }
            });
        }

        function bulk_delete() {
            var list_id = [];
            $(".data-check:checked").each(function () {
                list_id.push(this.value);
            });
            if (list_id.length > 0) {
                Swal.fire({
                    title: 'Yakin akan menghapus : ' + list_id.length + ' data yg telah dipilih ?',
                    text: "Cek kembali data anda sebelum dihapus",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            data: {
                                id: list_id,
                                <?=csrf_token()?>: token
                            },
                            url: "<?=base_url('dashboard/pengguna/bulk_delete')?>",
                            dataType: "JSON",
                            success:

                                function (data) {
                                    if (data.status) {
                                        new_csrf_token = data.csrf_token;
                                        token = new_csrf_token;
                                        getViewData(1);
                                        new PNotify({
                                            title: 'Sukses',
                                            text: 'Berhasil Hapus ' + list_id.length + ' data',
                                            type: 'success',
                                            icon: 'fas fa-check'
                                        });
                                        $('#check-all').prop('checked', false); // Unchecks
                                    } else {
                                        new PNotify({
                                            title: 'Gagal Hapus ' + list_id.length + ' data',
                                            type: 'error',
                                            icon: 'fas fa-times'
                                        });
                                    }
                                }

                            ,
                            error: function (jqXHR, textStatus, errorThrown) {
                                new PNotify({
                                    title: 'Data Gagal Dihapus',
                                    type: 'error',
                                    icon: 'fas fa-times'
                                });

                            }
                        });
                    }
                })
            } else {
                new PNotify({
                    title: 'Silahkan pilih data yang akan dihapus',
                    type: 'warning',
                    icon: 'fas fa-info'
                });
            }
        }

        function bulk_status(changeActive, Teks) {
            var list_id = [];
            $(".data-check:checked").each(function () {
                list_id.push(this.value);
            });
            if (list_id.length > 0) {
                Swal.fire({
                    title: 'Yakin akan '+Teks+' : ' + list_id.length + ' data yg telah dipilih ?',
                    text: "Cek kembali data",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            data: {
                                id: list_id,
                                active:changeActive,
                                <?=csrf_token()?>: token
                            },
                            url: "<?=base_url('dashboard/pengguna/bulk_status')?>",
                            dataType: "JSON",
                            success:

                                function (data) {
                                    if (data.status) {
                                        new_csrf_token = data.csrf_token;
                                        token = new_csrf_token;
                                        getViewData(1);
                                        new PNotify({
                                            title: 'Sukses',
                                            text: 'Berhasil '+Teks +' ' + list_id.length + ' data',
                                            type: 'success',
                                            icon: 'fas fa-check'
                                        });
                                        $('#check-all').prop('checked', false); // Unchecks
                                    } else {
                                        new PNotify({
                                            title: 'Gagal '+Teks +' ' +  list_id.length + ' data',
                                            type: 'error',
                                            icon: 'fas fa-times'
                                        });
                                    }
                                }

                            ,
                            error: function (jqXHR, textStatus, errorThrown) {
                                new PNotify({
                                    title: 'Data Gagal Dihapus',
                                    type: 'error',
                                    icon: 'fas fa-times'
                                });

                            }
                        });
                    }
                })
            } else {
                new PNotify({
                    title: 'Silahkan pilih data yang akan '+Teks,
                    type: 'warning',
                    icon: 'fas fa-info'
                });
            }
        }

        function previewImg() {
            const logo = document.querySelector('#avatar');
            const logoLabel = document.querySelector('.custom-file-label');
            const logoPreview = document.querySelector('.img-preview');

            logoLabel.textContent = logo.files[0].name;

            const fileLogo = new FileReader();
            fileLogo.readAsDataURL(logo.files[0]);

            fileLogo.onload = function (e) {
                logoPreview.src = e.target.result;
            }
        }
    </script>
<?= $this->endSection(); ?>