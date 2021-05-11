
   <div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-10 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Akun Login</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item active">Akun Login</li>
                        </ol>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-body">
            <?= show_alert() ?>
            <section class="inputmask" id="inputmask">
                <form action="<?= base_url($this->controller.'/simpanAkunLogin') ?>" method="POST" novalidate>
                    <?= token_csrf() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Username:
                                    <span class="required text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukan username login" value="<?php echo (isset($dataUser))?$dataUser->username:''; ?>" required data-validation-required-message="Data harus diisi">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Password Lama:
                                    <span class="required text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <input type="password" class="form-control" name="pass_old" id="pass_old" placeholder="Masukan password lama" required data-validation-required-message="Data harus diisi">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Password Baru:
                                    <span class="required text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <input type="password" class="form-control" name="pass_new" id="pass_new" placeholder="Masukan password baru" required data-validation-required-message="Data harus diisi">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Ulangi Password:
                                    <span class="required text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <input type="password" class="form-control" name="pass_re" id="pass_re" placeholder="Ulangi password baru" data-validation-match-match="pass_new" required data-validation-required-message="Data harus diisi">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <button type="reset" class="btn btn-warning btn-block"><i class="la la-refresh"></i> Reset</button>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" id="simpan_akun" class="btn btn-success btn-block text-white"><i class="la la-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
