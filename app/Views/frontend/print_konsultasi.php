<?= $this->extend('print'); ?>


<?= $this->section('printcontent'); ?>

<section role="main" class="content-body">

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-4 col-xl-4 col-4">
            <section class="card card-dark">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Data Pasien</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td class="font-weight-bold">Nama Pasien</td>
                            <td> <?= $dataPasien['nama']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Nama KK</td>
                            <td> <?= $dataPasien['nama_kk']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Kelamin</td>
                            <td> <?= $dataPasien['jk']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Pekerjaan</td>
                            <td> <?= $dataPasien['pekerjaan']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Alamat</td>
                            <td> <?= $dataPasien['alamat']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Agama</td>
                            <td> <?= $dataPasien['agama']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">No. Telp</td>
                            <td> <?= $dataPasien['notelepon']; ?></td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="col-lg-8 col-xl-8 col-8">
            <section class="card card-dark">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>

                    <h2 class="card-title">Hasil Konsultasi</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td class="font-weight-bold">Nomor Konsultasi</td>
                            <td> <?= $dataMaster['nomor_konsultasi']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Tanggal Konsultasi</td>
                            <td> <?= TanggalIndo($dataMaster['tgl_konsultasi']); ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Diagnosis</td>
                            <td> <?= $dataMaster['diagnosis']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Saran</td>
                            <td> <?= $dataMaster['saran']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="col-lg-12 col-xl-12 col-12">
            <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tbody>
                <tr>
                    <td width="40%">&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                    <td width="40%" align="center">&nbsp;Bandar
                        Lampung, <?= TanggalIndo($dataMaster['tgl_konsultasi']); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;<?= ucwords($dataPasien['level']) . ' ' . $area; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"><?= $dataPasien['nama_petugas']; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end: page -->
</section>

<?= $this->endSection(); ?>
<!-- end content -->
<!-- end js -->