@extends('layouts/master')

@section('header')
    @php
        $head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
    @endphp

    @foreach ($head as $val)
        <link href="{{$val}}" type="text/css" rel="stylesheet">
    @endforeach
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">

                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Data Nota Barang Masuk</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                                <li class="breadcrumb-item active">Data Nota</li>
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
                    <!-- <div class="dropdown"> -->
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
                                            style="font-size: small">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>
                                                        <div class="skin skin-check">
                                                            <input type="checkbox" name="plh_brg_all" id="check_all" value="0">
                                                        </div>
                                                    </th>
                                                    <th>Aksi</th>
                                                    <th>Rincian</th>
                                                    <th>No. Nota</th>
                                                    <th>Nama Toko</th>
                                                    <!-- <th>Kasir</th> -->
                                                    <th>Tgl. Nota</th>
                                                    <th>Nilai Nota (Rp)</th>
                                                    <th>Selisih (Rp)</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $no=1; foreach ($dataNota as $val) { ?>
                                                <tr>
                                                    <td align="center"><?= $no++ ?></td>
                                                    <td nowrap align="center">
                                                        <div class="skin skin-check">
                                                            <input type="checkbox" name="plh_brg[]" value="<?= $val->id_so ?>">
                                                        </div>
                                                    </td>
                                                    <td nowrap align="center">
                                                        <a href="<?= base_url($this->controller.'/rincianBarangMasuk/'.encode($val->id_so)) ?>"
                                                            type="button" class="btn btn-sm btn-primary"
                                                            title="Tambah Rincian"><i class="la la-plus font-small-3"></i></a>
                                                        

                                                        <button type="button" onclick="hapusData(this)"
                                                            data-id="<?= encode($val->id_so); ?>"
                                                            data-link="<?= base_url($this->controller.'/deleteBarangMasuk'); ?>"
                                                            data-csrfname="<?= $this->security->get_csrf_token_name(); ?>"
                                                            data-csrfcode="<?= $this->security->get_csrf_hash(); ?>"
                                                            class="btn btn-sm btn-danger" title="Hapus Data"><i
                                                                class="la la-trash-o font-small-3"></i></button>

                                                        <button type="button" 
                                                            data-id="<?= encode($val->id_so); ?>"
                                                            data-rekanan="<?= $val->id_rekanan; ?>"
                                                            data-nota="<?= $val->no_nota; ?>"
                                                            data-nilai="<?= nominal($val->nilai_nota); ?>"
                                                            data-tgl="<?= date('d/m/Y', strtotime($val->tgl_nota)); ?>"
                                                            onclick="editModal(this)" class="btn btn-sm btn-info"
                                                            title="Update Data"><i
                                                                class="la la-edit font-small-3"></i></button>
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
                                                    <td><?= $val->no_nota ?></td>
                                                    <td><?= $val->nama_rekanan ?></td>
                                                    <!-- <td><?//= $val->nama_kasir ?></td> -->
                                                    <td align="center"><?= date('d/m/Y', strtotime($val->tgl_nota)) ?></td>
                                                    <td align="right"><?= nominal($val->nilai_nota) ?></td>
                                                    
                                                    <td align="right">
                                                        <?= ($val->harga_barang==null ||  $val->harga_barang=='')?'0':nominal($val->nilai_nota - array_sum(explode(';', $val->harga_barang)))  ?>
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

    <div class="modal animated bounceInDown text-left" id="modal_form" role="dialog"
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

                        <div class="form-group" id="input_nota">
                            <h5>No. Nota
                                <span class="required text-danger">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" class="form-control" id="no_nota" name="no_nota"
                                    placeholder="Masukan nomor nota" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Rekanan/Toko
                                <span class="required text-danger">*</span>
                            </h5>
                            <div class="controls">
                                <select id="id_rekanan" name="id_rekanan" class="form-control select2" required>
                                    <option value="">Pilih Rekanan/Toko</option>
                                    <?php
                                    foreach ($dataRekanan as $val) {
                                    ?>
                                        <option value="<?= $val->id_rekanan ?>"><?= $val->nama_rekanan ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Tgl. Pembelian
                                <span class="required text-danger">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" class="form-control date-picker" id="tgl_nota" name="tgl_nota"
                                    placeholder="DD/MM/YYYY" value="<?= date('d/m/Y') ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Nilai Nota (Rp)
                                <span class="required text-danger">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" id="nilai_nota" name="nilai_nota" class="form-control" placeholder="Isi nilai nota" onkeyup="changeRupe(this)" onkeypress="return inputAngka(event);" required>
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
@endsection

@section('footer')
    @php
        $foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        $foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        $foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        $foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        $foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        $foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        $foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $foot[] = base_url('assets/js/icheck_config.js');
        $foot[] = base_url('assets/js/data_table.js');
        $foot[] = base_url('assets/js/cetak_excel.js');
        $foot[] = base_url('assets/js/delete_data.js');
        $foot[] = base_url('assets/js/delete_all_data.js');
    @endphp

    @foreach ($foot as $val)
        <script src="{{$val}}"></script>
    @endforeach

    @php
        $script[] = "showDataTable('Data Nota Masuk', '', '".date('dmY')."', [ 0, 4, 5, 6, 7, 8]);";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2();';
    @endphp

    @foreach ($script as $scr)
        <script type="text/javascript">
            {{$scr}}
        </script>
    @endforeach

    <script>
        function clear_data() {
            $('#modal_form #id').val('');
            $('#modal_form #no_nota').val('');
            $('#modal_form #nilai_nota').val('');
            $('#modal_form #id_rekanan').val('').change();
            $('#modal_form #tgl_nota').datepicker("setDate", "<?= date('d/m/Y') ?>");
            $('#modal_form #tgl_nota').datepicker("refresh");
        }

        function addModal() {
            clear_data();
            $('#modal_form #modal_title').html('Tambah Nota');
            $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/simpanBarangMasuk'; ?>");
            $('#modal_form #modal_header').removeClass("bg-info").addClass("bg-success");

            $('#modal_form').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function editModal(data) {
            var id = $(data).data().id;
            var nota = $(data).data().nota;
            var rekanan = $(data).data().rekanan;
            var nilai = $(data).data().nilai;
            var tgl = $(data).data().tgl;

            clear_data();
            $('#modal_form #modal_title').html('Update Nota');
            $('#modal_form #form_input').attr('action', "<?= base_url().$this->controller.'/updateBarangMasuk'; ?>");
            $('#modal_form #modal_header').removeClass("bg-success").addClass("bg-info");

            $('#modal_form #id').val(id);
            $('#modal_form #no_nota').val(nota);
            $('#modal_form #nilai_nota').val(nilai);
            $('#modal_form #id_rekanan').val(rekanan).change();
            $('#modal_form #tgl_nota').datepicker("setDate", tgl);
            $('#modal_form #tgl_nota').datepicker("refresh");

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

    <script>
        function deleteAll() {
            var dataid      = $('#delete_all').val();
            var link        = "<?= base_url($this->controller.'/deleteAll') ?>";
            var csrfname    = "<?= $this->security->get_csrf_token_name(); ?>";
            var csrfcode    = "<?= $this->security->get_csrf_hash(); ?>"
            var table       = "so";
            var data = {
                dataid:dataid,
                link:link,
                table:table,
                csrfname:csrfname,
                csrfcode:csrfcode,
            };
            hapusDataAll(data);
        }

        $(document).ready(function() {
            $('.table').on('click', 'tbody tr', function (e) {
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
@endsection