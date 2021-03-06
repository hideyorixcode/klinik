<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') ?>"/>
<link rel="stylesheet"
      href="<?= base_url('public/assets/vendor/datatables/media/css/dataTables.bootstrap4.min.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/assets/vendor/select2/css/select2.css') ?>"/>

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

    <!-- start: page -->

    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>

                    <h2 class="card-title">Informasi Jadwal Klinik</h2>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <div class="mb-3">
                                <a href="<?= base_url('dashboard/jadwal/form') ?>" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <select name="hari" id="hari"
                                    class="form-control">
                                <option value="">-Seluruh Hari-</option>
                                <?php
                                $x = 0;
                                while ($x < count(enumValues('jadwal', 'hari'))) {
                                    $stringhari = enumValues('jadwal', 'hari')[$x];
                                    ?>
                                    <option value="<?= $stringhari ?>">
                                        <?= strtoupper($stringhari) ?></option>
                                    <?php
                                    $x++;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <select class="form-control select2"
                                    name="idpetugas_fk" id="idpetugas_fk">
                                <option value="">-Seluruh Dokter/Bidan-</option>
                                <?php foreach ($dataPetugas as $x) : ?>
                                    <option value="<?= ($x['id']) ?>"><?= $x['nama'] . ' [' . strtoupper($x['level']) . ']' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <select class="form-control select2"
                                    name="id_poli_fk" id="id_poli_fk">
                                <option value="">-Seluruh Poli-</option>
                                <?php foreach ($dataPoli as $i) : ?>
                                    <option value="<?= ($i['id_poli']) ?>"><?= $i['nama_poli'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <button onclick="reload_table();" class="btn btn-secondary"><i
                                        class="fas fa-arrow-alt-circle-right"></i>
                                Filter
                            </button>
                        </div>
                    </div>


                    <hr/>
                    <table class="table table-bordered table-striped mb-0" id="hideyori_datatable">
                        <thead class="th-primary">
                        <tr>
                            <th width="5%">#</th>
                            <th width="5%">No.</th>
                            <th width="10%">Hari</th>
                            <th width="20%">Waktu</th>
                            <th width="20%">Nama Petugas</th>
                            <th width="20%">Poli</th>
                            <th width="5%">Active</th>
                            <th width="15%">Options</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" id="check-all" data-toggle="tooltip" title="Check All"/>
                            </td>
                            <td colspan="4">
                                <div class="btn-group flex-wrap pull-left">
                                    <button class="btn btn-xs btn-danger" type="button"
                                            onclick="bulk_delete()"><i class="fas fa-trash-alt"></i> Hapus Seluruhan (<i
                                                class="fas fa-check"></i>)
                                    </button>
                                    <button class="btn btn-outline-success btn-xs" type="button"
                                            onclick="bulk_status(1, 'AKTIF');">
                                        <i class="fas fa-check-square"></i> Aktif Seluruhan (<i
                                                class="fas fa-check"></i>)
                                    </button>
                                    <button class="btn btn-outline-danger btn-xs" type="button"
                                            onclick="bulk_status(0, 'NON AKTIF');">
                                        <i class="fas fa-ban"></i> Nonaktif Seluruhan (<i class="fas fa-check"></i>)
                                    </button>
                                </div>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>
<!-- end content -->

<?= $this->section('modal'); ?>

<?= $this->endSection(); ?>
<!-- end modal -->

<?= $this->section('js'); ?>

<script src="<?= base_url('public/assets/vendor/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js') ?>"></script>
<script
        src="<?= base_url('public/assets/vendor/datatables/extras/TableTools/Responsive-2.2.0/js/dataTables.responsive.min.js') ?>">
</script>
<script
        src="<?= base_url('public/assets/vendor/datatables/extras/TableTools/Responsive-2.2.0/js/responsive.bootstrap4.min.js') ?>">
</script>
<script src="<?= base_url('public/assets/vendor/select2/js/select2.js') ?>"></script>

<script>
    var token = "<?=csrf_hash()?>";
    var table;
    var base_url = '<?=base_url();?>';

    $(document).ready(function () {
        $('.select2').select2({
            width: '100%',
            height: '100%'
        });

        $(window).resize(function () {
            $('.select2').css('width', "100%");
        });
        // initialize datatable
        table = $('#hideyori_datatable').dataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            fixedHeader: true,
            responsive: true,
            "aLengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "order": [],
            "ajax": {
                "url": "<?=base_url('dashboard/jadwal/read/');?>",
                "type": "POST",
                data: function (d) {
                    d.<?= csrf_token() ?> = token;
                    d.hari = $('#hari').val();
                    d.idpetugas_fk = $('#idpetugas_fk').val();
                    d.id_poli_fk = $('#id_poli_fk').val();
                }
            },
            responsive: {
                details: {
                    type: 'column',
                    target: -1
                }
            },
            columnDefs: [{
                targets: -1,
                orderable: false,
                className: 'control dt-center',
            },
                {
                    "className": "dt-center",
                    "targets": [0, 1, 2, 3, 6, 7]
                },
                {
                    "orderable": false,
                    "targets": [0, 1, 7]
                },
            ],
            language: {
                "searchPlaceholder": "Cari...",
                "sSearch": "",
                "info": "Menampilkan Halaman ke _PAGE_ dari _PAGES_",
                "lengthMenu": "_MENU_ Data/Halaman",
                "sEmptyTable": "tidak ada data",
                processing: '<i class="fa fa-spinner fa-spin"></i> memuat data<span class="sr-only">Loading...</span>',
            },
            "drawCallback": function (settings) {
                console.log(settings.json);
            },
        });
        table.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?=csrf_token()?>;
        });
    });


    function reload_table() {
        table.DataTable().ajax.reload(null, true);
    }

    function delete_jadwal(id) {
        var data_token = {
            <?=csrf_token()?>: token
        }

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
                    url: "<?=base_url('dashboard/jadwal/delete/');?>/" + id,
                    type: "GET",
                    data: data_token,
                    dataType: "JSON",
                    success: function (data) {
                        new_csrf_token = data.csrf_token;
                        token = new_csrf_token;
                        table.DataTable().ajax.reload(null, false);
                        new PNotify({
                            title: 'Sukses',
                            text: 'Data Berhasil Dihapus',
                            type: 'success',
                            icon: 'fas fa-check'
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        new PNotify({
                            title: 'Gagal',
                            text: 'Data Gagal Dihapus',
                            type: 'error',
                            icon: 'fas fa-times'
                        });
                    }
                });
            }
        })
    }

    $('#hideyori_datatable').on('page.dt', function () {
        $("#check-all").prop('checked', false);
    });

    $("#check-all").click(function () {
        if ($(this).is(':checked')) {
            $(".data-check").prop('checked', $(this).prop('checked'));
            var rows = $('#hideyori_datatable').find('tbody tr');
            rows.addClass('table-primary');
        } else {
            $(".data-check").prop('checked', false);
            var rows = $('#hideyori_datatable').find('tbody tr');
            rows.removeClass('table-primary');
        }
    });


    $('#hideyori_datatable').on('click', '.data-check', function () {
        if ($(this).is(':checked')) {
            $(this).closest('tr').addClass('table-primary');
        } else {
            $(this).closest('tr').removeClass('table-primary');
        }
    });


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
                        url: "<?=base_url('dashboard/jadwal/bulk_delete')?>",
                        dataType: "JSON",
                        success:

                            function (data) {
                                if (data.status) {
                                    new_csrf_token = data.csrf_token;
                                    token = new_csrf_token;
                                    table.DataTable().ajax.reload(null, false);
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
                title: 'Yakin akan ' + Teks + ' : ' + list_id.length + ' data yg telah dipilih ?',
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
                            active: changeActive,
                            <?=csrf_token()?>: token
                        },
                        url: "<?=base_url('dashboard/jadwal/bulk_status')?>",
                        dataType: "JSON",
                        success:

                            function (data) {
                                if (data.status) {
                                    new_csrf_token = data.csrf_token;
                                    token = new_csrf_token;
                                    table.DataTable().ajax.reload(null, false);
                                    new PNotify({
                                        title: 'Sukses',
                                        text: 'Berhasil ' + Teks + ' ' + list_id.length + ' data',
                                        type: 'success',
                                        icon: 'fas fa-check'
                                    });
                                    $('#check-all').prop('checked', false); // Unchecks
                                } else {
                                    new PNotify({
                                        title: 'Gagal ' + Teks + ' ' + list_id.length + ' data',
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
                title: 'Silahkan pilih data yang akan ' + Teks,
                type: 'warning',
                icon: 'fas fa-info'
            });
        }
    }
</script>
<?= $this->endSection(); ?>
<!-- end js -->