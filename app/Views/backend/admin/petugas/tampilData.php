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
                                 class="rounded-circle"><input type="checkbox" class="data-check"
                                                               value="<?= encodeHash($value['id']) ?>">
                        </figure>
                        <span class="title"><?= $value['nama'] ?>   </span>
                        <span
                                class="message truncate"><?= $value['active'] == 1 ? '<span class="fas fa-circle fa-xs" style="color: green"></span>' : '<span class="fas fa-circle fa-xs" style="color: red"></span>' ?> <?= 'username : ' . $value['username'] . ' | level : ' . $value['level'] ?></span>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="<?= base_url('dashboard/petugas/detail/' . encodeHash($value['id'])) ?>"
                           class="btn btn-dark btn-sm waves-effect waves-light"><i class="fas fa-eye"></i> Detail</a>
                        <a href="<?= base_url('dashboard/petugas/edit/' . encodeHash($value['id'])) ?>"
                           class="btn btn-success btn-sm waves-effect waves-light"><i class="fas fa-edit"></i> Ubah</a>
                        <a href="javascript:void(0);" onclick="delete_id('<?= encodeHash($value['id']) ?>')"
                           class="btn btn-danger btn-sm waves-effect"><i class="fas fa-trash"></i> Hapus</a>

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
    <div class="btn-group flex-wrap pull-left">
        <button class="btn btn-danger btn-xs waves-effect waves-light" type="button" onclick="bulk_delete();">
            <i class="fas fa-trash-alt"></i> Hapus Pilihan (<i class="fas fa-check"></i>)
        </button>
        <button class="btn btn-outline-success btn-xs waves-effect waves-light" type="button"
                onclick="bulk_status(1, 'AKTIF');">
            <i class="fas fa-check-square"></i> Aktif Pilihan (<i class="fas fa-check"></i>)
        </button>
        <button class="btn btn-outline-danger btn-xs waves-effect waves-light" type="button"
                onclick="bulk_status(0, 'NON AKTIF');">
            <i class="fas fa-ban"></i> Nonaktif Pilihan (<i class="fas fa-check"></i>)
        </button>
    </div>
    <div class="col-xl-12 d-flex justify-content-center m-2">

        <?= $pager->links('link', 'custom_pagination') ?>

    </div>
</div>
