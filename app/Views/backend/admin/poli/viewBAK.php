<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?><!-- end css -->

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
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Data Poli</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="hideyori-datatable">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th class="all">Nama Poli</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <button class="mb-1 mt-1 mr-1 modal-basic btn btn-primary" href="#modalDeletex">Primary</button>

    <a class="mb-1 mt-1 mr-1 btn btn-default" data-toggle="modal" data-target="#modalBootstrap" href="#">Bootstrap</a>
</section>


<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<div id="modalDeletex" class="modal-block modal-header-color modal-block-danger mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Apakah anda ingin menghapus data ini?</h2>
        </header>
        <div class="card-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="modal-text">
                    <h4>Perhatian</h4>
                    <p>Data yang anda hapus, tidak akan kembali</p>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary modal-confirm">Konfirmasi</button>
                    <button class="btn btn-default modal-dismiss">Batal</button>
                </div>
            </div>
        </footer>
    </section>
</div>


<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apakah anda ingin menghapus data ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Data yang anda hapus, tidak akan kembali</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnkonfirmasi" onclick="delete_poli()">Konfirmasi</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div class="modal">
</div>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>
<script src="<?= base_url('public/assets/vendor/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
    var token = "<?= csrf_hash() ?>";
    var table;
    var base_url = '<?= base_url();?>';
    $(document).ready(function () {
        // initialize datatable
        table = $('#hideyori-datatable').dataTable(
            {
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                fixedHeader: true,
                responsive: true,
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('dashboard/poli/read/'); ?>",
                    "type": "POST",
                    data: function (d) {
                        d.<?= csrf_token() ?> = token;
                    }
                },
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        className: 'control dt-center',
                    },
                    {
                        "className": "dt-center",
                        "targets": [0, 2]
                    },
                    {
                        "orderable": false,
                        "targets": [0, 2]
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
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
            });
        table.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?= csrf_token() ?>;
        });
    });


    function reload_table() {
        table.DataTable().ajax.reload(null, true);
    }

    function konfirmasiDelete(id) {
        $('#modalDelete').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
        $('#modalDelete').modal('show'); // show bootstrap modal when complete loaded
        $("#btnkonfirmasi").attr("onclick","delete_poli('"+id+"')");

    }

    (function ($) {

        'use strict';

        /*
        Basic
        */
        $('.modal-basic').magnificPopup({
            type: 'inline',
            preloader: false,
            modal: true
        });

        /*
        Modal Dismiss
        */
        $(document).on('click', '.modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });

        /*
        Modal Confirm
        */
        $(document).on('click', '.modal-confirm', function (e) {
            e.preventDefault();
            $.magnificPopup.close();

            new PNotify({
                title: 'Success!',
                text: 'Modal Confirm Message.',
                type: 'success'
            });
        });

    }).apply(this, [jQuery]);


    function delete_poli(id) {
        var data_token = {
            <?= csrf_token() ?>:
            token
        }
        $.ajax({
            url: "<?= base_url('dashboard/poli/delete/'); ?>/" + id,
            type: "GET",
            data: data_token,
            dataType: "JSON",
            success: function (data) {
                new_csrf_token = data.csrf_token;
                token = new_csrf_token;
                table.DataTable().ajax.reload(null, false);
                $('#modalDelete').modal('hide');
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
</script>
<?= $this->endSection(); ?><!-- end js -->
