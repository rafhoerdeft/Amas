    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
        role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="nav-item <?= ($active == '1' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url($this->controller.'/dashBoard') ?>" title="Dashboard"><i class="la la-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?= ($active == '2' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url($this->controller.'/dataRekanan') ?>" title="Rekanan"><i class="la la-group"></i>
                        <span>Rekanan</span>
                    </a>
                </li>
                <li class="nav-item <?= ($active == '3' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url($this->controller.'/dataKontrak') ?>" title="Kontrak"><i class="la la-paste"></i>
                        <span>Kontrak</span>
                    </a>
                </li>
                <li class="nav-item <?= ($active == '4' ? 'active' : '') ?>">
                    <a class="nav-link" href="<?= base_url($this->controller.'/dataPengadaan') ?>" title="Pengadaan"><i class="ft-box"></i>
                        <span>Pengadaan</span>
                    </a>
                </li>
                <!-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                        data-toggle="dropdown"><i class="la la-television"></i><span>Templates</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Vertical</a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="../vertical-menu-template"
                                        data-toggle="dropdown">Classic Menu</a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="../vertical-modern-menu-template"
                                        data-toggle="dropdown">Modern Menu</a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="../vertical-compact-menu-template"
                                        data-toggle="dropdown">Compact Menu</a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="../vertical-content-menu-template"
                                        data-toggle="dropdown">Content Menu</a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="../vertical-overlay-menu-template"
                                        data-toggle="dropdown">Overlay Menu</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Horizontal</a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="../horizontal-menu-template"
                                        data-toggle="dropdown">Classic</a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="../horizontal-menu-template-nav"
                                        data-toggle="dropdown">Full Width</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>