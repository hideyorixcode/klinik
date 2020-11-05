<?php
?>
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-dark" id="gantijudul">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form novalidate id="form" name="form" method="post" enctype="multipart/form-data"
                    action="javascript:save();">
                    <div class="row">

                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" name="id" id="id">
                            <div class="form-group">
                                <label class="text-dark">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                                <div class="invalid-feedback" id="error_nama"></div>
                            </div>
                            <div class="form-group">
                                <label class="text-dark">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                                <div class="invalid-feedback" id="error_username"></div>
                            </div>

                            <div class="form-group">
                                <label id="lblpassword" class="text-dark">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                                <div class="invalid-feedback" id="error_password"></div>
                            </div>

                            <div class="form-group">
                                <label id="lblkonfirmasi" class="text-dark">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    id="confirm_password">
                                <div class="invalid-feedback" id="error_confirm_password"></div>
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="invalid-feedback" id="error_email"></div>
                            </div>

                            <div class="form-group">
                                <label class="text-dark">No Telepon</label>
                                <input type="number" class="form-control" id="notelepon" name="notelepon">
                                <div class="invalid-feedback" id="error_notelepon"></div>
                            </div>


                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-dark">Level Akses</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="admin">ADMIN</option>
                                    <option value="pimpinan">PIMPINAN</option>
                                </select>
                                <div class="invalid-feedback" id="error_level"></div>
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Aktif Akun</label>
                                <select class="form-control" id="active" name="active">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <div class="invalid-feedback" id="error_active"></div>
                            </div>


                            <div class="form-group">
                                <label class="text-dark">Foto</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?=base_url('public/uploads/user.png')?>"
                                            class="img-thumbnail img-preview" style="height: 100px">
                                    </div>
                                    <div class="col-sm-8 mb-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                                onchange="previewImg()" accept="image/*">
                                            <label class="custom-file-label" for="validatedCustomFile">Ganti
                                                Foto...</label>
                                            <p style="color: red" id="error_avatar"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                    <input type="checkbox" class="form-control" name="remove_avatar" id="remove_avatar">
                                        <label id="label_hapus">HAPUS FOTO</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-lg waves-effect waves-light" id="btnsave"><i
                                class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->