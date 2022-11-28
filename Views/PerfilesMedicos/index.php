<?php include "Views/Templates/header.php"; ?>
<h1 class="mt-4">Perfiles Médicos</h1>
<!-- Tabla donde muestra a los usuarios registrados -->
<table class="table table-hover table-dark mx-auto text-center" style="width: 100%" id="tblInfoDoc">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Especialidad</th>
            <th>Cedula Profesional</th>
            <th>Turno</th>
            <th>Acciones al sistema</th>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Formulario donde aparecerán los datos que ya se conocen y los campos a editar del Medico-->
<div id="info_medic" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success justify-content-center">
                <h5 class="modal-title text-white" id="title">Datos del Doctor</h5>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="frmInfoDoc">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="especialidad">Especialidad</label>
                                <input type="hidden" id="idInfoDoc" name="idInfoDoc">
                                <select id="especialidad" class="form-select text-center fw-bold" name="especialidad">
                                    <option selected disabled>Seleccione una especialidad</option>
                                    <?php foreach ($data['especialidades'] as $row) { ?>

                                        <option value="<?php echo $row['idEspecialidad']; ?>"><?php echo $row['nombreEspecialidad']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="cedulaProfesional">Cedula Profesional</label>
                                <input type="text" id="cedulaProfesional" class="form-control text-center fw-bold" name="cedulaProfesional" placeholder="Cedula Profesional" autocapitalize="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-6">
                                <label for="turno">Turno</label>
                                <select id="turno" class="form-control text-center fw-bold" name="turno">
                                    <option selected disabled>Seleccione una turno</option>
                                    <?php foreach ($data['turnos'] as $row) { ?>

                                        <option value="<?php echo $row['idTurno']; ?>"><?php echo $row['nombre']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-success" type="button" onclick="actualizarDatosMedic(event);" id="btnAccion">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php include "Views/Templates/footer.php"; ?>