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
                                <a href="<?= base_url('dashboard/layanan') ?>" class="btn btn-outline-dark btn-xs"><i
                                            class="fas fa-backward"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

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
                                <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
                                      action="<?= base_url('dashboard/layanan/update') ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_daftar" id="id_daftar" value="<?= $id; ?>">
                                    <tr>
                                        <td class="font-weight-bold">Status</td>
                                        <td>
                                            <select name="status" id="status"
                                                    class="form-control  <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>">
                                                <?php
                                                $x = 0;
                                                $selected_layanan = old('status') ? old('status') : $dataMaster['status'];
                                                while ($x < count(enumValues('daftar', 'status'))) {
                                                    $stringlay = enumValues('daftar', 'status')[$x];
                                                    ?>
                                                    <option <?= $selected_layanan == $stringlay ? 'selected' : ''; ?>
                                                            value="<?= $stringlay ?>">
                                                        <?= strtoupper($stringlay) ?></option>
                                                    <?php
                                                    $x++;
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('status'); ?>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 text-right mt-3">
                                                    <button class="btn btn-primary modal-confirm" type="submit"><i
                                                                class="fa fa-save"></i>
                                                        Simpan Perubahan
                                                    </button>
                                                </div>
                                            </div>
                                        </td>


                                    </tr>
                                </form>

                                </tbody>
                            </table>
                        </div>
                    </div>

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