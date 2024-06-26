<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap4-toggle.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/typography.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/toastr.min.css">

    <!-- modernizr css -->
    <script src="<?=base_url()?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <?=$css?>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo">
                <a href="<?=base_url()?>Dashboard">
                    <img src="<?=base_url()?>assets/images/icon/logo.png" alt="logo" width="150px">
                </a>
            </div>
        </div>
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="<?=base_url()?>Paciente" aria-expanded="true">
                                <i class="ti-dashboard"></i><span>Pacientes </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>Reserva" aria-expanded="true">
                                <i class="ti-time"></i><span> Reservas </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>Consulta" aria-expanded="true">
                                <i class="ti-tag"></i><span>Reporte diario </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>Venta" aria-expanded="true">
                                <i class="ti-bag"></i><span> Ventas</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>Listaventa" aria-expanded="true">
                                <i class="ti-files"></i><span>Listado venta</span>
                            </a>
                        </li>
                         <li>
                            <a href="<?=base_url()?>Filtros" aria-expanded="true">
                                <i class="ti-export"></i><span>Filtrados</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>Cumpleanos" aria-expanded="true">
                                <i class="ti-crown"></i><span>Modulo Cumpleaños</span>
                            </a>
                        </li>
                        <?php
                            if ($_SESSION['tipo']=='ADMIN') {
                                ?>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-book"></i><span>Controles</span></a>
                                    <ul class="collapse">
                                        <li>
                                            <a href="<?= base_url() ?>Usuarios" aria-expanded="true">
                                                <i class="ti-user"></i><span> Usuarios</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Consentimientos" aria-expanded="true">
                                                <i class="ti-files"></i><span> Consentimiento</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Indicaciones" aria-expanded="true">
                                                <i class="ti-apple"></i><span> Indicaciones</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Tipotratamiento" aria-expanded="true">
                                                <i class="ti-agenda"></i><span>Tipo Tratamiento</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Tratamientos" aria-expanded="true">
                                                <i class="ti-rss"></i><span> Tratamientos</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Inventario" aria-expanded="true">
                                                <i class="ti-map"></i><span> inventario</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Productos" aria-expanded="true">
                                                <i class="ti-archive"></i><span> Productos</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>Dosificacion" aria-expanded="true">
                                                <i class="ti-archive"></i><span> Dosificacion FACTURA</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                <li>
                                    <a href="<?= base_url() ?>Export" aria-expanded="true">
                                        <i class="ti-sharethis"></i><span>Exportar BD</span>
                                    </a>
                                </li>
                                <?php
                            }
                        ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <!--div class="search-box pull-left">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div-->
                </div>
                <!-- profile info & task notification -->
                <div class="col-md-6 col-sm-4 clearfix">
                    <ul class="notification-area pull-right">
                        <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        <!--li class="dropdown">
                            <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                <span>2</span>
                            </i>
                            <div class="dropdown-menu bell-notify-box notify-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li-->
                        <a href="<?=base_url()?>welcome/logout">
                        <li class="settings-btn" >
                            <i class="ti-power-off"></i>
                        </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left"><?=$title?></h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="<?=base_url()?>Dashboard">Dashboard</a></li>
                            <li><span><?=$title?></span></li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right">
                        <img class="avatar user-thumb" src="<?=base_url()?>assets/images/author/avatar.png" alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['nombre']?> <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" >Tipo: <?=$_SESSION['tipo']?></a>
                            <a class="dropdown-item" href="<?=base_url()?>welcome/logout">Salir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <!-- button srea start -->
            <div class="row">
                <!-- General button -->
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <!--h4 class="header-title"><?=$title?></h4-->
