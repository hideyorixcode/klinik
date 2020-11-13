<?= $this->extend('print'); ?>


<?= $this->section('printcontent'); ?>
<p style="text-align: center; font-weight: bold; font-size: xx-large"><u>SURAT KETERANGAN DOKTER</u></p>
<section role="main" class="content-body">
    <?php

    $birthDate = new DateTime($dataPasien['tgl_lahir']);
    $today = new DateTime("today");
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    //return $y." tahun ".$m." bulan ".$d." hari";

    ?>
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-12">
            <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tbody>
                <tr>
                    <td colspan="5">Yang bertanda tangan di bawah
                        ini <?= ucwords($dataPasien['level']) . ' ' . $area; ?> dengan ini menerangkan bahwa
                        :
                    </td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="15%">&nbsp;Nama</td>
                    <td width="5%">&nbsp;:</td>
                    <td width="60%">&nbsp;<?= $dataPasien['nama']; ?></td>
                    <td width="10%">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;Umur</td>
                    <td>&nbsp;:</td>
                    <td>&nbsp;<?= $y . " tahun " . $m . " bulan " . $d . " hari"; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;Jenis Kelamin</td>
                    <td>&nbsp;:</td>
                    <td>&nbsp;<?= $dataPasien['jk']; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;Pekerjaan</td>
                    <td>&nbsp;:</td>
                    <td>&nbsp;<?= $dataPasien['pekerjaan']; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;Alamat</td>
                    <td>&nbsp;:</td>
                    <td>&nbsp;<?= $dataPasien['alamat']; ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">Pada saat pemeriksaan dinyatakan</td>
                    <td colspan="2">: <strong><?= $dataMaster['pemeriksaan']; ?></strong></td>
                </tr>
                <tr>
                    <td colspan="3">Surat Keterangan ini dipergunakan untuk</td>
                    <td colspan="2">: <?= $dataMaster['untuk']; ?></td>
                </tr>
                <tr>
                    <td colspan="5">Demikianlah Surat Keterangan ini dibuat untuk dapat dipergunakan sebagaimana
                        mestinya.
                    </td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Bandar
                        Lampung, <?= TanggalIndo($dataMaster['tgl_surat']); ?></td>
                </tr>
                <tr>
                    <td>TD</td>
                    <td>: <?= $dataMaster['td'] . ' mmgh'; ?></td>
                    <td>&nbsp;</td>
                    <td colspan="2" align="right"><?= ucwords($dataPasien['level']) . ' ' . $area; ?></td>
                </tr>
                <tr>
                    <td>DN</td>
                    <td>: <?= $dataMaster['dn'] . ' /mnt'; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>TB</td>
                    <td>: <?= $dataMaster['tb'] . ' Cm'; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>BB</td>
                    <td>: <?= $dataMaster['bb'] . ' Kg'; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2" align="right"><?= $dataPasien['nama_petugas']; ?></td>
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