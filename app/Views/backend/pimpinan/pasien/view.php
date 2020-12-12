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

                    <h2 class="card-title">Data Pasien</h2>
                </header>
                <div class="card-body">


                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <select name="bpjs" id="bpjs"
                                    class="form-control">
                                <option value="">-Jenis Pasien-</option>
                                <option value="YA">BPJS</option>
                                <option value="TIDAK">UMUM</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <select name="bulan" id="bulan"
                                    class="form-control">
                                <option value="">-Seluruh Bulan-</option>
                                <option value="01">JANUARI</option>
                                <option value="02">FEBRUARI</option>
                                <option value="03">MARET</option>
                                <option value="04">APRIL</option>
                                <option value="05">MEI</option>
                                <option value="06">JUNI</option>
                                <option value="07">JULI</option>
                                <option value="08">AGUSTUS</option>
                                <option value="09">SEPTEMBER</option>
                                <option value="10">OKTOBER</option>
                                <option value="11">NOVEMBER</option>
                                <option value="12">DESEMBER</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <select name="tahun" id="tahun"
                                    class="form-control">
                                <option value="">-Seluruh Tahun-</option>
                                <?php foreach ($tahunPasien as $t) : ?>
                                    <option value="<?= $t['tahun'] ?>"><?= $t['tahun'] ?></option>
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
                            <th width="10%">ID</th>
                            <th width="10%" class="all">Username</th>
                            <th width="10%" class="all">Nama</th>
                            <th width="10%">Jenis Pasien</th>
                            <th width="10%">JK</th>
                            <th width="15%">Alamat</th>
                            <th width="10%">Active</th>
                            <th width="10%">Foto</th>
                            <th width="15%">Options</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </section>
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
                "url": "<?=base_url('dashboard/pasien/readUser/');?>",
                "type": "POST",
                data: function (d) {
                    d.<?=csrf_token()?> = token;
                    d.bpjs = $('#bpjs').val();
                    d.idpasien = [<?=$idpasiennya; ?>];
                    d.bulan = $('#bulan').val();
                    d.tahun = $('#tahun').val();

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
                    "targets": [0, 3, 6, 7, 8]
                },
                {
                    "orderable": false,
                    "targets": [0, 7, 8]
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


</script>
<?= $this->endSection(); ?>
<!-- end js -->