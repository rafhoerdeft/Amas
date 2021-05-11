<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Data User</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="content-header-right col-md-4 col-12 mb-2">
        <div class="dropdown float-md-right">
          <button class="btn btn-success btn-block round px-2" id="dropdownBreadcrumbButton" type="button" onclick="addModal()">
            <i class="la la-plus font-small-3"></i> Tambah Data
          </button>
        </div>
      </div>

    </div>
    <div class="content-body">
      <section class="inputmask" id="inputmask">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h4 class="card-title">Data Rekenan</h4> -->
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                  </ul>
                </div>
              </div>
              
              <div class="card-content collapse show">
                
                <div class="card-body">

                  <?= show_alert() ?>

                  <style>
                    .no-wrap {
                      white-space: nowrap;
                    }
                  </style>

                  <table id="dataTable" class="table table-hover table-bordered table-striped table-responsive d-xl-table" style="font-size:small">
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama User</th>
                        <th>Jenis Kelamin</th>
                        <th>NIP</th>
                        <th>No. Handphone</th>
                        <th>Username</th>
                        <th>Role</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $no=1; foreach ($dataUser as $val) { ?>
                        <tr>
                          <td align="center"><?= $no++ ?></td>
                          <td nowrap align="center">
                            <button type="button" onclick="hapusData(this)" 
                            data-id="<?= encode($val->id_user) ?>" 
                            data-link="<?= base_url($this->controller.'/deleteDataUser') ?>" 
                            data-csrfname="<?= $this->security->get_csrf_token_name(); ?>" 
                            data-csrfcode="<?= $this->security->get_csrf_hash(); ?>" 
                            class="btn btn-sm btn-danger"  title="Hapus Data"><i class="la la-trash-o font-small-3"></i></button>

                            <button type="button" 
                            data-id="<?= encode($val->id_user) ?>" 
                            data-nama="<?= $val->nama_user ?>" 
                            data-jk="<?= $val->jk_user ?>" 
                            data-hp="<?= $val->no_hp ?>" 
                            data-nip="<?= $val->nip_user ?>" 
                            data-user="<?= $val->username ?>" 
                            data-role="<?= $val->id_role ?>" 
                            onclick="editModal(this)" class="btn btn-sm btn-info" title="Update Data"><i class="la la-edit font-small-3"></i></button> 
                          </td>
                          <td><?= $val->nama_user ?></td>
                          <td><?= $val->jk_user ?></td>
                          <td align="center"><?= $val->nip_user ?></td>
                          <td align="center"><?= $val->no_hp ?></td>
                          <td><?= $val->username ?></td>
                          <td><span class="badge bg-<?= $val->color ?> badge-pill w-100"><?= $val->nama_role ?></span></td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<div class="modal animated bounceInDown text-left" id="modal_form" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="form_input" id="form_input" method="post" action="">
        
        <input type="hidden" name="id" id="id">

        <?= token_csrf() ?>

        <div id="modal_header" class="modal-header bg-success">
          <h4 class="modal-title white" id="modal_title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <h5>Nama User
                    <span class="required text-danger">*</span>
                </h5>
                <div class="controls">
                    <input type="text" id="nama_user" name="nama_user" class="form-control" placeholder="Isi nama user" required>
                </div>
            </div>

            <div class="form-group">
                <h5>Jenis Kelamin
                    <span class="required text-danger">*</span>
                </h5>
                <div class="controls">
                    <select name="jk_user" id="jk_user" class="form-control select2" required>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <h5>No. Handphone
                    <span class="required text-danger">*</span>
                </h5>
                <div class="controls">
                    <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="Isi nomor handphone user" onkeypress="return inputAngka(event);" maxlength="15" required>
                </div>
            </div>

            <div class="form-group">
                <h5>NIP
                    <!-- <span class="required text-danger">*</span> -->
                </h5>
                <div class="controls">
                    <input type="text" id="nip_user" name="nip_user" class="form-control" placeholder="Isi NIP user jika ada">
                </div>
            </div>

            <div class="form-group">
                <h5>Role
                    <span class="required text-danger">*</span>
                </h5>
                <div class="controls">
                    <select id="id_role" name="id_role" class="form-control select2" required>
                        <!-- <option value="">Pilih Rekanan</option> -->
                        <?php
                        foreach ($dataRole as $val) {
                        ?>
                            <option value="<?= $val->id_role ?>"><?= $val->nama_role ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <h5>Username
                    <span class="required text-danger">*</span>
                </h5>
                <div class="controls">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Isi username login" required>
                </div>
            </div>

            <div class="form-group">
                <h5>Password
                    <span class="required text-danger" id="span_pass">*</span>
                </h5>
                <div class="controls">
                    <input type="text" id="password" name="password" class="form-control" placeholder="Isi password login" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-danger"><i class="la la-close"></i> Keluar</button>
          <button type="button" class="btn btn-info" ><i class="la la-save"></i> Simpan</button> -->

          <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">SIMPAN</button>
          <button type="reset" id="btn_reset" class="btn btn-warning waves-effect">RESET</button>
          <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function clear_data() {
      $('#modal_form #id').val('');
      $('#modal_form #nama_user').val('');
      $('#modal_form #jk_user').val('Laki-Laki').change();
      $('#modal_form #id_role').val('1').change();
      $('#modal_form #no_hp').val('');
      $('#modal_form #nip_user').val('');
      $('#modal_form #username').val('');
      $('#modal_form #password').val('');
  }

  function addModal() {
      clear_data();
      $('#modal_form #modal_title').html('Tambah Data User');
      $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/simpanDataUser'; ?>");
      $('#modal_form #modal_header').removeClass("bg-info").addClass("bg-success");

      $('#modal_form #span_pass').show();
      $('#modal_form #password').attr('placeholder', 'Isi password login');
      $('#modal_form #password').attr('required', true);

      $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
  }

  function editModal(data) {
      var id   = $(data).data().id;
      var nama = $(data).data().nama;
      var jk = $(data).data().jk;
      var hp = $(data).data().hp;
      var nip = $(data).data().nip;
      var role = $(data).data().role;
      var user = $(data).data().user;

      clear_data();
      $('#modal_form #modal_title').html('Update Data User');
      $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/updateDataUser'; ?>");
      $('#modal_form #modal_header').removeClass("bg-success").addClass("bg-info");

      $('#modal_form #id').val(id);
      $('#modal_form #nama_user').val(nama);
      $('#modal_form #jk_user').val(jk).change();
      $('#modal_form #id_role').val(role).change();
      $('#modal_form #no_hp').val(hp);
      $('#modal_form #nip_user').val(nip);
      $('#modal_form #username').val(user);
      
      $('#modal_form #span_pass').hide();
      $('#modal_form #password').attr('placeholder', 'Isi password jika ingin ganti baru');
      $('#modal_form #password').attr('required', false);

      $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
  }
</script>