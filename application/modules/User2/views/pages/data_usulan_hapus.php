<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-10 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Usulan Hapus Aset</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item active">Usulan Hapus Aset</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- <div class="content-header-right col-md-4 col-12 mb-2">
                <div class="dropdown float-md-right">
                    <button class="btn btn-success btn-block round px-2" id="dropdownBreadcrumbButton" type="button"
                        onclick="addModal()">
                        <i class="la la-plus font-small-3"></i> Tambah Data
                    </button>
                </div>
            </div> -->

            <div class="content-header-right col-md-2 col-12 mb-2">
                <!-- <div class="dropdown"> -->
                    <input type="hidden" name="delete_all" id="delete_all">
                    <button id="btn_eksekusi" class="btn btn-info btn-block round px-2 float-md-right" id="dropdownBreadcrumbButton" type="button"
                        onclick="showModalEksekusi()" disabled>
                        <i class="la la-check font-small-3"></i> Eksekusi Aset
                    </button>
                <!-- </div> -->
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

                                    <form action="<?= base_url($this->controller.'/dataUsulanHapus') ?>" class="row" method="POST">
                                        <?= token_csrf() ?>

                                        <div class="col-lg-3" style="margin-bottom: 5px;">
                                            <div class="controls">
                                                <select id="jenis" name="jenis" class="form-control select2">
                                                    <option value="" selected>Semua Jenis</option>
                                                    <?php
                                                    foreach ($dataJenisAset as $jns) {
                                                    ?>
                                                        <option <?= ($selectJenis == $jns->id_jenis_kib?'selected':'') ?> value="<?= $jns->id_jenis_kib ?>"><?= $jns->nama_kib ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                        <button type="submit" class="btn btn-success btn-block" title="Tampilkan">
                                            Tampil
                                        </button>
                                        </div>

                                    </form>

                                    <hr>

                                    <style>
                                    .no-wrap {
                                        white-space: nowrap;
                                    }
                                    </style>

                                    <table id="dataTable" class="table table-hover table-bordered table-striped table-responsive d-xl-table"
                                        style="font-size: small">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>
                                                    <div class="skin skin-check">
                                                        <input type="checkbox" name="plh_ast_all" id="check_all" value="0">
                                                    </div>
                                                </th>
                                                <th>Tgl Mutasi</th>
                                                <th>Jenis Aset</th>
                                                <th>Nama Aset</th>
                                                <th>Kode Lama</th>
                                                <th>Kode Baru</th>
                                                <th>No. Reg</th>
                                                <th>Satuan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no=1; foreach ($dataHapus as $val) { ?>
                                                <tr>
                                                    <td align="center"><?= $no++ ?></td>
                                                    <td nowrap align="center">
                                                        <div class="skin skin-check">
                                                            <input type="checkbox" name="plh_ast[]" value="<?= $val->id_aset ?>">
                                                        </div>
                                                    </td>
                                                    <td align="center"><?= date('d/m/Y', strtotime($val->tgl_histori)) ?></td>
                                                    <td><?= $val->nama_kib ?></td>
                                                    <td><?= $val->nama_aset ?></td>
                                                    <td><?= $val->kode_lama_aset ?></td>
                                                    <td><?= $val->kode_baru_aset ?></td>
                                                    <td><?= $val->no_reg ?></td>
                                                    <td align="center"><?= $val->satuan_aset ?></td>
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
        <!-- <input type="hidden" name="kib" id="kib" value="<?php //echo encode($id_jenis_kib); ?>"> -->
        <input type="hidden" name="back" id="back" value="<?= base_url($this->controller.'/dataUsulanHapus'.($selectJenis!=''?'/'.encode($selectJenis):'')) ?>">

        <?= token_csrf() ?>

        <div id="modal_header" class="modal-header bg-info">
          <h4 class="modal-title white" id="modal_title">Eksekusi Aset</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <h5>Jenis Eksekusi
                  <span class="required text-danger">*</span>
              </h5>
              <div class="controls">
                  <select id="id_aset_status" name="id_aset_status" class="form-control select2" onchange="changeExec(this)" required>
                    <option value="">Pilih Jenis Eksekusi</option>
                      <?php
                      foreach ($statusAset as $val) {
                      ?>
                          <option value="<?= $val->id_aset_status ?>"><?= $val->nama_status ?></option>
                      <?php
                      }
                      ?>
                  </select>
              </div>
          </div>

          <div class="form-group">
              <h5>Tanggal
                  <span class="required text-danger">*</span>
              </h5>
              <div class="controls">
                  <input type="text" class="form-control date-picker" id="tgl_histori" name="tgl_histori"
                      placeholder="DD/MM/YYYY" value="<?= date('d/m/Y') ?>" required>
              </div>
          </div>

          <div id="not_hapus" style="display: none;">
            <div class="form-group">
              <h5>SKPD
                  <!-- <span class="required text-danger">*</span> -->
              </h5>
              <div class="controls">
                  <select id="id_skpd" name="id_skpd" class="form-control select2">
                    <!-- <option value="">Pilih SKPD</option> -->
                      <?php
                      foreach ($dataSkpd as $val) {
                      ?>
                          <option value="<?= $val->id_skpd ?>"><?= $val->nama_skpd ?></option>
                      <?php
                      }
                      ?>
                  </select>
              </div>
            </div>

            <div class="form-group">
              <h5>Lokasi/Ruang</h5>
              <div class="controls">
                  <textarea name="lokasi_histori" id="lokasi_histori" rows="2" class="form-control"></textarea>
              </div>
            </div>

            <div class="form-group">
              <h5>Keperluan
                  <!-- <span class="required text-danger">*</span> -->
              </h5>
              <div class="controls">
                  <textarea name="keperluan_histori" id="keperluan_histori" rows="2" class="form-control"></textarea>
              </div>
            </div>

            <div class="form-group">
              <h5>Pemegang
                  <!-- <span class="required text-danger">*</span> -->
              </h5>
              <div class="controls">
                  <input type="text" name="pemegang" id="pemegang" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <h5>Keterangan
                <!-- <span class="required text-danger">*</span> -->
            </h5>
            <div class="controls">
                <textarea name="ket_histori" id="ket_histori" rows="2" class="form-control"></textarea>
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
      var dataid = $('#delete_all').val();
      $('#modal_form #id').val(dataid);
      $('#modal_form #id_aset_status').val('').change();
      $('#modal_form #tgl_histori').datepicker("setDate", "<?= date('d/m/Y') ?>");
      $('#modal_form #tgl_histori').datepicker("refresh");
      $('#modal_form #id_skpd').val(1).change();
      $('#modal_form #lokasi_histori').val('');
      $('#modal_form #keperluan_histori').val('');
      $('#modal_form #pemegang').val('');
      $('#modal_form #ket_histori').val('');
  }

  function showModalEksekusi() {
    clear_data();
    $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/eksekusiAset'; ?>");
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
  }

  function changeExec(data) {
    var value = $(data).val();
    var select = $(data).find('option:selected').text();
    
    if (select == 'Usulan Hapus' ||  value == '') {
      $('#not_hapus').hide();
    } else {
      $('#not_hapus').show();
    }
  }
</script>

<script>
    function pilihBarang(data, type) {
        let id = $(data).val();
        
        if (id == 0) {
            if(type=='ifChecked'){
                $('.skin-check input:checkbox').iCheck('check');
            } else {
                $('.skin-check input:checkbox').iCheck('uncheck');
            }
        } else {
            var select_id  = $('#delete_all').val();
            var value_id   = '';

            if(type=='ifChecked'){
                if (select_id == '') {
                    value_id  = id;
                    // $('#btn_delete').attr('disabled',false);
                    $('#btn_eksekusi').attr('disabled',false);
                } else {
                    value_id += select_id + ';' + id;
                }
            } else {
                var arr = select_id.split(";");
                var result = arr.filter(function(val){
                    return val != id; 
                });
                value_id = result.join(';');

                if (result.length == 0) {
                    // $('#btn_delete').attr('disabled',true);
                    $('#btn_eksekusi').attr('disabled',true);
                }
            }
            $('#delete_all').val(value_id);
        }
    }
</script>


<script type="text/javascript">
    function changeRupe(data) {
        var val = formatRupiah($(data).val(), 'Rp. ');
        $(data).val(val);
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>