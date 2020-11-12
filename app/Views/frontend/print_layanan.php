<?= $this->extend('print'); ?>


<?= $this->section('printcontent'); ?>

<section role="main" class="content-body">

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-2 col-xl-2 mb-4 mb-xl-0"></div>
        <div class="col-lg-8 col-xl-8 mb-4 mb-xl-0">

            <section class="card mb-5">
                <div class="card-body">


                    <div class="widget-toggle-expand mb-3">
                        <div class="widget-header">
                            <h5 class="mb-2 text-center">Permintaan Layanan Klinik</h5>

                        </div>


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
            </section>

        </div>
        <div class="col-lg-2 col-xl-2 mb-4 mb-xl-0"></div>
    </div>
    <!-- end: page -->
</section>

<?= $this->endSection(); ?>
<!-- end content -->
<!-- end js -->