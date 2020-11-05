<?=$this->extend('backend/template');?>

<?=$this->section('css');?>
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet"
      href="<?=base_url('public/assets/vendor/datatables/media/css/dataTables.bootstrap4.min.css')?>" />
<?=$this->endSection();?>
<!-- end css -->

<?=$this->section('content');?>

<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$judul?></h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?=base_url('dashboard')?>">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span><?=$judul?></span></li>
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

                    <h2 class="card-title">Log Aktivitas</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="hideyori_datatable">
                        <thead class="th-primary">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Waktu</th>
                            <th width="75%" class="all">Deskripsi</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <?php if($sesi_level=='admin') : ?>
                        <tfoot>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" id="check-all" data-toggle="tooltip" title="Check All" />
                            </td>
                            <td>
                                <button class="btn btn-xs btn-danger pull-left" type="button"
                                        onclick="bulk_delete()"><i class="fas fa-trash-alt"></i> Hapus Pilihan (<i class="fas fa-check"></i>)
                                </button>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>


<?=$this->endSection();?>
<!-- end content -->

<?=$this->section('modal');?>
<?=$this->endSection();?>
<!-- end modal -->

<?=$this->section('js');?>

<script src="<?=base_url('public/assets/vendor/datatables/media/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('public/assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js')?>"></script>
<script
        src="<?=base_url('public/assets/vendor/datatables/extras/TableTools/Responsive-2.2.0/js/dataTables.responsive.min.js')?>">
</script>
<script
        src="<?=base_url('public/assets/vendor/datatables/extras/TableTools/Responsive-2.2.0/js/responsive.bootstrap4.min.js')?>">
</script>

<script>
var token = "<?=csrf_hash()?>";
var table;
var base_url = '<?=base_url();?>';

$(document).ready(function() {
    // initialize datatable
    table = $('#hideyori_datatable').dataTable({
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
            "url": "<?=base_url('dashboard/log/read/');?>",
            "type": "POST",
            data: function(d) {
                d.<?=csrf_token()?> = token;
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
                "targets": [0, 3]
            },
            {
                "orderable": false,
                "targets": [0, 3]
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
        "drawCallback": function(settings) {
            console.log(settings.json);
        },
    });
    table.on('xhr.dt', function(e, settings, json, xhr) {
        token = json.<?=csrf_token()?>;
    });
});


function reload_table() {
    table.DataTable().ajax.reload(null, true);
}


$('#hideyori_datatable').on('page.dt', function() {
    $("#check-all").prop('checked', false);
});

$("#check-all").click(function() {
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


$('#hideyori_datatable').on('click', '.data-check', function() {
    if ($(this).is(':checked')) {
        $(this).closest('tr').addClass('table-primary');
    } else {
        $(this).closest('tr').removeClass('table-primary');
    }
});


function bulk_delete() {
    var list_id = [];
    $(".data-check:checked").each(function() {
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
                    url: "<?=base_url('dashboard/log/bulk_delete')?>",
                    dataType: "JSON",
                    success:

                        function(data) {
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
                    error: function(jqXHR, textStatus, errorThrown) {
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
</script>
<?=$this->endSection();?>
<!-- end js -->