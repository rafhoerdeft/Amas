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
                <h4 class="card-title">List Pajak</h4>
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

                  <form action="<?= base_url('Admin/dataPajak') ?>" class="row" method="POST">
                    <?= token_csrf() ?>

                    <div class="col-lg-4 sizeFontSm" style="margin-bottom: 5px;">
                      <div class="input-daterange input-group date-range">
                        <input type="text" class="form-control" id="tgl_awal" name="tgl_awal" placeholder="DD/MM/YYYY" value="<?= $selectTglAwal ?>" style="font-size: 8pt;" />
                        <div class="input-group-append">
                            <span class="input-group-text bg-info b-0 text-white">SAMPAI</span>
                        </div>
                        <input type="text" class="form-control" placeholder="DD/MM/YYYY" value="<?= $selectTglAkhir ?>" id="tgl_akhir" name="tgl_akhir" style="font-size: 8pt;" />
                      </div>
                    </div>

                    <div class="col-lg-2 sizeFontSm" style="margin-bottom: 5px;">
                        <div class="controls">
                            <select id="status" name="status" class="form-control select2" required>
                                <!-- <option value="0" selected>SEMUA STATUS</option> -->
                                <?php
                                foreach ($dataStatusPajak as $sts) {
                                ?>
                                    <option <?= ($selectStatus == $sts['id']?'selected':'') ?> value="<?= $sts['id'] ?>"><?= $sts['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 sizeFontSm" style="margin-bottom: 5px;">
                        <div class="controls">
                            <select id="jenis_pajak" name="jenis_pajak" class="form-control select2" required>
                                <option value="0" selected>SEMUA JENIS</option>
                                <?php
                                foreach ($dataJenisPajak as $jns) {
                                ?>
                                    <option <?= ($selectJenis == $jns['id']?'selected':'') ?> value="<?= $jns['id'] ?>"><?= $jns['usahanm'] ?></option>
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
                    <?= formSearch('datapajak') ?>
                  </div>

                  <table id="datapajak" class="table table-hover table-bordered table-striped" style="font-size:8pt">
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>SSPD</th>
                        <th>Tgl SSPD</th>
                        <th>No. Bayar</th>
                        <th>NOPD</th>
                        <th>Wajib Pajak</th>
                        <th>Jenis</th>
                        <th>Masa</th>
                        <th>J. Tempo</th>
                        <!-- <th>Dasar</th> -->
                        <th>Pajak</th>
                        <?php  if ($selectJenis == '4') {  ?>
                            <th>Alamat</th>
                            <th>Lokasi Pasang</th>
                            <th>Judul</th>
                            <th>Panjang</th>
                            <th>Lebar</th>
                            <th>Tinggi</th>
                            <th>Luas</th>
                            <th>Muka</th>
                            <th>Jumlah</th>
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