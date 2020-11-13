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
                                class="badge badge-primary label-sm font-weight-normal va-middle mr-3"><?= $jumlah_petugas ?></span>
                            <span class="va-middle">Data Petugas Kesehatan</span>
                        </h2>
                    </header>
                    <div class="card-body">
                        <div class="content">
                            <?= $this->include('backend/loaderData'); ?>
                            <div id="getViewData">
                                <?= $this->include('backend/pimpinan/petugas/tampildata'); ?>
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
                                                   placeholder="Cari Petugas Kesehatan dan tekan enter...">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <select class="form-control" id="level_select" name="level_select">
                                                <option value="">-Seluruh Petugas Kesehatan-</option>
                                                <option value="dokter">DOKTER</option>
                                                <option value="bidan">BIDAN</option>
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
            var urlData = '<?=base_url('dashboard/petugas/getViewData?page_link=')?>';
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
                var urlData = '<?=base_url('dashboard/petugas/getSearchData?level=')?>' + level_select + '&page_link=';
                mode = 'tampil';
            } else {
                var urlData = '<?=base_url('dashboard/petugas/getSearchData?teks=')?>' + teks + '&level=' + level_select +
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


    </script>
<?= $this->endSection(); ?>