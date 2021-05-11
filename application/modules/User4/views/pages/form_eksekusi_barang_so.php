<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Eksekusi Barang</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= base_url($this->controller.'/dataBarangSo') ?>">Data Barang</a></li>
                            <li class="breadcrumb-item active">Eksekusi Barang</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-4 col-12 mb-2">
                <div class="dropdown float-md-right">
                    <a type="button" href="<?= base_url($this->controller.'/dataBarangSo') ?>" class="btn btn-warning btn-block round px-2" id="dropdownBreadcrumbButton" >
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

                                    #tbl_aset th, td{
                                        padding: 10px;
                                    }
                                    </style>

                                    <form id="form_eksekusi" action="<?= base_url().$this->controller.'/eksekusiBarangSo' ?>" method="POST" class="tab-steps wizard-circle">
                                        <?= token_csrf() ?>
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="back" id="back" value="<?= base_url($this->controller.'/dataBarangSo') ?>">
                                        <input type="hidden" id="data_update_barang" name="data_update_barang">
                                        
                                        <!-- Step 1 -->
                                        <h6><i class="step-icon ft-check-square"></i> Cek Barang</h6>
                                        <fieldset>
                                            <table id="tbl_aset" class="table table-hover table-bordered table-striped table-responsive d-xl-table"
                                                style="font-size: 8pt">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No</th>
                                                        <th>Aksi</th>
                                                        <th>Ambil</th>
                                                        <th>Sisa</th>
                                                        <th>Kode</th>
                                                        <!-- <th>Tgl Masuk</th> -->
                                                        <th>Nama Barang</th>
                                                        <th>Merk/Type</th>
                                                        <th>Serial Number</th>
                                                        <th>Satuan</th>
                                                        <th>Harga (Rp)</th>
                                                        <th>Jml</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no=0; $tot_harga = 0; foreach ($dataBarang as $val) { $no++;?>
                                                    <tr>
                                                        <td align="center">
                                                            <?= $no ?>
                                                            <input type="hidden" name="numb" value="<?= $val->id_barang ?>">
                                                        </td>
                                                        <td nowrap align="center" style="width: 50px;">
                                                            <button type="button" class="btn btn-danger btn-sm btn-block" onclick="hapusRow(this)" title="Hapus">
                                                                <i class="la la-trash font-small-3"></i>
                                                            </button>
                                                        </td>
                                                        <td style="width: 70px;">
                                                            <input type="text" id="ambil_<?= $val->id_barang ?>" name="ambil_barang" style="width: 70px; text-align: center;" onkeypress="return inputAngka(event);" data-sisa="<?= $val->sisa ?>" onkeyup="cekVal(this)">
                                                        </td>                                                        
                                                        <td align="right" style="width: 75px;"><?= nominal($val->sisa) ?></td>
                                                        <td style="width: 75px;"><?= $val->kode_barang ?></td>
                                                        <!-- <td align="center"><?//= $val->tgl_masuk ?></td> -->
                                                        <td style="width: 175px;"><?= $val->nama_barang ?></td>
                                                        <td style="width: 175px;"><?= $val->merk_barang ?></td>
                                                        <td style="width: 175px;"><?= $val->sn_barang ?></td>
                                                        <td><?= $val->satuan_barang ?></td>
                                                        <td align="right" style="width: 75px;" nowrap><?= nominal($val->harga_barang) ?></td>
                                                        <td align="right" style="width: 75px;" nowrap><?= nominal($val->jml_barang) ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>
                                        </fieldset>
                                        <!-- Step 2 -->
                                        <h6><i class="step-icon la la-pencil"></i> Isi Form</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
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
                                                        <div class="form-group d-none">
                                                            <h5>SKPD
                                                                <!-- <span class="required text-danger">*</span> -->
                                                            </h5>
                                                            <div class="controls">
                                                                <select id="id_skpd" name="id_skpd" class="form-control select2">
                                                                    <!-- <option value="">Pilih SKPD</option> -->
                                                                    <?php
                                                                    foreach ($dataSkpd as $val) {
                                                                    ?>
                                                                        <option <?= $val->id_skpd==23?'selected':'' ?> value="<?= $val->id_skpd ?>"><?= $val->nama_skpd ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                        <h5>Lokasi/Ruang</h5>
                                                        <div class="controls">
                                                            <textarea name="lokasi_bj_keluar" id="lokasi_bj_keluar" rows="2" class="form-control" required></textarea>
                                                        </div>
                                                        </div>

                                                        <div class="form-group">
                                                        <h5>Keperluan
                                                            <!-- <span class="required text-danger">*</span> -->
                                                        </h5>
                                                        <div class="controls">
                                                            <textarea name="keperluan_bj_keluar" id="keperluan_bj_keluar" rows="2" class="form-control" required></textarea>
                                                        </div>
                                                        </div>

                                                        <div class="form-group">
                                                        <h5>Pemegang
                                                            <!-- <span class="required text-danger">*</span> -->
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="pemegang" id="pemegang" class="form-control" required>
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
                                            </div>

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

        if ($('input[name="numb"]').length > 0) {
            var data_id = [];
            $('input[name="numb"]').each(function(e){
                data_id.push($(this).val());
            });

            if ($('input[name="ambil_barang"]:enabled').length > 0) {
                var data_update_barang = [];
                var data_ambil_barang = [];
                $('input[name="ambil_barang"]:enabled').each(function(e){
                    let ids     = $(this).attr('id');
                    let id      = ids.split("_")[1];
                    // let nama    = $('#nm_'+id).val();
                    // let merk    = $('#merk_'+id).val();
                    // let sn      = $('#sn_'+id).val();
                    let ambil   = $('#ambil_'+id).val();
                    
                    data_update_barang.push({
                        id_barang: id,
                        // nama_barang: nama,
                        // merk_barang: merk,
                        // sn_barang: sn,
                        jml_ambil: ambil,
                    });

                    if (ambil != null && ambil != '' && ambil != '0') {
                        data_ambil_barang.push(ambil);
                    }
                });

                if (data_ambil_barang.length == data_update_barang.length) {
                    $('#form_eksekusi #data_update_barang').val(JSON.stringify(data_update_barang));
                } else {
                    alert('Input jumlah ambil barang harus diisi semua!');
                    return false;
                }
            } 

            $('#form_eksekusi #id').val(data_id.join(';'));
        } else {
            alert('Harus pilih minimal 1 barang!');
            return false;
        }
                                
        // Trigger HTML5 validity.
        var reportValidity = form[0].reportValidity();

        // Then submit if form is OK.
        if(reportValidity){
            form.submit();
        } 
    }

    function hapusRow(data) {
        var row = $(data).parent().parent();
        
        swal({
            title: "Hapus Data",
            text: "Apakah data ingin dihapus?",
            icon: "warning",
            showCancelButton: true,
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    className: "btn-warning",
                    closeModal: true,
                },
                confirm: {
                    text: "Ya, Hapus",
                    value: true,
                    visible: true,
                    className: "btn-danger",
                    closeModal: false,
                },
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                row.remove();
                swal.close();
            }
        });
    }

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