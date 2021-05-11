<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Data Pengadaan</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item active">Data Pengadaan</li>
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

                                    <table id="dataTable" class="table table-hover table-bordered table-striped table-responsive sizeFontSm">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Rincian</th>
                                                <th>No. Kontrak</th>
                                                <th>Tgl. Kontrak</th>
                                                <th>No. BA Serahterima</th>
                                                <th>Tgl. BA Serahterima</th>
                                                <th>Nama Penyedia</th>
                                                <th>PPKom</th>
                                                <th>Nilai Kontrak (Rp)</th>
                                                <th>Selisih (Rp)</th>
                                                <th>Jns. Rekening</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no=1; foreach ($dataPengadaan as $val) { ?>
                                            <tr>
                                                <td align="center"><?= $no++ ?></td>
                                                <td nowrap align="center">
                                                    <?php if ($this->id_user == $val->id_user) { ?>
                                                    <a href="<?= base_url($this->controller.'/rincianPengadaan/'.encode($val->id_kontrak)) ?>"
                                                        type="button" class="btn btn-sm btn-primary"
                                                        title="Tambah Rincian"><i class="la la-plus font-small-3"></i></a>
                                                    <?php } else { ?>
                                                        <button type="button" disabled class="btn btn-sm btn-secondary" title="Tambah Rincian"><i class="la la-plus font-small-3"></i></button>
                                                    <?php } ?>

                                                    <!-- <button type="button" onclick="hapusData(this)"
                                                        data-id="<?php //echo encode($val->id_kontrak); ?>"
                                                        data-link="<?php //echo base_url($this->controller.'/deleteDataPengadaan'); ?>"
                                                        data-csrfname="<?php //echo $this->security->get_csrf_token_name(); ?>"
                                                        data-csrfcode="<?php //echo $this->security->get_csrf_hash(); ?>"
                                                        class="btn btn-sm btn-danger" title="Hapus Data"><i
                                                            class="la la-trash-o font-small-3"></i></button>

                                                    <button type="button" 
                                                        data-id="<?php //echo encode($val->id_kontrak); ?>"
                                                        data-kontrak="<?php //echo $val->id_kontrak; ?>"
                                                        data-rekening="<?php //echo $val->jenis_rekening; ?>"
                                                        data-tgl="<?php //echo date('d/m/Y', strtotime($val->tgl_kontrak)); ?>"
                                                        onclick="editModal(this)" class="btn btn-sm btn-info"
                                                        title="Update Data"><i
                                                            class="la la-edit font-small-3"></i></button> -->
                                                </td>
                                                <td align="center">
                                                    <?= $val->jml_rincian==0?'Kosong':
                                                        '<button class="btn btn-sm btn-info" 
                                                            data-nama="'. $val->nm_brg .'"
                                                            data-merk="'. $val->merk_brg .'"
                                                            data-satuan="'. $val->sat_brg .'"
                                                            data-harga="'. $val->hrg_brg .'"
                                                            data-jml="'. $val->jml_brg .'"
                                                            onclick="rincianModal(this)"
                                                            title="Detail Rincian Barang">Detail</button>' ?>
                                                </td>
                                                <td><?= $val->no_kontrak ?></td>
                                                <td align="center"><?= date('d/m/Y', strtotime($val->tgl_kontrak)) ?></td>
                                                <td><?= $val->no_ba_serahterima ?></td>
                                                <td align="center"><?= date('d/m/Y', strtotime($val->tgl_ba_serahterima)) ?></td>
                                                <td><?= $val->nama_rekanan ?></td>
                                                <td><?= $val->nama_ppkom ?></td>
                                                <td align="right"><?= nominal($val->nilai_kontrak) ?></td>
                                                <td align="right">
                                                    <?= ($val->harga_pengadaan==null ||  $val->harga_pengadaan=='')?'0':nominal($val->nilai_kontrak - array_sum(explode(';', $val->harga_pengadaan)))  ?>
                                                </td>
                                                <td align="center">
                                                    <?= ($val->jenis_rekening==null || $val->jenis_rekening=='')?'-':$val->jenis_rekening ?>
                                                </td>
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

<div class="modal animated bounceInDown text-left" id="modal_form" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel10" aria-hidden="true">
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

                    <div class="form-group" id="input_kontrak">
                        <h5>No. Kontrak
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <select id="kontrak" name="kontrak" class="form-control select2" required>
                                <option value="">Pilih Nomor Kontrak</option>
                                <?php
                                // foreach ($dataKontrak as $val) {
                                ?>
                                    <option value="<?php //echo $val->id_kontrak; ?>"> <?php //echo $val->no_kontrak; ?> - <?php //echo $val->nama_rekanan; ?> </option>
                                <?php
                                // }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Jenis Rekening
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <select id="rekening" name="rekening" class="form-control select2" required>
                                <option value="">Pilih Jenis Rekening</option>
                                <option value="Modal">Modal</option>
                                <option value="Barang Jasa">Barang Jasa</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Tgl Pengadaan
                            <span class="required text-danger">*</span>
                        </h5>
                        <div class="controls">
                            <input type="text" class="form-control date-picker" id="tgl_kontrak" name="tgl_kontrak"
                                placeholder="DD/MM/YYYY" value="<?= date('d/m/Y') ?>" required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" id="btn_simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                    <button type="reset" id="btn_reset" class="btn btn-warning waves-effect">RESET</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal animated bounceInUp text-left" id="modal_rincian" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="modal_header" class="modal-header bg-success">
                <h4 class="modal-title white" id="modal_title">Rincian Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table id="tbl_rincian" class="table table-hover table-bordered table-striped table-responsive d-xl-table sizeFontSm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Satuan</th>
                            <th>Harga (Rp)</th>
                            <th>Jumlah</th>
                            <th>Total (Rp)</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" id="btn_reset" class="btn btn-success waves-effect" onclick="tableToExcel('tbl_rincian', 'RincianBarangPengadaan', 'RincianBarangPengadaan.xls')">EXPORT (.XLS)</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KELUAR</button>
            </div>
        </div>
    </div>
</div>

<script>
function clear_data() {
    $('#modal_form #id').val('');
    $('#modal_form #kontrak').val('').change();
    $('#modal_form #rekening').val('').change();
    $('#modal_form #tgl_kontrak').datepicker("setDate", "<?= date('d/m/Y') ?>");
    $('#modal_form #tgl_kontrak').datepicker("refresh");
}

function addModal() {
    clear_data();
    $('#modal_form #modal_title').html('Tambah Data Pengadaan');
    $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/simpanDataPengadaan'; ?>");
    $('#modal_form #modal_header').removeClass("bg-info").addClass("bg-success");

    $('#modal_form #kontrak').attr('required',true);
    $('#modal_form #input_kontrak').show();

    $('#modal_form').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function editModal(data) {
    var id = $(data).data().id;
    var kontrak = $(data).data().kontrak;
    var rekening = $(data).data().rekening;
    var tgl = $(data).data().tgl;

    clear_data();
    $('#modal_form #modal_title').html('Update Data Pengadaan');
    $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/updateDataPengadaan'; ?>");
    $('#modal_form #modal_header').removeClass("bg-success").addClass("bg-info");

    $('#modal_form #id').val(id);
    // $('#modal_form #kontrak').val(kontrak).change();
    $('#modal_form #kontrak').attr('required',false);
    $('#modal_form #input_kontrak').hide();

    $('#modal_form #rekening').val(rekening).change();
    $('#modal_form #tgl_kontrak').datepicker("setDate", tgl);
    $('#modal_form #tgl_kontrak').datepicker("refresh");

    $('#modal_form').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function rincianModal(data) {
    var nama    = $(data).data().nama.split(';');
    var merk    = $(data).data().merk.split(';');
    var satuan  = $(data).data().satuan.split(';');
    var harga   = $(data).data().harga.toString().split(';');
    var jml     = $(data).data().jml.toString().split(';');

    var row = '';
    var tot = 0;
    for (let i = 0; i < nama.length; i++) {
        row +=  "<tr>"+
                    "<td>"+nama[i]+"</td>"+
                    "<td>"+merk[i]+"</td>"+
                    "<td align='center'>"+satuan[i]+"</td>"+
                    "<td align='right'>"+formatRupiah(harga[i].toString(), 'Rp. ')+"</td>"+
                    "<td align='center'>"+jml[i]+"</td>"+
                    "<td align='right'>"+formatRupiah((jml[i]*harga[i]).toString(), 'Rp. ')+"</td>"+
                "</tr>";
        tot += jml[i]*harga[i];
    }

    var tfoot = "<tr>"+
                    "<th colspan='5'>Total Harga (Rp)</th>"+
                    "<th style='text-align: right; padding-inline: 16px;'>"+formatRupiah(tot.toString(), 'Rp. ')+"</th>"+
                "</tr>";

    $('#modal_rincian #tbl_rincian tbody').html(row);
    $('#modal_rincian #tbl_rincian tfoot').html(tfoot);

    $('#modal_rincian').modal({
        backdrop: 'static',
        keyboard: false
    });
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