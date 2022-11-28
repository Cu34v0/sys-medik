<?php include "Views/Templates/header.php"; ?>
<h1 class="mt-4">Especialidades</h1>
<div class="fw-bold">Añadir nueva especialidad: <button class="btn btn-success mb-2" type="button" onclick="frmEspecialidad(event);"><i class="fas fa-plus"></i></button></div>

<!-- Tabla donde muestro las especialidades -->
<table class="table table-hover table-dark mx-auto text-center" style="width: 100%" id="tblEspecialidades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Especialidad</th>
            <th>Fecha de agregado</th>
            <th>Acciones al sistema</th>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Formulario flotante para añadir una nueva especialidad -->
<div id="nueva_especialidad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success justify-content-center">
                <h5 class="modal-title text-white" id="title">Nueva Especialidad</h5>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="frmEspecialidad">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="especialidad">Especialidad</label>
                                <input type="hidden" id="id" name="id">
                                <input id="especialidad" class="form-control text-center fw-bold" type="text" name="especialidad" placeholder="Especialidad" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-success" type="button" onclick="registrarEspecialidad(event);" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>