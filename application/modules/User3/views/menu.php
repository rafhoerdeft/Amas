    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
        role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item <?= ($active == '1' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url('User3/dashBoard') ?>" title="Dashboard"><i class="la la-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="dropdown nav-item <?= ($active == '2' ? 'active' : '') ?>" data-menu="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" title="Data Aset"><i class="la la-puzzle-piece"></i>
                        <span>Data Aset</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($dataKib as $val) { ?>
                            <li class="<?= (isset($active_sub) ? ($active_sub == '2.'.$val->id_jenis_kib ? 'active' : '') : '') ?>">
                                <a class="dropdown-item" href="<?= base_url('User3/dataAset/'.encode($val->id_jenis_kib)) ?>" data-toggle="dropdown"><span><?= $val->jenis_kib ?>. <?= $val->nama_kib ?></span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item <?= ($active == '3' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url('User3/historiAset') ?>" title="Histori Aset"><i class="la la-history"></i>
                        <span>Histori Aset</span>
                    </a>
                </li>
                <li class="nav-item <?= ($active == '4' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url('User3/dataMutasi') ?>" title="Mutasi Aset"><i class="ft-log-out"></i>
                        <span>Mutasi Aset</span>
                    </a>
                </li>
                <li class="nav-item <?= ($active == '5' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url('User3/dataUsulanHapus') ?>" title="Usulan Hapus"><i class="ft-trash-2"></i>
                        <span>Usulan Hapus</span>
                    </a>
                </li>
                <!-- <li class="nav-item <?//= ($active == '6' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?//= base_url('User3/historiAset') ?>"><i class="ft-box"></i>
                        <span>Histori Aset</span>
                    </a>
                </li> -->
                <!-- ================================================== -->
                <li class="nav-item <?= ($active == '6' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url($this->controller.'/dataBarangJasa') ?>" title="Non Aset"><i class="la la-tablet"></i>
                        <span>Non Aset</span>
                    </a>
                </li>
                <li class="nav-item <?= ($active == '7' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url($this->controller.'/historiBarangJasa') ?>" title="Histori Non Aset"><i class="la la-history"></i>
                        <span>Histori Non Aset</span>
                    </a>
                </li>
                <!-- ========================================================== -->
            </ul>
        </div>
    </div>