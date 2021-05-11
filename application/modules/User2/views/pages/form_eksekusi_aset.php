<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Eksekusi Aset - <?= $dataJenisKib->nama_kib ?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->controller) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= base_url($this->controller.'/dataAset/'.encode($id_jenis_kib)) ?>">Data Aset</a></li>
                            <li class="breadcrumb-item active">Eksekusi Aset</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-4 col-12 mb-2">
                <div class="dropdown float-md-right">
                    <a type="button" href="<?= base_url($this->controller.'/dataAset/'.encode($id_jenis_kib)) ?>" class="btn btn-warning btn-block round px-2" id="dropdownBreadcrumbButton" >
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

                                    <form id="form_eksekusi" action="<?= base_url().$this->controller.'/eksekusiAset' ?>" method="POST" class="tab-steps wizard-circle">
                                        <?= token_csrf() ?>
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="back" id="back" value="<?= base_url($this->controller.'/dataAset/'.encode($id_jenis_kib)) ?>">
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
                                                        <th>Nama Aset</th>
                                                        <th>Kode</th>
                                                        <!-- <th>Kode Lama</th> -->
                                                        <th>No. Reg</th>
                                                        <th>Satuan</th>
                                                        <?php if ($id_jenis_kib == 2) { ?>
                                                            <th>Serial Number</th>
                                                            <th>Merk/Type</th>
                                                        <?php } ?>
                                                        <th>Asal-Usul</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no=0; $tot_harga = 0; foreach ($dataAset as $val) { $no++;?>
                                                    <tr>
                                                        <td align="center"><?= $no ?><input type="hidden" name="numb" value="<?= $val->id_aset ?>"></td>
                                                        <td nowrap align="center" style="width: 30px;">
                                                            <button type="button" class="btn btn-danger btn-sm btn-block" onclick="hapusRow(this)">
                                                                <i class="la la-trash font-small-3"></i>
                                                            </button>
                                                        </td>
                                                        <td style="width: 150px;"><?= $val->nama_aset ?></td>
                                                        <td style="width: 200px;"><?= $val->kode_baru_aset ?></td>
                                                        <!-- <td><?//= $val->kode_lama_aset ?></td> -->
                                                        <td align="center"><?= $val->no_reg ?></td>
                                                        <td align="center"><?= $val->satuan_aset ?></td>

                                                        <?php if ($id_jenis_kib == 2) { ?>
                                                            <td style="width: 175px;">
                                                                <textarea id="sn_<?= $val->id_aset ?>" name="sn_barang" rows='1' style="width: 100%;"><?= $val->sn_aset ?></textarea>
                                                            </td>
                                                            <td style="width: 175px;">
                                                                <textarea id="merk_<?= $val->id_aset ?>" name="merk_barang" rows='2' style="width: 100%;"><?= $val->merk_type ?></textarea>    
                                                            </td>
                                                        <?php } ?>
                                                        
                                                        <td><?= $val->asal_usul ?></td>
                                                        <td align="right" style="width: 75px;" nowrap><?= nominal($val->harga_aset) ?></td>
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
                                        <h6><i class="step-icon la la-pencil"></i> Isi Form</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Jenis Eksekusi
                                                            <span class="required text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select id="id_aset_status" name="id_aset_status" class="form-control select2" onchange="changeExec(this)" required>
                                                                <option value="" selected>Pilih Jenis Eksekusi</option>
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
    function changeExec(data) {
        var value = $(data).val();
        var select = $(data).find('option:selected').text();
        
        if (select == 'Usulan Hapus' ||  value == '') {
        $('#not_hapus').hide();
        } else {
        $('#not_hapus').show();
        }
    }

    function formSubmit(data) {
        var form = $(data);

        if ($('input[name="numb"]').length > 0) {
            var data_id = [];
            $('input[name="numb"]').each(function(e){
                data_id.push($(this).val());
            });

            if ($('textarea[name="sn_barang"]').length > 0) {
                var data_update_barang = [];
                $('textarea[name="sn_barang"]').each(function(e){
                    let ids     = $(this).attr('id');
                    let id      = ids.split("_")[1];
                    let merk    = $('#merk_'+id).val();
                    let sn      = $('#sn_'+id).val();
                    
                    data_update_barang.push({
                        id_aset: id,
                        merk_barang: merk,
                        sn_barang: sn,
                    });
                });

                $('#form_eksekusi #data_update_barang').val(JSON.stringify(data_update_barang));
            } 

            $('#form_eksekusi #id').val(data_id.join(';'));
        }else {
            alert('Harus pilih minimal 1 aset!');
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