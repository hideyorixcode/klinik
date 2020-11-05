<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?><!-- end css -->

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

    <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>
        </div>
    <?php } ?>

    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>
        </div>
    <?php } ?>
    <form id="form" name="form" method="post" class="p-3" enctype="multipart/form-data"
          action="<?= base_url('dashboard/konfigurasi/updateAll') ?>">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-lg-6 col-xl-6">

                <section class="card">
                    <div class="card-body">
                        <?php
                        $data_textfield = $mkonfigurasi->whereIn('tipe', ['textfield', 'email', 'number'])->find();
                        $countTextfield = -1;
                        foreach ($data_textfield as $x) :
                            ?>
                            <div class="form-group">
                                <label><?= $x->label ?></label>
                                <input type="hidden" id="id" name="id[]" value="<?= $x->id ?>">
                                <input type="hidden" id="tipe" name="tipe[]" value="<?= $x->tipe ?>">
                                <?php if ($x->tipe == 'email') {
                                    $editor = 'email';
                                } else if ($x->tipe == 'number') {
                                    $editor = 'number';
                                } else {
                                    $editor = 'text';
                                }
                                ?>
                                <input type="<?= $editor ?>" id="content" name="content[]"
                                       class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>"
                                       required
                                       value="<?= $x->content ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('content'); ?>
                                </div>
                            </div>
                            <?php
                            $countTextfield++;
                        endforeach;
                        ?>
                    </div>
                </section>
            </div>

            <div class="col-lg-6 col-xl-6">

                <section class="card">
                    <div class="card-body">
                        <?php
                        $data_textArea = $mkonfigurasi->where('tipe', 'textarea')->find();
                        $countTextarea = $countTextfield;
                        foreach ($data_textArea as $i) :
                            ?>
                            <div class="form-group">
                                <label><?= $i->label ?></label>
                                <input type="hidden" id="id" name="id[]" value="<?= $i->id ?>">
                                <input type="hidden" id="tipe" name="tipe[]" value="<?= $x->tipe ?>">
                                <textarea id="content" name="content[]" rows="3"
                                          class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>"
                                          required><?= $i->content ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('content'); ?>
                                </div>
                            </div>
                            <?php
                            $countTextarea++;
                        endforeach;
                        ?>
                        <hr class="dotted tall">


                        <?php
                        $data_gambar = $mkonfigurasi->whereIn('tipe', ['gambar', 'favicon'])->find();
                        $countGambar = 0;
                        foreach ($data_gambar as $z) :
                            ?>
                            <div class="form-group">
                                <label><?= $z->label ?></label>
                                <input type="hidden" id="idberkas" name="idberkas[]" value="<?= $z->id ?>">
                                <input type="hidden" id="tipeberkas" name="tipeberkas[]" value="<?= $z->tipe ?>">
                                <input type="hidden" id="contentberkas" name="contentberkas[]" value="<?= $z->content ?>">
                                <?php if ($z->tipe == 'gambar') {
                                    $filepilihan = 'image/*';
                                } else if ($z->tipe == 'favicon') {
                                    $filepilihan = '.ico';
                                } else {
                                    $filepilihan = '.pdf';
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?= $z->content ? base_url('public/uploads/' . $z->content) : base_url('public/uploads/nologo.png') ?>"
                                             class="img-thumbnail img-preview_<?=$countGambar?>">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="berkas_<?=$countGambar?>" name="berkas_<?=$countGambar?>" onchange="previewImg(<?=$countGambar?>)"
                                                   accept="<?=$filepilihan?>">
                                            <label class="custom-file-label" id="custom-file-label_<?=$countGambar?>" for="validatedCustomFile">Pilih
                                                <?=$z->label?>...</label>
                                            <p style="color: red"><?= $validation->getError("berkas_<?=$countGambar?>"); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $countGambar++;
                        endforeach;
                        ?>

                        <div class="form-row">
                            <div class="col-md-12 text-right mt-3">
                                <button class="btn btn-primary modal-confirm" type="submit"><i class="fa fa-save"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </form>

    <!-- end: page -->
</section>

<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>


<script>
    $(document).ready(function () {


    });

    function previewImg(id) {
        const logo = document.querySelector('#berkas_'+id);
        const logoLabel = document.querySelector('#custom-file-label_'+id);
        const logoPreview = document.querySelector('.img-preview_'+id);

        logoLabel.textContent = logo.files[0].name;

        const fileLogo = new FileReader();
        fileLogo.readAsDataURL(logo.files[0]);

        fileLogo.onload = function (e) {
            logoPreview.src = e.target.result;
        }
    }

    $("input").change(function () {
        $(this).closest('.form-group').find('input.form-control').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });
    $("select").change(function () {
        $(this).closest('.form-group').find('div.input-group').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });

    function check_int(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return (charCode >= 46 && charCode <= 57 || charCode == 8 || charCode == 32 || charCode == 40 || charCode == 41 || charCode == 43);
    }


</script>
<?= $this->endSection(); ?><!-- end js -->
