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

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 mb-4 mb-xl-0">

            <section class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <div class="mb-3">
                                <a href="<?= base_url('dashboard/jadwal') ?>" class="btn btn-outline-dark btn-xs"><i
                                            class="fas fa-backward"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td class="font-weight-bold">Nama Petugas</td>
                            <td> <?= $dataMaster['nama_petugas']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Level</td>
                            <td> <?= $dataMaster['level']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Poli</td>
                            <td> <?= $dataMaster['nama_poli']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Hari</td>
                            <td> <?= $dataMaster['hari']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Waktu</td>
                            <td> <?= ($dataMaster['dari'] . '-' . $dataMaster['sampai']); ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-weight-bold">Status</td>
                            <td><?= $dataMaster['active'] == 1 ? '<span class="fas fa-circle fa-xs" style="color: green"> AKTIF</span>' : '<span class="fas fa-circle fa-xs" style="color: red"> TIDAK AKTIF</span>' ?></td>
                        </tr>

                        </tbody>
                    </table>

                </div>


        </div>
</section>

</div>
</div>
<!-- end: page -->
</section>

<?= $this->endSection(); ?>
<!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?>
<!-- end modal -->

<?= $this->section('js'); ?>

<script>

</script>
<?= $this->endSection(); ?>
<!-- end js -->