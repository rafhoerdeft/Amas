<!-- <style>
  .dash .card{
    margin-bottom: auto !important;
  }
</style> -->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body dash">
      <!-- PENGADAAN -->
      <div class="card bg-hexagons">
        <div class="card-header bg-blue-grey">
          <h4 class="card-title text-white">Pengadaan</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li class="text-white"><a data-action="collapse"><i class="ft-minus"></i></a></li>
            </ul>
          </div>
        </div>

        <div class="card-content collapse show">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 col-12">
                <div class="card pull-up bg-info">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left text-white">
                          <span>Bulan Ini</span>
                          <h3 class="text-white"><?= $this_month ?></h3>
                        </div>
                        <div class="align-self-center">
                          <i class="ft-box font-large-2 float-right text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-12">
                <div class="card pull-up bg-success">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left text-white">
                          <span>6 Bulan Terakhir</span>
                          <h3 class="text-white"><?= $last_6_month ?></h3>
                        </div>
                        <div class="align-self-center">
                          <i class="ft-box font-large-2 float-right text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-12">
                <div class="card pull-up bg-danger">
                  <div class="card-content">
                    <div class="card-body ">
                      <div class="media d-flex">
                        <div class="media-body text-left text-white">
                          <span>Tahun Ini</span>
                          <h3 class="text-white"><?= $this_year ?></h3>
                        </div>
                        <div class="align-self-center">
                          <i class="ft-box font-large-2 float-right text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <!-- ASET -->
      <div class="card bg-hexagons">
        <div class="card-header bg-teal">
          <h4 class="card-title text-white">Aset</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li class="text-white"><a data-action="collapse"><i class="ft-minus"></i></a></li>
            </ul>
          </div>
        </div>

        <div class="card-content collapse show">
          <div class="card-body">
            <div class="row">
              <?php $bg_color = ['red','purple','blue','teal','cyan','amber']; ?>
              <?php foreach ($data_aset as $key => $val) { ?>
                <div class="col-md-4 col-12">
                  <div class="card pull-up bg-<?=$bg_color[$key]?> bg-darken-2">
                    <div class="card-content">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left text-white">
                            <span><?= $val->jenis_aset ?></span>
                            <h3 class="text-white"><?= $val->jml_aset ?></h3>
                          </div>
                          <div class="align-self-center">
                            <i class="la la-puzzle-piece font-large-2 float-right text-white"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>