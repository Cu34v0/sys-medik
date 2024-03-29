<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Sys-Medik</title>
    <link href="Assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-success">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4 fw-bold"><i class="fa-solid fa-staff-snake"></i> Sys-Medik</h3>
                                    <h3 class="text-center font-weight-light my-4 fw-bold">Inicio de sesión</h3>
                                </div>
                                <div class="card-body">
                                    <form id="frmLogin">
                                        <div class="form-floating mb-3">
                                            <input class="form-control text-center fw-bold" id="usuario" name="usuario" type="text" placeholder="Usuario" autocomplete="off"/>
                                            <label for="usuario" class="fw-bold"><i class="fa-solid fa-user"></i> Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control text-center fw-bold" id="pass" name="clave" type="password" placeholder="Password" autocomplete="off"/>
                                            <label for="pass" class="fw-bold"><i class="fa-solid fa-key"></i> Contraseña</label>
                                        </div>
                                        
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                            <button class="btn btn-success fw-bold" type="submit" onclick="frmLogin(event);">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="Assets/js/scripts.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
</body>

</html>