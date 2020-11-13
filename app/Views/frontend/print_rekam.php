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

                    <h2 class="card-title">Hasil Rekam Medis</h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md invoice-items">
                        <thead>
                        <tr class="text-dark">
                            <th class="text-center font-weight-semibold">Tgl</th>
                            <th class="font-weight-semibold">Kode Poli</th>
                            <th class="font-weight-semibold">Subyektif</th>
                            <th class="font-weight-semibold">Obyektif</th>
                            <th class="font-weight-semibold">Assesment</th>
                            <th class="font-weight-semibold">Planning</th>
                            <th class="font-weight-semibold">T. Tangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataMaster as $data) : ?>
                            <tr>
                                <td class="text-center"><?= TanggalIndo2($data['tgl_berobat']) ?></td>
                                <td class="font-weight-semibold text-dark"><?= $data['nama_poli'] ?></td>
                                <td><?= $data['subyektif'] ?></td>
                                <td><?= $data['obyektif'] ?></td>
                                <td><?= $data['assesment'] ?></td>
                                <td><?= $data['planning'] ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

<?= $this->endSection(); ?>
<!-- end content -->
<!-- end js -->