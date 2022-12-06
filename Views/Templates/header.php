<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sys-Medik Extranet</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php echo base_url ?>Usuarios">Sys-Medik Extranet</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 btn-outline-success" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-success" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>CambioPass">Cambio de contraseña</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link text-success" href="<?php echo base_url ?>Usuarios">
                            <div class="fa-solid fa-user mx-2"><i class="fas fa-tachometer-alt"></i></div>
                            Usuarios
                        </a>


                        <a class="nav-link collapsed text-success" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-toolbox text-success"></i></div>
                            Perfiles
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-success" href="<?php echo base_url ?>PerfilesAdministradores"><i class="fa-solid fa-screwdriver-wrench mx-2"></i>Administradores</a>
                                <a class="nav-link text-success" href="<?php echo base_url ?>PerfilesMedicos"><i class="fa-solid fa-user-doctor mx-2"></i>Médicos</a>
                                <a class="nav-link text-success" href="<?php echo base_url ?>PerfilesPacientes"><i class="fa-solid fa-hospital-user mx-2"></i>Pacientes</a>
                            </nav>
                        </div>

                        <!-- Aquí irán los siguientes elementos -->
                        <a class="nav-link text-success" href="<?php echo base_url ?>Especialidades">
                            <div class="fa-solid fa-hand-holding-medical mx-2"><i class="fa-solid fa-hand-holding-medical"></i></div>
                            Especialidades
                        </a>

                        <a class="nav-link text-success" href="<?php echo base_url ?>SolicitudConsulta">
                            <div class="fa-solid fa-briefcase-medical mx-2"><i class="fas fa-tachometer-alt"></i></div>
                            Solicitud de consulta
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Sesión iniciada como:</div>
                    <div class="fw-bold"><?php echo $_SESSION['tipoUsuario']; ?></div>
                    <?php echo $_SESSION['nombreU'] . " " . $_SESSION['apePat']; ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">