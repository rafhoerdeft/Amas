<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Tambah Aset - <?= $dataJenisKib->nama_kib ?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= base_url($this->controller.'/dataAset/'.encode($id_jenis_kib)) ?>">Data Aset</a></li>
                            <li class="breadcrumb-item active">Tambah Aset</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-4 col-12 mb-2">
                <div class="dropdown float-md-right">
                    <a type="button" href="<?= base_url('User2/dataAset/'.encode($id_jenis_kib)) ?>" class="btn btn-warning btn-block round px-2" id="dropdownBreadcrumbButton" >
                        <i class="la la-arrow-left font-small-3"></i> Kembali
                    </a>
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

                                    <form action="<?= base_url('User2/simpanDataAset') ?>" method="POST" class="tab-steps wizard-circle">
                                        <?= token_csrf() ?>
                                        <input type="hidden" id="pilih_aset" name="pilih_aset">
                                        <input type="hidden" id="pilih_jml_aset" name="pilih_jml_aset">
                                        <input type="hidden" id="aset_utama" name="aset_utama">
                                        <input type="hidden" id="kib" name="kib" value="<?= $id_jenis_kib ?>">
                                        <input type="hidden" id="tbl_kib" name="tbl_kib" value="<?= $dataJenisKib->nama_tbl_kib ?>">

                                        <input type="hidden" id="data_update_barang" name="data_update_barang">
                                        <!-- Step 1 -->
                                        <?php if ($status_asal=='pengadaan') { ?>
                                        <h6><i class="step-icon ft-check-square"></i> Pilih Barang</h6>
                                        <fieldset>
                                            <table id="dataTable"
                                                class="table table-hover table-bordered table-striped table-responsive d-xl-table"
                                                style="font-size: 8pt">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No</th>
                                                        <th>Pilih Aset</th>
                                                        <th>Pilihan Utama</th>
                                                        <th>No. Kontrak</th>
                                                        <th>Kode</th>
                                                        <th>Nama Barang</th>
                                                        <th>Merk Barang</th>
                                                        <th>Serial Number</th>
                                                        <th>Satuan</th>
                                                        <th>Harga (Rp)</th>
                                                        <!-- <th>Jumlah</th> -->
                                                        <!-- <th>Total (Rp)</th> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no=0; $tot_harga = 0; foreach ($dataBarang as $val) { $no++;?>
                                                    <tr>
                                                        <td align="center"><?= $no ?></td>
                                                        <td nowrap align="center">
                                                            <div class="skin skin-check">
                                                                <input type="checkbox" name="plh_ast[]" id="brg_<?= $val->id_barang ?>"
                                                                    value="<?= $val->id_barang ?>" 
                                                                    data-harga="<?= $val->harga_barang ?>" 
                                                                    data-jml="<?= $val->jml_barang ?>">
                                                            </div>
                                                        </td>
                                                        <td nowrap align="center">
                                                            <div class="skin skin-radio">
                                                                <input type="radio" name="ast_utm"
                                                                id="ast_<?= $val->id_barang ?>" value="<?= $val->id_barang ?>" data-nama="<?= $val->nama_barang ?>" 
                                                                data-satuan="<?= $val->satuan_barang ?>" 
                                                                data-merk="<?= $val->merk_barang ?>" 
                                                                data-harga="<?= nominal($val->harga_barang) ?>" 
                                                                data-jml="<?= nominal($val->jml_barang) ?>" disabled>
                                                            </div>
                                                        </td>
                                                        <td align="center"><?= $val->no_kontrak ?></td>
                                                        <td align="center"><?= $val->kode_barang ?></td>
                                                        <td style="width: 150px;"><?= $val->nama_barang ?></td>
                                                        <td><?= $val->merk_barang ?></td>
                                                        <td><?= $val->sn_barang ?></td>
                                                        <td align="center" style="width: 75px;"><?= $val->satuan_barang ?></td>
                                                        <td align="right" style="width: 75px;" nowrap><?= nominal($val->harga_barang) ?></td>
                                                        <!-- <td align="center"><?php //echo nominal($val->jml_barang); ?></td> -->
                                                        <!-- <td align="right">
                                                            <?php //echo nominal($val->harga_barang * $val->jml_barang); ?>
                                                        </td> -->
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>
                                        </fieldset>
                                        <!-- Step 2 -->
                                        <h6><i class="step-icon la la-pencil"></i> Lengkapi Data</h6>
                                        <?php } ?>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                        
                                                    <div class="form-group d-none">
                                                        <label for="status_masuk_aset">Asal Aset :</label>
                                                        <select id="status_masuk_aset" name="status_masuk_aset" class="form-control">
                                                            <option value="pengadaan" <?= ($status_asal=='pengadaan'?'selected':'') ?> >Pengadaan</option>
                                                            <option value="mutasi" <?= ($status_asal=='mutasi'?'selected':'') ?> >Mutasi SKPD</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nama_aset">Nama Aset :</label>
                                                        <input type="text" class="form-control" name="nama_aset" id="nama_aset" required>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="jml_aset">Jumlah Aset :</label> -->
                                                        <input type="hidden" class="form-control" onkeypress="return inputAngka(event);" name="jml_aset" id="jml_aset" value="1" maxlength="6" required>
                                                    <!-- </div> -->
                                                    <div class="form-group">
                                                        <label for="kode_baru_aset">Kode Aset :</label>
                                                        <input type="text" class="form-control" name="kode_baru_aset" id="kode_baru_aset" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_reg">Nomor Register :</label>
                                                        <input type="text" class="form-control" name="no_reg" id="no_reg" required>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="satuan_aset">Satuan Aset:</label>
                                                        <input type="text" class="form-control" name="satuan_aset" id="satuan_aset" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga :</label>
                                                        <input type="text" class="form-control" name="harga" id="harga" onkeyup="changeRupe(this)" onkeypress="return inputAngka(event);" maxlength="20" placeholder="0" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ket_aset">Keterangan :</label>
                                                        <textarea name="ket_aset" id="ket_aset" rows="1" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <?= $this->load->view('form_kib/form_'.$dataJenisKib->nama_tbl_kib) ?>

                                            <button type="submit" class="btn btn-primary float-right <?= ($status_asal=='pengadaan')?'d-none':'' ?>">Simpan</button>
                                        </fieldset>
                                        <hr>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>

    function formSubmit(data) {
        var form = $(data);
        var asal = $('#status_masuk_aset').val();

        var data_update_barang = [];
        $('textarea[name="nama_barang"]').each(function(e){
            let ids     = $(this).attr('id');
            let id      = ids.split("_")[1];
            let nama    = $(this).val();
            let merk    = $('#merk_'+id).val();
            let sn      = $('#sn_'+id).val();
            let satuan  = $('#satuan_'+id).val();
            
            data_update_barang.push({
                id_barang: id,
                nama_barang: nama,
                merk_barang: merk,
                sn_barang: sn,
                satuan_barang: satuan
            });
        });

        $('#data_update_barang').val(JSON.stringify(data_update_barang));

        if (asal == 'pengadaan') {
            var pil_ast = $('#pilih_aset').val();
            var ast_utm = $('#aset_utama').val();

            if (pil_ast == '' || ast_utm == '') {
                alert('Pilih barang yang akan dimasukan aset');
                return false;
            }
        }
                                
        // Trigger HTML5 validity.
        var reportValidity = form[0].reportValidity();

        // Then submit if form is OK.
        if(reportValidity){
            form.submit();
        } 
    }

    function pilihAset(data, type) {
        let id         = $(data).val();
        let jml        = $(data).data().jml;
        let harga      = parseInt($(data).data().harga);

        var select_id  = $('#pilih_aset').val();
        var select_jml = $('#pilih_jml_aset').val();
        var val_harga  = $('#harga').val();

        if (val_harga == '') {
            val_harga = 0;
        } else {
            val_harga  = parseInt($('#harga').val().replace(/\./gi, ''));
        }

        var value_id   = '';
        var value_jml  = '';
        var value_hrg  = 0;

        if(type=='ifChecked'){
            //ambil isian dalam element td
            var td = $(data).parent().parent().parent().parent().children();

            //ambil value dalam input td nama
            var td_nama = td.eq(5);
            var val_td_nama = td_nama.html();
            // td_nama.html("<input type='text' name='nama_barang' value='"+val_td_nama+"'>");
            td_nama.html("<textarea id='nama_"+id+"' name='nama_barang' rows='1' style='width: 100%;'>"+val_td_nama+"</textarea>");

            //ambil value dalam input td merk
            var td_merk = td.eq(6);
            var val_td_merk = td_merk.html();
            // td_merk.html("<input type='text' name='merk_barang' value='"+val_td_merk+"'>");
            td_merk.html("<textarea id='merk_"+id+"' name='merk_barang' rows='1' style='width: 100%;'>"+val_td_merk+"</textarea>");

            //ambil value dalam input td SN
            var td_sn = td.eq(7);
            var val_td_sn = td_sn.html();
            // td_sn.html("<input type='text' name='sn_barang' value='"+val_td_sn+"'>");
            td_sn.html("<textarea id='sn_"+id+"' name='sn_barang' rows='1' style='width: 100%;'>"+val_td_sn+"</textarea>");

            //ambil value dalam input td satuan
            var td_satuan = td.eq(8);
            var val_td_satuan = td_satuan.html();
            td_satuan.html("<input type='text' id='satuan_"+id+"' name='satuan_barang' value='"+val_td_satuan+"' style='width:100%;'>");

            value_hrg = (harga + val_harga);

            if (select_id == '') {
                value_id  = id;
                value_jml = jml;
                $('#ast_'+id).iCheck('check');
            } else {
                // if (!select_id.includes(id)) {
                    value_id += select_id + ';' + id;
                    value_jml += select_jml + ';' + jml;
                // } else {
                //     value_id = select_id;
                // }
            }
            $('#ast_'+id).iCheck('enable');
        } else {
            //ambil isian dalam element td
            var td = $(data).parent().parent().parent().parent().children();

            //ambil value dalam input td nama
            var td_nama = td.eq(5);
            var val_td_nama = td_nama.children().val();
            td_nama.html(val_td_nama);
            
            //ambil value dalam input td merk
            var td_merk = td.eq(6);
            var val_td_merk = td_merk.children().val();
            td_merk.html(val_td_merk);

            //ambil value dalam input td SN
            var td_sn = td.eq(7);
            var val_td_sn = td_sn.children().val();
            td_sn.html(val_td_sn);

            //ambil value dalam input td satuan
            var td_satuan = td.eq(8);
            var val_td_satuan = td_satuan.children().val();
            td_satuan.html(val_td_satuan);

            var arr = select_id.split(";");
            var result = arr.filter(function(val){
                return val != id; 
            });
            value_id = result.join(';');

            var arr2 = select_jml.split(";");
            var result2 = arr2.filter(function(val){
                return val != jml; 
            });
            value_jml = result2.join(';');

            $('#ast_'+id).iCheck('uncheck');
            $('#ast_'+id).iCheck('disable');

            if (value_id == '') {
                $('#aset_utama').val('');
                $("input[name='ast_utm']").attr('required',false);
            } else {
                $("input[name='ast_utm']").attr('required',true);
            }

            value_hrg = (val_harga - harga);
        }
        
        var show_hrg = formatRupiah(value_hrg.toString(), 'Rp. ');

        $('#pilih_aset').val(value_id);
        $('#pilih_jml_aset').val(value_jml);
        $('#harga').val(show_hrg);
    }

    function asetUtama(data, type) {
        let id      = $(data).val();
        let nama    = $(data).data().nama;
        let satuan  = $(data).data().satuan;
        let harga   = $(data).data().harga;
        let jml     = $(data).data().jml;
        let merk    = $(data).data().merk;

        if(type=='ifChecked'){
            $('#aset_utama').val(id);
            $('#nama_aset').val(nama);
            // $('#jml_aset').val(jml);
            $('#satuan_aset').val(satuan);
            
            if ($('#merk_type').length > 0) {
                $('#merk_type').val(merk);
            }
        } else {
            $('#aset_utama').val('');
            $('#nama_aset').val('');
            // $('#jml_aset').val('');
            $('#satuan_aset').val('');
            if ($('#merk_type').length > 0) {
                $('#merk_type').val('');
            }
        }
    }
</script>

<script>
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