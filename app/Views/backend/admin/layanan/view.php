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
                    <a href="<?= base_url('') ?>">
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
                        <select class="form-control"
                                name="status" id="status">
                            <option value="tunda">TUNDA</option>
                            <option value="proses">PROSES</option>
                            <option value="batal">BATAL</option>
                            <option value="selesai">SELESAI</option>
                            <option value="">Seluruh Status</option>
                        </select>
                    </div>

                    <h2 class="card-title">Layanan Klinik</h2>

                </header>
                <div class="card-body">
                    <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>
                        </div>
                    <?php } ?>

                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#div_rekam" data-toggle="tab">Rekam Medis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#div_konsultasi" data-toggle="tab">Konsultasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#div_surat" data-toggle="tab">Pembuatan Surat</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="div_rekam" class="tab-pane active">
                                <form method="post" enctype="multipart/form-data"
                                      action="<?= base_url('print-rekam') ?>" target="_blank">
                                    <?= csrf_field() ?>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control select2"
                                                    name="id_pasien_fk" id="id_pasien_fk">
                                                <?php foreach ($dataPasien as $i) : ?>
                                                    <option value="<?= ($i['id_pasien_fk']) ?>"><?= $i['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-secondary"><i
                                                        class="fas fa-print"></i>
                                                Cetak Rekam Medis Pasien
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <hr/>
                                <table class="table table-bordered table-striped mb-0" id="rekam_medis_datatable">
                                    <thead class="th-primary">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="10%">Jadwal</th>
                                        <th width="5%">No Urut</th>
                                        <th width="10%">ID Pasien</th>
                                        <th width="10%">Nama Pasien</th>
                                        <th width="20%">Nama Petugas</th>
                                        <th width="15">Poli</th>
                                        <th width="5%">Status</th>
                                        <th width="15%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div id="div_konsultasi" class="tab-pane">
                                <table class="table table-bordered table-striped mb-0" id="konsultasi_datatable">
                                    <thead class="th-primary">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="10%">Jadwal</th>
                                        <th width="5%">No Urut</th>
                                        <th width="20%">Nama Pasien</th>
                                        <th width="20%">Nama Petugas</th>
                                        <th width="15">Poli</th>
                                        <th width="5%">Status</th>
                                        <th width="15%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div id="div_surat" class="tab-pane">
                                <table class="table table-bordered table-striped mb-0" id="surat_datatable">
                                    <thead class="th-primary">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="15%">Jadwal</th>
                                        <th width="5%">No Urut</th>
                                        <th width="15%">Nama Pasien</th>
                                        <th width="20%">Nama Petugas</th>
                                        <th width="15">Poli</th>
                                        <th width="5%">Status</th>
                                        <th width="15%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


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
    var table_rekam, table_konsultasi, table_surat;
    var base_url = '<?=base_url();?>';

    $(document).ready(function () {
        $('.select2').select2({
            width: '100%',
            height: '100%'
        });

        $(window).resize(function () {
            $('.select2').css('width', "100%");
        });

        table_rekam = $('#rekam_medis_datatable').dataTable({
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
                "url": "<?=base_url('dashboard/layanan/read/');?>",
                "type": "POST",
                data: function (d) {
                    d.<?= csrf_token() ?> = token;
                    d.layanan = 'Rekam Medis';
                    d.status = $('#status').val();


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
                    "targets": [0, 1, 2, 7, 8]
                },
                {
                    "orderable": false,
                    "targets": [0, 1, 8]
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
        table_rekam.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?=csrf_token()?>;
            $('[name="csrf_test_name"]').val(token);
        });

        table_konsultasi = $('#konsultasi_datatable').dataTable({
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
                "url": "<?=base_url('dashboard/layanan/read/');?>",
                "type": "POST",
                data: function (d) {
                    d.<?= csrf_token() ?> = token;
                    d.layanan = 'Konsultasi';
                    d.status = $('#status').val();


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
                    "targets": [0, 1, 2, 6, 7]
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
        table_konsultasi.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?=csrf_token()?>;
            $('[name="csrf_test_name"]').val(token);
        });

        table_surat = $('#surat_datatable').dataTable({
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
                "url": "<?=base_url('dashboard/layanan/read/');?>",
                "type": "POST",
                data: function (d) {
                    d.<?= csrf_token() ?> = token;
                    d.layanan = 'Pembuatan Surat';
                    d.status = $('#status').val();


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
                    "targets": [0, 1, 2, 6, 7]
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
        table_surat.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?=csrf_token()?>;
            $('[name="csrf_test_name"]').val(token);
        });

    });

    $("#status").change(function () {
        table_surat.DataTable().ajax.reload(null, true);
        table_konsultasi.DataTable().ajax.reload(null, true);
        table_rekam.DataTable().ajax.reload(null, true);
    });


    // initialize datatable

</script>
<?= $this->endSection(); ?>
<!-- end js -->