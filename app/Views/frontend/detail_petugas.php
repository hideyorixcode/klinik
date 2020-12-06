<?= $this->extend('frontend/template'); ?>

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
        <div class="col-lg-2 col-xl-2 mb-4 mb-xl-0"></div>
        <div class="col-lg-8 col-xl-8 mb-4 mb-xl-0">

            <section class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <div class="mb-3">
                                <a href="<?= base_url('jadwal') ?>" class="btn btn-outline-dark btn-xs"><i
                                            class="fas fa-backward"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="thumb-info text-center mb-3">
                        <?php $fotonya = $dataMaster['avatar'] ? $dataMaster['avatar'] : 'user.png'; ?>
                        <img src="<?= base_url('public/uploads/' . $fotonya) ?>"
                             class="rounded img-fluid img-preview"
                             alt="<?= $dataMaster['username'] ?>">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner"><?= $dataMaster['username'] ?></span>
                            <span class="thumb-info-type"><?= strtoupper($dataMaster['level']) ?></span>
                        </div>
                    </div>

                    <div class="widget-toggle-expand mb-3">
                        <div class="widget-header">
                            <h5 class="mb-2">Profil</h5>
                            <div class="widget-toggle">+</div>
                        </div>

                        <div class="widget-content-expanded">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">Nama Lengkap</td>
                                    <td><i class="fa fa-address-card"></i> <?= $dataMaster['nama']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Lahir</td>
                                    <td><i class="fa fa-calendar"></i> <?= TanggalIndo2($dataMaster['tgl_lahir']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Alamat</td>
                                    <td><i class="fa fa-map-marker"></i> <?= $dataMaster['alamat']; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">No. Telp</td>
                                    <td><i class="fa fa-phone"></i> <?= $dataMaster['notelepon']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jenis Kelamin</td>
                                    <td><i class="fa fa-user-check"></i> <?= ucwords($dataMaster['jk']); ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold"><?= strtoupper($dataMaster['level']); ?></td>
                                    <td><i class="fa fa-clinic-medical"></i> <?= $dataMaster['nama_poli']; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Status</td>
                                    <td><?= $dataMaster['active'] == 1 ? '<span class="fas fa-circle fa-xs" style="color: green"> AKTIF</span>' : '<span class="fas fa-circle fa-xs" style="color: red"> TIDAK AKTIF</span>' ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($dataMaster['deskripsi']) { ?>

                        <h5 class="mb-2 mt-3">Deskripsi</h5>
                        <?= $dataMaster['deskripsi']; ?>
                    <?php } ?>

                </div>
            </section>

        </div>
        <div class="col-lg-2 col-xl-2 mb-4 mb-xl-0"></div>
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