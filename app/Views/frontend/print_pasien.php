<?= $this->extend('print'); ?>


<?= $this->section('printcontent'); ?>

<section role="main" class="content-body">

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-2 col-xl-2 mb-4 mb-xl-0"></div>
        <div class="col-lg-8 col-xl-8 mb-4 mb-xl-0">

            <div class="row">
                <div class="col-lg-12 col-xl-12 mb-4 mb-xl-0">
                    <section class="card mb-5">
                        <div class="card-body">


                            <div class="widget-toggle-expand mb-3">
                                <div class="widget-header">
                                    <h5 class="mb-2 text-center">CETAK DATA PASIEN</h5>

                                </div>


                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Nama Lengkap</td>
                                        <td><i class="fa fa-address-card"></i> <?= $dataMaster['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nama KK</td>
                                        <td><i class="fa fa-user-check"></i> <?= ($dataMaster['nama_kk']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tanggal Lahir</td>
                                        <td>
                                            <i class="fa fa-calendar"></i> <?= TanggalIndo2($dataMaster['tgl_lahir']); ?>
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
                                        <td class="font-weight-bold">Gol Darah</td>
                                        <td> <?= $dataMaster['gol_darah']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">Tinggi Badan (Cm)</td>
                                        <td> <?= $dataMaster['tinggi_badan']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">Berat Badan (Kg)</td>
                                        <td> <?= $dataMaster['berat_badan']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">BPJS</td>
                                        <td><?= $dataMaster['bpjs'] == 'YA' ? '<span class="fas fa-circle fa-xs" style="color: green"> YA</span>' : '<span class="fas fa-circle fa-xs" style="color: red"> TIDAK</span>' ?></td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">Jenis Kelamin</td>
                                        <td><i class="fa fa-user-check"></i> <?= ucwords($dataMaster['jk']); ?></td>
                                    </tr>


                                    <tr>
                                        <td class="font-weight-bold">Pekerjaan</td>
                                        <td><i class="fa fa-user-check"></i> <?= ($dataMaster['pekerjaan']); ?></td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">Agama</td>
                                        <td><i class="fa fa-user-check"></i> <?= ($dataMaster['agama']); ?></td>
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
                <div class="col-lg-12 col-xl-12 mb-4 mb-xl-0">
                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
                        <tbody>
                        <tr>
                            <td width="40%">&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="40%" align="center">&nbsp;Bandar
                                Lampung, <?= TanggalIndo(date('Y-m-d')); ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="center">&nbsp;Pimpinan</td>
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
                            <td align="center"><strong><?= $namaPimpinan ?></strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <div class="col-lg-2 col-xl-2 mb-4 mb-xl-0"></div>
    </div>
    <!-- end: page -->
</section>

<?= $this->endSection(); ?>
<!-- end content -->
<!-- end js -->