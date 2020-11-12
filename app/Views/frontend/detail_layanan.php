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


                    <div class="widget-toggle-expand mb-3">
                        <div class="widget-header">
                            <h5 class="mb-2">Detail Permintaan Layanan</h5>
                            <div class="widget-toggle">+</div>
                        </div>

                        <div class="widget-content-expanded">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">No. Urut</td>
                                    <td> <?= $dataMaster['nomor_urut']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Layanan</td>
                                    <td> <?= $dataMaster['layanan']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nama Pasien</td>
                                    <td> <?= $dataMaster['nama']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Daftar</td>
                                    <td> <?= TanggalIndo2($dataMaster['tgl_daftar']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jadwal</td>
                                    <td> <?= $dataMaster['hari'] . ', ' . $dataMaster['dari'] . '-' . $dataMaster['sampai']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Petugas Kesehatan</td>
                                    <td> <?= $dataMaster['nama_petugas']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Poli</td>
                                    <td> <?= $dataMaster['nama_poli']; ?></td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Status</td>
                                    <td>
                                        <?php
                                        if ($dataMaster['status'] == 'tunda') {
                                            $buttonstatus = '<button class="btn btn-xs btn-default btn-block">TUNDA</button>';
                                        } else if ($dataMaster['status'] == 'batal') {
                                            $buttonstatus = '<button class="btn btn-xs btn-danger btn-block">BATAL</button>';
                                        } else if ($dataMaster['status'] == 'proses') {
                                            $buttonstatus = '<button class="btn btn-xs btn-info btn-block">PROSES</button>';
                                        } else if ($dataMaster['status'] == 'selesai') {
                                            $buttonstatus = '<button class="btn btn-xs btn-success btn-block">SELESAI</button>';
                                        }
                                        echo $buttonstatus;
                                        ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

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