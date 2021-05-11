<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Rincian Pengadaan -
                    (<?= $dataKontrak->no_kontrak ?>)</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller.'/dataPengadaan') ?>">Data
                                    Pengadaan</a></li>
                            <li class="breadcrumb-item active">Rincian Pengadaan</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-2 col-12 mb-2">
                <!-- <div class="dropdown float-md-right"> -->
                    <button class="btn btn-success btn-block round px-2" id="dropdownBreadcrumbButton" type="button"
                        onclick="addModal()">
                        <i class="la la-plus font-small-3"></i> Tambah Data
                    </button>
                <!-- </div> -->
            </div>

            <div class="content-header-right col-md-2 col-12 mb-2">
                <!-- <div class="dropdown float-md-right"> -->
                    <input type="hidden" name="delete_all" id="delete_all">
                    <button id="btn_delete" class="btn btn-danger btn-block round px-2" id="dropdownBreadcrumbButton" type="button"
                        onclick="deleteAll()" disabled>
                        <i class="la la-trash font-small-3"></i> Hapus Data 
                        <span class="badge badge-pill badge-glow badge-warning" style="float: right">0</span>
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

                                    <style>
                                    .no-wrap {
                                        white-space: nowrap;
                                    }
                                    </style>

                                    <table id="dataTable" class="table table-hover table-bordered table-striped table-responsive d-xl-table"
                                        style="font-size: 8pt">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>
                                                    <div class="skin skin-check">
                                                        <input type="checkbox" name="plh_brg_all" id="check_all" value="0">
                                                    </div>
                                                </th>
                                                <th>Aksi</th>
                                                <th>Kode</th>
                                                <th>Nama Barang</th>
                                                <th>Merk/Type</th>
                                                <th>Serial Number</th>
                                                <th>Lokasi</th>
                                                <th>Satuan</th>
                                                <th>Harga (Rp)</th>
                                                <?= ($dataKontrak->jenis_rekening!='Modal')?"<th>Jumlah</th> <th>Total (Rp)</th>":'' ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no=1; $tot_harga = 0; foreach ($dataRincian as $val) { ?>
                                            <tr>
                                                <td align="center"><?= $no++ ?></td>
                                                <td nowrap align="center">
                                                    <div class="skin skin-check">
                                                        <input type="checkbox" name="plh_brg[]" value="<?= $val->id_barang ?>">
                                                    </div>
                                                </td>
                                                <td nowrap align="center">
                                                    <button type="button" onclick="hapusData(this)"
                                                        data-id="<?= encode($val->id_barang) ?>"
                                                        data-link="<?= base_url($this->controller.'/deleteRincianPengadaan') ?>"
                                                        data-csrfname="<?= $this->security->get_csrf_token_name(); ?>"
                                                        data-csrfcode="<?= $this->security->get_csrf_hash(); ?>"
                                                        class="btn btn-sm btn-danger" title="Hapus Data"><i
                                                            class="la la-trash-o font-small-3"></i></button>

                                                    <button type="button"
                                                        data-id="<?= encode($val->id_pengadaan) ?>"
                                                        data-nama="<?= $val->nama_barang ?>"
                                                        data-merk="<?= $val->merk_barang ?>"
                                                        data-satuan="<?= $val->satuan_barang ?>"
                                                        data-harga="<?= nominal($val->harga_barang) ?>"
                                                        data-jml="<?= nominal($val->jml_barang) ?>"
                                                        data-sn="<?= $val->sn_barang ?>"
                                                        onclick="editModal(this)" class="btn btn-sm btn-info"
                                                        title="Update Data"><i
                                                            class="la la-edit font-small-3"></i></button>
                                                </td>
                                                <td align="center"><?= $val->kode_barang ?></td>
                                                <td><?= $val->nama_barang ?></td>
                                                <td><?= $val->merk_barang ?></td>
                                                <td align="center"><?= ($val->sn_barang!=null && $val->sn_barang!='')?$val->sn_barang:'-' ?></td>
                                                <?php $lokasi = explode(';', $val->lokasi_aset); ?>
                                                <td><?= $lokasi[0] ?><?= ($lokasi[1]!='' && $lokasi[1]!=null)?', '.$lokasi[1]:'' ?></td>
                                                <td align="center"><?= $val->satuan_barang ?></td>
                                                <td align="right"><?= nominal($val->harga_barang) ?></td>

                                                <?= ($dataKontrak->jenis_rekening!='Modal')?
                                                    '<td align="center">'.nominal($val->jml_barang).'</td>'.'<td align="right">'.nominal($val->harga_barang * $val->jml_barang).'</td>'
                                                    :'' ?>
                                            </tr>
                                            <?php $tot_harga += $val->harga_barang * $val->jml_barang; } ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th colspan="<?= ($dataKontrak->jenis_rekening!='Modal')?'11':'9' ?>">Total Harga (Rp)</th>
                                                <th style="text-align: right;"><?= nominal($tot_harga) ?></th>
                                            </tr>
                                        </tfoot>

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

<div class="modal animated bounceInDown text-left" id="modal_form" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="form_input" id="form_input" method="post" action="">

                <input type="hidden" name="id" id="id">
                <input type="hidden" name="id_kontrak" id="id_kontrak" value="<?= encode($dataKontrak->id_kontrak) ?>">
                <input type="hidden" name="tgl_ba_serahterima" id="tgl_ba_serahterima" value="<?= $dataKontrak->tgl_ba_serahterima ?>">
                <input type="hidden" name="jenis_rekening" id="jenis_rekening" value="<?= $dataKontrak->jenis_rekening ?>">

                <?= token_csrf() ?>

                <div id="modal_header" class="modal-header bg-success">
                    <h4 class="modal-title white" id="modal_title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <h5>Nama Barang
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control"
                                placeholder="Isi nama barang" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Merk/Type
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" id="merk_barang" name="merk_barang" class="form-control"
                                placeholder="Isi merk barang" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Serial Number
                            <!-- <span class="required text-danger">*</span> -->
                        </h5>
                        <div class="controls">
                            <input type="text" id="sn_barang" name="sn_barang" class="form-control"
                                placeholder="Isi serial number barang">
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Satuan
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" id="satuan_barang" name="satuan_barang" class="form-control"
                                placeholder="Isi satuan barang" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Harga
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" id="harga_barang" name="harga_barang" class="form-control"
                                placeholder="Isi harga barang" onkeyup="changeRupe(this)"
                                onkeypress="return inputAngka(event);" maxlength="20" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Jumlah Barang
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" id="jml_barang" name="jml_barang" class="form-control"
                                placeholder="Isi jumlah barang" onkeypress="return inputAngka(event);" onkeyup="changeRupe(this)" maxlength="15" required>
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
    $('#modal_form #nama_barang').val('');
    $('#modal_form #merk_barang').val('');
    $('#modal_form #satuan_barang').val('');
    $('#modal_form #harga_barang').val('');
    $('#modal_form #jml_barang').val('');
    $('#modal_form #sn_barang').val('');
}

function addModal() {
    clear_data();
    $('#modal_form #modal_title').html('Tambah Data Rincian Barang');
    $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/simpanRincianPengadaan'; ?>");
    $('#modal_form #modal_header').removeClass("bg-info").addClass("bg-success");

    $('#modal_form #sn_barang').parent().parent().hide();
    $('#modal_form #jml_barang').parent().parent().show();

    $('#modal_form').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function editModal(data) {
    var id = $(data).data().id;
    var nama = $(data).data().nama;
    var merk = $(data).data().merk;
    var satuan = $(data).data().satuan;
    var harga = $(data).data().harga;
    var jml = $(data).data().jml;
    var sn = $(data).data().sn;
    var jns_rek = "<?= $dataKontrak->jenis_rekening ?>";

    clear_data();
    $('#modal_form #modal_title').html('Update Data Rincian Barang');
    $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/updateRincianPengadaan'; ?>");
    $('#modal_form #modal_header').removeClass("bg-success").addClass("bg-info");

    $('#modal_form #id').val(id);
    $('#modal_form #nama_barang').val(nama);
    $('#modal_form #merk_barang').val(merk);
    $('#modal_form #satuan_barang').val(satuan);
    $('#modal_form #harga_barang').val(harga);
    $('#modal_form #jml_barang').val(jml);
    $('#modal_form #sn_barang').val(sn);
    
    $('#modal_form #sn_barang').parent().parent().show();
    if (jns_rek=='Modal') {
        $('#modal_form #jml_barang').parent().parent().hide();
    }

    $('#modal_form').modal({
        backdrop: 'static',
        keyboard: false
    });
}
</script>

<script>
    function deleteAll() {
        var dataid      = $('#delete_all').val();
        var link        = "<?= base_url($this->controller.'/deleteAll') ?>";
        var csrfname    = "<?= $this->security->get_csrf_token_name(); ?>";
        var csrfcode    = "<?= $this->security->get_csrf_hash(); ?>"
        var table       = "barang";
        var data = {
            dataid:dataid,
            link:link,
            table:table,
            csrfname:csrfname,
            csrfcode:csrfcode,
        };
        hapusDataAll(data);
    }

    // Cek Checkbox on ROW
    $(document).ready(function() {

        $('.table').on('click', 'tbody tr', function (e) {
            var td = $(this).children();
            var cekbox = td.eq(1).find('input');
            var checked = cekbox.parent().hasClass('checked');

            if (e.target.tagName !== 'TEXTAREA' && e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A' && e.target.tagName !== 'I') {
                if (checked) {
                    cekbox.iCheck('uncheck');
                } else {
                    var cek_disabled = cekbox.parent().hasClass('disabled');
                    if (!cek_disabled) {
                        cekbox.iCheck('check');
                    }
                }
            }
        });

    });

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