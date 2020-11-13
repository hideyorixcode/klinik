<?= $this->extend('print'); ?>


<?= $this->section('printcontent'); ?>
<p style="text-align: center; font-weight: bold; font-size: xx-large"><u>SURAT KETERANGAN SAKIT</u></p>
<section role="main" class="content-body">
    <?php
    $tgl1 = new DateTime($dataMaster['mulai']);
    $tgl2 = new DateTime($dataMaster['sampai']);
    $d = $tgl2->diff($tgl1)->days + 1;
    ?>
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-12">
            <p>Yang bertanda tangan dibawah ini <?= ucwords($dataPasien['level']) . ' ' . $area; ?> dengan ini
                menerangkan bahwa :</p>
            <p>Sdr/i. <?= $dataPasien['nama']; ?> pekerjaan <?= $dataPasien['pekerjaan']; ?>, karena "SAKIT", yang
                bersangkutan harus mendapat cuti selama, <?= $d ?> hari, terhitung mulai
                tanggal <?= TanggalIndo2($dataMaster['mulai']) . ' s.d. ' . TanggalIndo2($dataMaster['sampai']); ?></p>
        </div>
        <div class="col-lg-12 col-xl-12 col-12">
            <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tbody>
                <tr>
                    <td width="40%">&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                    <td width="40%" align="center">&nbsp;Bandar
                        Lampung, <?= TanggalIndo($dataMaster['tgl_surat']); ?></td>
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