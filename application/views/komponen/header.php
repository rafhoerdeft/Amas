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

    <?php foreach ($css as $val) { ?>
        <link href="<?= $val ?>" type="text/css" rel="stylesheet">
    <?php } ?>

    <script src="<?= assets_url ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

    <?php 
        if (isset($js)) {
            foreach ($js as $val) { 
    ?>         
        <script src="<?= $val ?>"></script>
    <?php }} ?>

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
                        <!-- <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                                id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span
                                    class="selected-language"></span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item"
                                    href="#"><i class="flag-icon flag-icon-gb"></i> English</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a>
                            </div>
                        </li>
                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                    class="ficon ft-bell"></i>
                                <span
                                    class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">5</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">Notifications</span>
                                    </h6>
                                    <span class="notification-tag badge badge-default badge-danger float-right m-0">5
                                        New</span>
                                </li>
                                <li class="scrollable-container media-list w-100">
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">You have new order!</h6>
                                                <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor
                                                    sit amet, consectetuer elit.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-1">99% Server load</h6>
                                                <p class="notification-text font-small-3 text-muted">Aliquam tincidunt
                                                    mauris eu risus.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Five hour ago</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                                <p class="notification-text font-small-3 text-muted">Vestibulum auctor
                                                    dapibus neque.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Complete the task</h6>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last week</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-file icon-bg-circle bg-teal"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Generate monthly report</h6>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last month</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">
                                </i></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">Messages</span>
                                    </h6>
                                    <span class="notification-tag badge badge-default badge-warning float-right m-0">4
                                        New</span>
                                </li>
                                <li class="scrollable-container media-list w-100">
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-online rounded-circle">
                                                    <img src="<?= assets_url ?>app-assets/images/portrait/small/avatar-s-19.png"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Margaret Govan</h6>
                                                <p class="notification-text font-small-3 text-muted">I like your
                                                    portfolio, let's start.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-busy rounded-circle">
                                                    <img src="<?= assets_url ?>app-assets/images/portrait/small/avatar-s-2.png"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Bret Lezama</h6>
                                                <p class="notification-text font-small-3 text-muted">I have seen your
                                                    work, there is</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Tuesday</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-online rounded-circle">
                                                    <img src="<?= assets_url ?>app-assets/images/portrait/small/avatar-s-3.png"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Carie Berra</h6>
                                                <p class="notification-text font-small-3 text-muted">Can we have call in
                                                    this week ?</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Friday</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-away rounded-circle">
                                                    <img src="<?= assets_url ?>app-assets/images/portrait/small/avatar-s-6.png"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Eric Alsobrook</h6>
                                                <p class="notification-text font-small-3 text-muted">We have project
                                                    party this saturday.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">last month</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all messages</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </nav>