<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
role="navigation" data-menu="menu-wrapper">
<div class="navbar-container main-menu-content" data-menu="menu-container">
    <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="nav-item <?= ($data['active'] == '1' ? 'active' : '') ?>">
            <a class="nav-link" href="<?= base_url($this->controller.'/dashBoard') ?>" title="Dashboard"><i class="la la-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item <?= ($data['active'] == '2' ? 'active' : '') ?>">
            <a class="nav-link" href="<?= base_url($this->controller.'/dataRekanan') ?>" title="Rekanan"><i class="la la-group"></i>
                <span>Rekanan</span>
            </a>
        </li>
        <li class="nav-item <?= ($data['active'] == '3' ? 'active' : '') ?>">
            <a class="nav-link" href="<?= base_url($this->controller.'/dataKontrak') ?>" title="Kontrak"><i class="la la-paste"></i>
                <span>Kontrak</span>
            </a>
        </li>
        <li class="nav-item <?= ($data['active'] == '4' ? 'active' : '') ?>">
            <a class="nav-link" href="<?= base_url($this->controller.'/dataPengadaan') ?>" title="Pengadaan"><i class="ft-box"></i>
                <span>Pengadaan</span>
            </a>
        </li>
    </ul>
</div>
</div>