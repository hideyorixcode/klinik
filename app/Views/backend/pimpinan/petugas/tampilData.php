<?php
if ($data_petugas) {
    $no = 1;
    ?>
    <ul class="simple-user-list">
        <?php
        foreach ($data_petugas as $key => $value): ?>

            <li>
                <div class="row">
                    <div class="col-lg-8">
                        <figure class="image rounded">
                            <img src="<?= $value['avatar'] ? base_url('public/uploads/' . $value['avatar']) : base_url('public/uploads/user.png') ?>"
                                 style="width:35px;height:35px" alt="<?= $value['nama'] ?>"
                                 class="rounded-circle">
                        </figure>
                        <span class="title"><?= $value['nama'] ?>   </span>
                        <span
                                class="message truncate"><?= $value['active'] == 1 ? '<span class="fas fa-circle fa-xs" style="color: green"></span>' : '<span class="fas fa-circle fa-xs" style="color: red"></span>' ?> <?= 'username : ' . $value['username'] . ' | level : ' . $value['level'] ?></span>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="<?= base_url('dashboard/petugas/detail/' . encodeHash($value['id'])) ?>"
                           class="btn btn-dark btn-sm waves-effect waves-light"><i class="fas fa-eye"></i> Detail</a>

                    </div>
                </div>
                <hr/>
            </li>


            <?php $no++;
        endforeach;
        ?>
    </ul>
    <?php

} else {
    ?>


    <div class=" col-12">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
            </button>
            <div class="d-flex align-items-center">
                <div class="alert-icon width-2">
                    <span class="fa fa-info-circle color-primary-400" style="font-size: 22px;"></span>
                </div>
                <div class="flex-1">
                    <?= $pesan_kosong; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>

<div class="col-12">
    <div class="col-xl-12 d-flex justify-content-center m-2">

        <?= $pager->links('link', 'custom_pagination') ?>

    </div>
</div>
