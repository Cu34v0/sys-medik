<?php include "Views/Templates/header.php"; ?>
<h2 class="mt-2">Solicitud de consulta</h2>
<div class="fw-bold">Solicitar nueva consulta <button class="btn btn-success mb-2" type="button" onclick="frmSolicitudConsulta(event);"><i class="fas fa-plus"></i></button></div>

<!-- Tabla donde muestra a los usuarios registrados -->
<table class="table table-hover table-dark mx-auto text-center" style="width: 100%" id="tblSolicitudConsultas">
    <thead>
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de solicitud</th>
            <th>Especialidad</th>
            <th>Estado</th>
            <th>Acciones</th>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Formulario flotante para añadir un nuevo usuario -->
<div id="nueva_solicitud" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success justify-content-center">
                <h5 class="modal-title text-white" id="title">Nueva solicitud de consulta</h5>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="frmSolicitudConsulta">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fechaSolicitud">Fecha</label>
                                <input type="hidden" id="id" name="id">
                                <input id="fechaSolicitud" class="form-control text-center fw-bold" type="date" name="fechaSolicitud" placeholder="Fecha de solicitud" autocomplete="off">
                            </div>

                            <div class="col-md-6">
                                <label for="especialidad">Especialidad</label>
                                <select id="especialidad" class="form-select text-center fw-bold" name="especialidad">
                                    <option selected disabled>Seleccione una especialidad</option>
                                    <?php foreach ($data['especialidades'] as $row) { ?>

                                        <option value="<?php echo $row['idEspecialidad']; ?>"><?php echo $row['nombreEspecialidad']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-success" type="button" onclick="registrarSolicitud(event);" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>