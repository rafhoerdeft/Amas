<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Aplikasi untuk kelola aset">
    <meta name="keywords"
        content="kabupaten magelang, pemerintah daerah, diskominfo, dinas komunikasi dan informatika, aset, asset, assets, kelola aset, manajemen aset, system management assets, sistem informasi">
    <meta name="author" content="DISKOMINFO KAB MAGELANG">
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/logo/logo_kab_sm.png">
    <title>Assets Management System</title>

    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/img/logo/logo_kab_sm.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/logo/logo_kab_sm.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
    rel="stylesheet">

    <link href="<?= assets_url . "app-assets/css/vendors.css" ?>" type="text/css" rel="stylesheet">
    <link href="<?= assets_url . "app-assets/css/app.css" ?>" type="text/css" rel="stylesheet">
    <link href="<?= assets_url . "app-assets/css/core/menu/menu-types/horizontal-menu.css" ?>" type="text/css" rel="stylesheet">
    <link href="<?= assets_url . "app-assets/css/core/colors/palette-gradient.css" ?>" type="text/css" rel="stylesheet">
    <link href="<?= assets_url . "app-assets/css/components.min.css" ?>" type="text/css" rel="stylesheet">
    <link href="<?= base_url('assets/css/loading.css') ?>" type="text/css" rel="stylesheet">

    <script src="<?= assets_url ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

    @yield('header')
        
    <style>
        .select2{
            width: 100% !important;
        }

        .sizeFontSm{
            font-size: 8pt;
        }

        .datepicker { font-size: 8pt; }

        .dataTables_length {
            float: left;
            margin-right: 10px;
        }

        .dt-buttons  {
            float: left;
            width: 175px !important;
        }

        .dataTables_filter label {
            margin-bottom: 10px;
            margin-top: 0px !important;
        }

        .dataTables_filter input {
            height: 40px;
        }

        #dataTable th, td {
            padding-inline: 16px !important;
        }

    </style>

    <style>
        .row_cek{
            background-color: #ffe175 !important;
        }
        .row_kosong{
            background-color: #ffabab !important;
        }
    </style>
</head>

<body class="horizontal-layout horizontal-menu 2-columns menu-expanded" data-open="click" data-menu="horizontal-menu"
    data-col="2-columns">

    <div class="loading-page" style="display: none;"></div>
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-dark navbar-brand-center bg-gradient-x-<?= $this->theme_color ?>">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row justify-content-center">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="javascript:void(0)">
                            <img style="max-width: 136px;" alt="modern admin logo" src="<?= base_url() ?>assets/img/logo/logo_amas_2.png">
                            <h3 class="d-lg-inline-block d-none brand-text mb-0">(<?= $this->nama_role ?>)</h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"><i class="ft-menu"></i></a></li>

                        <!-- <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>

                        <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                    class="ficon ft-search"></i></a>
                            <div class="search-input">
                                <input class="input" type="text" placeholder="Explore Modern...">
                            </div>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1">
                                    Hello, <span class="user-name text-bold-700" style="display: inline-block"><?= $this->full_name ?></span>
                                </span>
                                <span class="avatar avatar-online">
                                    <img src="<?= base_url() ?>assets/img/icon-profil/<?= $this->label ?>.jpg" alt="avatar"><i></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= base_url($this->controller.'/dataProfil') ?>"><i class="ft-user"></i> Profil</a>
                                <a class="dropdown-item" href="<?= base_url($this->controller.'/akunLogin') ?>"><i class="ft-lock"></i> Akun Login</a>
                                <!-- <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
                                <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('Auth/logout') ?>"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>