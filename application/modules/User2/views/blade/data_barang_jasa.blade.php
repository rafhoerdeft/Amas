<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      
      <div class="content-header-left col-md-9 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Barang Jasa</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
              <li class="breadcrumb-item active">Barang Jasa</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="content-header-right col-md-3 col-12 mb-2">
          <!-- <div class="dropdown"> -->
            <!-- <input type="hidden" name="data_selected" id="data_selected"> -->
            <!-- <button id="btn_eksekusi" class="btn btn-info btn-block round px-2" id="dropdownBreadcrumbButton" type="button"
                onclick="showModalEksekusi()" disabled>
                <i class="la la-check font-small-3"></i> Eksekusi Barang
            </button> -->

            <form action="<?= base_url($this->controller.'/formEksekusiBarangJasa') ?>" method="POST" >
                <?= token_csrf() ?>
                <input type="hidden" name="data_selected" id="data_selected">
                <button id="btn_eksekusi" class="btn btn-info btn-block round px-2" type="submit" disabled>
                    <i class="la la-check font-small-3"></i> Eksekusi Barang 
                    <span class="badge badge-pill badge-glow badge-danger" style="float: right">0</span>
                </button>
            </form>
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

                  <style>
                    .no-wrap {
                      white-space: nowrap;
                    }
                  </style>

                  <?= formSearch('data_barang_jasa') ?>

                  <table id="data_barang_jasa" class="table table-hover table-bordered table-striped" style="font-size: 8pt">
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>
                            <div class="skin skin-check-all">
                                <input type="checkbox" name="plh_brg_all" id="check_all" value="0">
                            </div>
                        </th>
                        <th>Aksi</th>
                        <!-- <th>Ambil</th> -->
                        <th>Kode</th>
                        <th>Tgl Masuk</th>
                        <th>Nama Barang</th>
                        <th>Merk/Type</th>
                        <th>Serial Number</th>
                        <th>Satuan</th>
                        <th>Harga (Rp)</th>
                        <th>Jml</th>
                        <th>Sisa</th>
                      </tr>
                    </thead>

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

<div class="modal animated bounceInUp text-left" id="modal_histori" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div id="modal_header" class="modal-header bg-success">
                <h4 class="modal-title white" id="modal_title"><i class="la la-history"></i> Histori Aset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <span id="info_histori"></span>
                <hr>
                <table id="tbl_histori" class="table table-hover table-bordered table-striped table-responsive d-lg-table sizeFontSm">
                    <thead>
                        <tr>
                            <th>Tgl Eksekusi</th>
                            <th>SKPD</th>
                            <th>Lokasi</th>
                            <th>Keperluan</th>
                            <th>Penanggung Jawab</th>
                            <th>Pemegang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="modal-footer">
                <!-- <button type="button" id="btn_reset" class="btn btn-success waves-effect" onclick="tableToExcel('tbl_rincian', 'RincianBarangPengadaan', 'RincianBarangPengadaan.xls')">EXPORT (.XLS)</button> -->
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animated bounceInDown text-left" id="modal_form" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="form_input" id="form_input" method="post" action="">
        
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="back" id="back" value="<?= base_url($this->controller.'/dataBarangJasa') ?>">
        <input type="hidden" id="data_update_barang" name="data_update_barang">

        <?= token_csrf() ?>

        <div id="modal_header" class="modal-header bg-info">
          <h4 class="modal-title white" id="modal_title">Eksekusi Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
              <h5>Tanggal
                  <span class="required text-danger">*</span>
              </h5>
              <div class="controls">
                  <input type="text" class="form-control date-picker" id="tgl_bj_keluar" name="tgl_bj_keluar"
                      placeholder="DD/MM/YYYY" value="<?= date('d/m/Y') ?>" required>
              </div>
          </div>

          <div id="not_hapus">
            <div class="form-group">
              <h5>SKPD
                  <!-- <span class="required text-danger">*</span> -->
              </h5>
              <div class="controls">
                  <select id="id_skpd" name="id_skpd" class="form-control select2">
                    <!-- <option value="">Pilih SKPD</option> -->
                      <?php
                      // foreach ($dataSkpd as $val) {
                      ?>
                          <!-- <option value="<?//= $val->id_skpd ?>"><?//= $val->nama_skpd ?></option> -->
                      <?php
                      // }
                      ?>
                  </select>
              </div>
            </div>

            <div class="form-group">
              <h5>Lokasi/Ruang</h5>
              <div class="controls">
                  <textarea name="lokasi_bj_keluar" id="lokasi_bj_keluar" rows="2" class="form-control"></textarea>
              </div>
            </div>

            <div class="form-group">
              <h5>Keperluan
                  <!-- <span class="required text-danger">*</span> -->
              </h5>
              <div class="controls">
                  <textarea name="keperluan_bj_keluar" id="keperluan_bj_keluar" rows="2" class="form-control"></textarea>
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
                <textarea name="ket_bj_keluar" id="ket_bj_keluar" rows="2" class="form-control"></textarea>
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
      var dataid = $('#data_selected').val();
      $('#modal_form #id').val(dataid);
      $('#modal_form #tgl_bj_keluar').datepicker("setDate", "<?= date('d/m/Y') ?>");
      $('#modal_form #tgl_bj_keluar').datepicker("refresh");
      $('#modal_form #lokasi_bj_keluar').val('');
      $('#modal_form #id_skpd').val(1).change();
      $('#modal_form #keperluan_bj_keluar').val('');
      $('#modal_form #pemegang').val('');
      $('#modal_form #ket_bj_keluar').val('');

      if ($('textarea[name="sn_barang"]').length > 0) {
        var data_update_barang = [];
        var data_ambil_barang = [];
        $('textarea[name="sn_barang"]').each(function(e){
            let ids     = $(this).attr('id');
            let id      = ids.split("_")[1];
            let nama    = $('#nm_'+id).val();
            let merk    = $('#merk_'+id).val();
            let sn      = $('#sn_'+id).val();
            let ambil   = $('#ambil_'+id).val();
            
            data_update_barang.push({
                id_barang: id,
                nama_barang: nama,
                merk_barang: merk,
                sn_barang: sn,
                jml_ambil: ambil,
            });

            if (ambil != null && ambil != '' && ambil != '0') {
                data_ambil_barang.push(ambil);
            }
        });

        if (data_ambil_barang.length == data_update_barang.length) {
            $('#modal_form #data_update_barang').val(JSON.stringify(data_update_barang));
            return true;
        } else {
            return false;
        }
      }
  }

  function showModalEksekusi() {
    var res = clear_data();
    if (!res) {
        alert('Input jumlah ambil barang harus diisi semua!');
        return false;
    } 

    $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/eksekusiBarangJasa'; ?>");
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); 
  }

</script>

<script>
    function deleteAll() {
        var dataid      = $('#data_selected').val();
        var link        = "<?= base_url($this->controller.'/deleteAsetAll') ?>";
        var csrfname    = "<?= $this->security->get_csrf_token_name(); ?>";
        var csrfcode    = "<?= $this->security->get_csrf_hash(); ?>"
        var table       = "aset";
        var data = {
            dataid:dataid,
            link:link,
            table:table,
            csrfname:csrfname,
            csrfcode:csrfcode,
        };
        hapusDataAll(data);
    }

    function pilihAset(data, type) {
        var id = $(data).val();
        var tr = $(data).parent().parent().parent().parent();
        
        if (id == 0) {
            if(type=='ifChecked'){
                $('.skin-check input:checkbox').iCheck('check');
            } else {
                $('.skin-check input:checkbox').iCheck('uncheck');
            }
        } else {
            var select_id  = $('#data_selected').val();
            var value_id   = '';

            if(type=='ifChecked'){
                var ambil = $('#ambil_'+id).attr('disabled', false);
                tr.toggleClass('row_cek');

                //ambil isian dalam element td
                // var td = tr.children();

                // var td_nama = td.eq(7);
                // var val_td_nama = td_nama.html();
                // td_nama.html("<textarea id='nm_"+id+"' name='nm_barang' rows='1' style='width: 100%;'>"+val_td_nama+"</textarea>");

                // var td_merk = td.eq(8);
                // var val_td_merk = td_merk.html();
                // td_merk.html("<textarea id='merk_"+id+"' name='merk_barang' rows='1' style='width: 100%;'>"+val_td_merk+"</textarea>");

                // var td_sn = td.eq(9);
                // var val_td_sn = td_sn.html();
                // td_sn.html("<textarea id='sn_"+id+"' name='sn_barang' rows='1' style='width: 100%;'>"+val_td_sn+"</textarea>");

                if (select_id == '') {
                    value_id  = id;
                    $('#btn_eksekusi').attr('disabled',false);
                } else {
                    value_id += select_id + ';' + id;
                }
            } else {
                var ambil = $('#ambil_'+id).attr('disabled', true);
                tr.toggleClass();

                //ambil isian dalam element td
                // var td = tr.children();

                // var td_nama = td.eq(7);
                // var val_td_nama = td_nama.children().val();
                // td_nama.html(val_td_nama);

                // var td_merk = td.eq(8);
                // var val_td_merk = td_merk.children().val();
                // td_merk.html(val_td_merk);

                // var td_sn = td.eq(9);
                // var val_td_sn = td_sn.children().val();
                // td_sn.html(val_td_sn);

                var arr = select_id.split(";");
                var result = arr.filter(function(val){
                    return val != id; 
                });
                value_id = result.join(';');

                if (result.length == 0) {
                    $('#btn_eksekusi').attr('disabled',true);
                }
            }
            $('#data_selected').val(value_id);

            if (value_id != '' && value_id != null) {
                count_select = value_id.split(";").length;
            } else {
                count_select = 0;
            }
            
            $('.content-header .badge').html(count_select);
        }
    }

    function cekChangePage() {
      var select_id  = $('#data_selected').val();
      var arr = select_id.split(";");
      arr.forEach(function(value, index) {
        var cekbox = $('.skin-check input:checkbox[value="'+value+'"]');
        cekbox.iCheck('check');
        cekbox.parent().parent().parent().toggleClass('row_cek');
      });
    }

    // Cek jml ambil <= SISA
    function cekVal(data) {
        var val = $(data).val();
        if (val!='' && val!=null) {
            var value = parseInt($(data).val().replace(/\./gi, ''));
        } else {
            var value = 0;
        }
        var sisa = parseInt($(data).data().sisa.toString().replace(/\./gi, ''));
        
        if (value > sisa) {
            alert('Nilai jumlah ambil melebihi sisa barang!');
            var nilaiJml = formatRupiah(sisa.toString());
            $(data).val(nilaiJml);
        } else {
            var nilaiJml = formatRupiah(value.toString());
            $(data).val(nilaiJml);
        }
    }

    // Cek Checkbox on ROW
    $(document).ready(function() {
        $('#data_barang_jasa').on('click', 'tbody tr', function (e) {
            var td = $(this).children();
            var cekbox = td.eq(1).find('input');
            var checked = cekbox.parent().hasClass('checked');
            if (checked) {
                if (e.target.tagName !== 'TEXTAREA' && e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A' && e.target.tagName !== 'I') {
                    cekbox.iCheck('uncheck');
                }
            } else {
              var cek_disabled = cekbox.parent().hasClass('disabled');
                if (!cek_disabled) {
                  if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A' && e.target.tagName !== 'I') {
                      cekbox.iCheck('check');
                  }
                }
            }
        });
    });
</script>

<script>
  function historiModal(data) {
      var nama_barang = $(data).data().nama;
      var kode_barang = $(data).data().kode;

      var penanggung  = $(data).data().penanggung.split(';');
      var pemegang    = $(data).data().pemegang.split(';');
      var ket         = $(data).data().ket.split(';');
      var keperluan   = $(data).data().keperluan.split(';');
      var skpd        = $(data).data().skpd.split(';');
      var lokasi      = $(data).data().lokasi.split(';');
      var tgl         = $(data).data().tgl.split(';');
      var jml         = $(data).data().jml.toString().split(';');

      var row = '';
      for (let i = 0; i < tgl.length; i++) {
          row +=  "<tr>"+
                      "<td align='center'>"+tgl[i]+"</td>"+
                      "<td>"+skpd[i]+"</td>"+
                      "<td>"+lokasi[i]+"</td>"+
                      "<td>"+keperluan[i]+"</td>"+
                      "<td>"+penanggung[i]+"</td>"+
                      "<td>"+pemegang[i]+"</td>"+
                      "<td align='right'>"+formatRupiah(jml[i])+"</td>"+
                      "<td>"+ket[i]+"</td>"+
                  "</tr>";
      }

      $('#modal_histori #info_histori').html(nama_barang + ' (' + kode_barang + ')');
      $('#modal_histori #tbl_histori tbody').html(row);

      $('#modal_histori').modal({
          backdrop: 'static',
          keyboard: false
      });
  }
</script>

<script type="text/javascript">
    function changeRupe(data){
        var val = formatRupiah($(data).val(), 'Rp. ');
        $(data).val(val);
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>