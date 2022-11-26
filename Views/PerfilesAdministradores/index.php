<?php include "Views/Templates/header.php"; ?>
<h1 class="mt-4">Perfiles de Administradores</h1>
<!-- Tabla donde muestra a los usuarios registrados -->
<table class="table table-hover table-dark mx-auto text-center" style="width: 100%" id="tblInfoAdmin">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Experiencia</th>
            <th>Acciones al sistema</th>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Formulario donde aparecerán los datos que ya se conocen y los campos a editar del Administrador-->
<div id="info_admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success justify-content-center">
                <h5 class="modal-title text-white" id="title">Datos del Administrador</h5>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="frmInfoAdmin">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="experiencia">Experiencia</label>
                                <input type="hidden" id="idInfoAdmin" name="idInfoAdmin">
                                <input id="experiencia" class="form-control text-center fw-bold" type="text" name="experiencia" placeholder="Experiencia" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-success" type="button" onclick="actualizarDatosAdmin(event);" id="btnAccion">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>