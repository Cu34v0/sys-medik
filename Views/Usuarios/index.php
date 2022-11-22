<?php include "Views/Templates/header.php"; ?>
<h1 class="mt-4">Usuarios</h1>
<div class="fw-bold">Añadir nuevo usuario: <button class="btn btn-success mb-2" type="button" onclick="frmUsuario(event);"><i class="fas fa-plus"></i></button></div>
<!-- Tabla donde muestra a los usuarios registrados -->
<table class="table table-hover table-dark mx-auto text-center" style="width: 100%" id="tblUsuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Usuario</th>
            <th>Tipo de Usuario</th>
            <th>Fecha de ingreso</th>
            <th>Acciones al sistema</th>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Formulario flotante para añadir un nuevo usuario -->
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success justify-content-center">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="frmUsuario">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="hidden" id="id" name="id">
                                <input id="nombre" class="form-control text-center fw-bold" type="text" name="nombre" placeholder="Nombre" autocomplete="off">
                            </div>

                            <div class="col-md-6">
                                <label for="apePat">Apellido Paterno</label>
                                <input id="apePat" class="form-control text-center fw-bold" type="text" name="apePat" placeholder="Apellido Paterno" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="apeMat">Apellido Materno</label>
                                <input type="text" id="apeMat" class="form-control text-center fw-bold" name="apeMat" placeholder="Apellido Materno" autocomplete="off">
                            </div>

                            <div class="col-md-6">
                                <label for="usuario">Usuario</label>
                                <input type="text" id="usuario" class="form-control text-center fw-bold" name="usuario" placeholder="Usuario" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row" id="claves">
                            <div class="col-md-6">
                                <label for="clave">Contraseña</label>
                                <input type="password" id="clave" class="form-control text-center" name="clave" placeholder="Contraseña">
                            </div>

                            <div class="col-md-6">
                                <label for="confirmar">Confirmar</label>
                                <input type="password" id="confirmar" class="form-control text-center" name="confirmar" placeholder="Confirmar">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tipoUsuario">Tipo de Usuario</label>
                                <select id="tipoUsuario" class="form-control text-center fw-bold" name="tipoUsuario">
                                    <!-- <option selected="true" disabled="disabled">Seleccione una opcion</option> -->
                                    <?php foreach ($data['tipoUsuarios'] as $row) { ?>

                                        <option value="<?php echo $row['idTipoUsuario']; ?>"><?php echo $row['nombre']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-success" type="button" onclick="registrarUsuario(event);" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>