<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Data Rekanan</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Rekanan</li>
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
                        <th>Nama Rekanan</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $no=1; foreach ($dataRekanan as $val) { ?>
                        <tr>
                          <td align="center"><?= $no++ ?></td>
                          <td nowrap align="center">
                            <button type="button" onclick="hapusData(this)" data-id="<?= encode($val->id_rekanan) ?>" data-link="<?= base_url('User1/deleteDataRekanan') ?>" data-csrfname="<?= $this->security->get_csrf_token_name(); ?>" data-csrfcode="<?= $this->security->get_csrf_hash(); ?>" class="btn btn-sm btn-danger"  title="Hapus Data"><i class="la la-trash-o font-small-3"></i></button>

                            <button type="button" data-id="<?= encode($val->id_rekanan) ?>" data-nama="<?= $val->nama_rekanan ?>" data-almt="<?= $val->alamat_rekanan ?>" data-kota="<?= $val->kota_rekanan ?>" onclick="editModal(this)" class="btn btn-sm btn-info" title="Update Data"><i class="la la-edit font-small-3"></i></button> 
                          </td>
                          <td><?= $val->nama_rekanan ?></td>
                          <td><?= $val->alamat_rekanan ?></td>
                          <td align="center"><?= $val->kota_rekanan ?></td>
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

<div class="modal animated bounceInDown text-left" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
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
            <h5>Nama Rekanan
                <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
                <input type="text" id="nama_rekanan" name="nama_rekanan" class="form-control" placeholder="Isi nama rekanan" required>
            </div>
          </div>

          <div class="form-group">
            <h5>Alamat Rekanan
                <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
            <textarea id="alamat_rekanan" name="alamat_rekanan" class="form-control" required="" placeholder="Isi alamat tempat usaha rekanan" rows="2"></textarea>
            </div>
          </div>

          <div class="form-group">
            <h5>Kota
                <span class="required text-danger">*</span>
            </h5>
            <div class="controls">
                <input type="text" id="kota_rekanan" name="kota_rekanan" class="form-control" placeholder="Isi kota tempat usaha rekanan" required>
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
      $('#modal_form #nama_rekanan').val('');
      $('#modal_form #alamat_rekanan').val('');
      $('#modal_form #kota_rekanan').val('');
  }

  function addModal() {
      clear_data();
      $('#modal_form #modal_title').html('Tambah Data Rekanan');
      $('#modal_form #form_input').attr('action', "<?= base_url().'User1/simpanDataRekanan'; ?>");
      $('#modal_form #modal_header').removeClass("bg-info").addClass("bg-success");
      $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
  }

  function editModal(data) {
      var id   = $(data).data().id;
      var nama = $(data).data().nama;
      var almt = $(data).data().almt;
      var kota = $(data).data().kota;

      clear_data();
      $('#modal_form #modal_title').html('Update Data Rekanan');
      $('#modal_form #form_input').attr('action', "<?= base_url().'User1/updateDataRekanan'; ?>");
      $('#modal_form #modal_header').removeClass("bg-success").addClass("bg-info");

      $('#modal_form #id').val(id);
      $('#modal_form #nama_rekanan').val(nama);
      $('#modal_form #alamat_rekanan').val(almt);
      $('#modal_form #kota_rekanan').val(kota);
      // // $('#modal_form #'+kategori).attr('selected','');
      // // $('#modal_form #kategori').selectpicker('refresh');
      // $('#modal_form #nomor').val(nomor);
      $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
  }
</script>