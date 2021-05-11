<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <!-- <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">List Pajak</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?//= base_url('Admin') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">List Pajak</li>
            </ol>
          </div>
        </div>
      </div> -->
      <!-- <div class="content-header-right col-md-6 col-12">
        <div class="dropdown float-md-right">
          <button class="btn btn-danger dropdown-toggle round px-2" id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</button>
          <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
            <a class="dropdown-item text-center" href="<?//= base_url('Admin/perizinan/diterima/' . encode($id_surat)) ?>">Diterima</a>
            <a class="dropdown-item text-center" href="<?//= base_url('Admin/perizinan/ditolak/' . encode($id_surat)) ?>">Ditolak</a>
          </div>
        </div>
      </div> -->

    </div>
    <div class="content-body">
      <section class="inputmask" id="inputmask">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">List Perizinan</h4>
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
                <?= show_alert() ?>
                <div class="card-body">
                  
                  <form action="<?= base_url('Admin/dataIjin') ?>" class="row" method="POST">
                    <?= token_csrf() ?>

                    <div class="col-lg-2 pull-right sizeFontSm" style="margin-bottom: 5px;">
                        <div class="controls">
                            <select id="tahun" name="tahun" class="form-control select2">
                                <?php
                                foreach ($dataTahunIjin as $thn) {
                                ?>
                                    <option <?= ($selectTahun == $thn['tahun']?'selected':'') ?> value="<?= $thn['tahun'] ?>"><?= $thn['tahun'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 sizeFontSm" style="margin-bottom: 5px;">
                        <div class="controls">
                            <select id="bulan" name="bulan" class="form-control select2">
                                <option value="0" selected>Semua Bulan</option>
                                <?php
                                foreach ($dataBulanIjin as $bln) {
                                ?>
                                    <option <?= ($selectBulan == $bln['id']?'selected':'') ?> value="<?= $bln['id'] ?>"><?= $bln['nama_bulan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 sizeFontSm" style="margin-bottom: 5px;">
                        <div class="controls">
                            <select id="jenis_ijin" name="jenis_ijin" class="form-control select2">
                                <option value="0" selected>Semua Jenis Ijin</option>
                                <?php
                                foreach ($dataJenisIjin as $jns) {
                                ?>
                                    <option <?= ($selectJenis == $jns['id']?'selected':'') ?> value="<?= $jns['id'] ?>"><?= $jns['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>   

                    <div class="col-lg-2 sizeFontSm" style="margin-bottom: 5px;">
                        <div class="controls">
                            <select id="status" name="status" class="form-control select2">
                                <?php
                                foreach ($dataStatusIjin as $sts) {
                                ?>
                                    <option <?= ($selectStatus == $sts['id']?'selected':'') ?> value="<?= $sts['id'] ?>"><?= $sts['nama'] ?></option>
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

                  <div class="col-lg-3 pull-right" style="margin-bottom: 5px;">
                    <?= formSearch('dataijin') ?>
                  </div>

                  <table id="dataijin" class="table table-hover table-bordered table-striped" style="font-size:8pt">
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Tgl Permohonan</th>
                        <th>Nama Pemohon</th>
                        <th>Nama Perusahaan</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Jenis Ijin</th>
                        <th>Tgl. SK/No. Surat/Tgl. Berlaku</th>
                        <th>Pejabat TTD</th>
                        <!-- <th>Dasar</th> -->
                        <!-- <th>Pajak</th> -->
                        <?php  if ($selectJenis == '11') {  ?>
                            <th>Jenis Reklame</th>
                            <th>Naskah</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Ketinggian</th>
                            <th>Lokasi</th>
                        <?php } ?>
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