
   <div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-10 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Data Profil</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item active">Data Profil</li>
                        </ol>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-body">
            <?= show_alert() ?>
            <section class="inputmask" id="inputmask">
                <form action="<?= base_url($this->controller.'/simpanProfil') ?>" method="POST">
                    <?= token_csrf() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Nama User:
                                    <span class="required text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Masukan nama user" value="<?php echo (isset($dataUser))?$dataUser->nama_user:''; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Jenis Kelamin:
                                    <span class="required text-danger">*</span>
                                </h5>
                                <div class="controls">
                                    <select id="jk_user" name="jk_user" class="form-control" required>
                                        <option value="Laki-Laki" <?= (isset($dataUser) && $dataUser->jk_user=='Laki-Laki')?'selected':'' ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= (isset($dataUser) && $dataUser->jk_user=='Perempuan')?'selected':'' ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>NIP:
                                </h5>
                                <div class="controls">
                                    <input type="text" class="form-control" name="nip_user" id="nip_user" placeholder="Masukan NIP user jika ada"  value="<?php echo (isset($dataUser))?$dataUser->nip_user:''; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>No. Handphone:
                                </h5>
                                <div class="controls">
                                    <input type="text" class="form-control" onkeypress="return inputAngka(event);" name="no_hp" id="no_hp" maxlength="13" placeholder="Masukan No HP user jika ada" value="<?php echo (isset($dataUser))?$dataUser->no_hp:''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <button type="reset" class="btn btn-warning btn-block"><i class="la la-refresh"></i> Reset</button>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-block"><i class="la la-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
