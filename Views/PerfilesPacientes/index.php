<?php include "Views/Templates/header.php"; ?>
<h1 class="mt-4">Perfiles de Pacientes</h1>
<!-- Tabla donde muestra a los usuarios registrados -->
<table class="table table-hover table-dark mx-auto text-center" style="width: 100%" id="tblInfoPaci">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Nacimiento</th>
            <th>Peso</th>
            <th>Tipo de Sangre</th>
            <th>Acciones al sistema</th>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Formulario donde aparecerán los datos que ya se conocen y los campos a editar del Paciente-->
<div id="info_paci" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success justify-content-center">
                <h5 class="modal-title text-white" id="title">Datos del Paciente</h5>
            </div>
            <div class="modal-body text-center">
                <form method="POST" id="frmInfoPaci">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                <input type="hidden" id="idInfoPaci" name="idInfoPaci">
                                <input id="fechaNacimiento" class="form-control text-center fw-bold" type="date" name="fechaNacimiento" placeholder="Fecha de Nacimiento" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="peso">Peso</label>
                                <input type="text" name="peso" id="peso" class="form-control text-center fw-bold" placeholder="Peso" autocomplete="off">
                            </div>

                            <div class="col-md-6">
                                <label for="tipoSangre">Tipo de Sangre</label>
                                <input type="text" name="tipoSangre" id="tipoSangre" class="form-control text-center fw-bold" placeholder="Tipo de Sangre" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-success" type="button" onclick="actualizarDatosPaci(event);" id="btnAccion">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include "Views/Templates/footer.php"; ?>