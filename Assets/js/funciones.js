let tblUsuarios,
  tblInfoAdmin,
  tblInfoPaci,
  tblEspecialidades,
  tblSolicitudConsultas;

// Usuarios

document.addEventListener("DOMContentLoaded", function () {
  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "idUsuario",
      },
      {
        data: "nombreU",
      },
      {
        data: "apePat",
      },
      {
        data: "apeMat",
      },
      {
        data: "usuario",
      },
      {
        data: "nombre",
      },
      {
        data: "fechaAlta",
      },
      {
        data: "acciones",
      },
    ],
  });
});

// Formulario flotante Nuevo Usuario
function frmUsuario() {
  document.getElementById("title").innerHTML = "Nuevo Usuario";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmUsuario").reset();
  $("#nuevo_usuario").modal("show");
  document.getElementById("id").value = "";
}

// Registrar usuario
function registrarUsuario(e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre");
  const apePat = document.getElementById("apePat");
  const apeMat = document.getElementById("apeMat");
  const usuario = document.getElementById("usuario");
  const tipoUsuario = document.getElementById("tipoUsuario");
  if (
    nombre.value == "" ||
    apePat.value == "" ||
    apeMat.value == "" ||
    usuario.value == "" ||
    tipoUsuario == ""
  ) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Todos los datos son obligatorios",
    });
  } else {
    const url = base_url + "Usuarios/registrar";
    const frm = document.getElementById("frmUsuario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "si") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Usuario registrado con éxito",
            showConfirmButton: false,
            timer: 2000,
          });
          frm.reset();
          $("#nuevo_usuario").modal("hide");
          tblUsuarios.ajax.reload();
        } else if (res == "modificado") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Usuario modificado con éxito",
            showConfirmButton: false,
            timer: 2000,
          });
          $("#nuevo_usuario").modal("hide");
          tblUsuarios.ajax.reload();
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    };
  }
}

function btnEditarUser(id) {
  document.getElementById("title").innerHTML = "Actualizar Usuario";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Usuarios/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.idUsuario;
      document.getElementById("nombre").value = res.nombreU;
      document.getElementById("apePat").value = res.apePat;
      document.getElementById("apeMat").value = res.apeMat;
      document.getElementById("usuario").value = res.usuario;
      document.getElementById("tipoUsuario").value = res.idTipoUsuario;
      document.getElementById("claves").classList.add("d-none");
      $("#nuevo_usuario").modal("show");
    }
  };
}

function btnEliminarUser(id) {
  Swal.fire({
    title: "¿Estás seguro de eliminar?",
    text: "¡No podrás revertir esta acción!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Eliminado!", "El usuario ha sido eliminado", "success");
            tblUsuarios.ajax.reload();
          } else {
            Swal.fire("Error!", "res", "error");
          }
        }
      };
    }
  });
}

// Información de Administradores

document.addEventListener("DOMContentLoaded", function () {
  tblInfoAdmin = $("#tblInfoAdmin").DataTable({
    ajax: {
      url: base_url + "PerfilesAdministradores/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "idInfoAdmin",
      },
      {
        data: "nombreU",
      },
      {
        data: "apePat",
      },
      {
        data: "apeMat",
      },
      {
        data: "experiencia",
      },
      {
        data: "acciones",
      },
    ],
  });
});

function btnEditarInfoAdmin(id) {
  document.getElementById("title").innerHTML = "Actualizar Info Admin";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = base_url + "PerfilesAdministradores/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("idInfoAdmin").value = res.idInfoAdmin;
      document.getElementById("experiencia").value = res.experiencia;
      $("#info_admin").modal("show");
    }
  };
}

function actualizarDatosAdmin(e) {
  e.preventDefault();
  const experiencia = document.getElementById("experiencia");
  if (experiencia.value == "") {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Todos los datos son obligatorios",
    });
  } else {
    const url = base_url + "PerfilesAdministradores/registrar";
    const frm = document.getElementById("frmInfoAdmin");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "modificado") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Datos del administrador actualizados con correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          frm.reset();
          $("#info_admin").modal("hide");
          tblInfoAdmin.ajax.reload();
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    };
  }
}

// Doctores

// Información de doctores
document.addEventListener("DOMContentLoaded", function () {
  tblInfoDoc = $("#tblInfoDoc").DataTable({
    ajax: {
      url: base_url + "PerfilesMedicos/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "idInfoDoc",
      },
      {
        data: "nombreU",
      },
      {
        data: "apePat",
      },
      {
        data: "apeMat",
      },
      {
        data: "nombreEspecialidad",
      },
      {
        data: "cedulaProfesional",
      },
      {
        data: "nombre",
      },
      {
        data: "acciones",
      },
    ],
  });
});

function btnEditarInfoDoc(id) {
  document.getElementById("title").innerHTML =
    "Actualizar Información del Doctor";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = base_url + "PerfilesMedicos/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("idInfoDoc").value = res.idInfoDoc;
      document.getElementById("especialidad").value = res.idEspecialidad;
      document.getElementById("cedulaProfesional").value =
        res.cedulaProfesional;
      document.getElementById("turno").value = res.idTurno;
      $("#info_medic").modal("show");
    }
  };
}

function actualizarDatosMedic(e) {
  e.preventDefault();
  const especialidad = document.getElementById("especialidad");
  const cedulaProfesional = document.getElementById("cedulaProfesional");
  const turno = document.getElementById("turno");
  if (
    especialidad.value == "" ||
    cedulaProfesional.value == "" ||
    turno.value == ""
  ) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Todos los datos son obligatorios",
    });
  } else {
    const url = base_url + "PerfilesMedicos/registrar";
    const frm = document.getElementById("frmInfoDoc");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "modificado") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Datos del doctor actualizados correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          frm.reset();
          $("#info_medic").modal("hide");
          tblInfoDoc.ajax.reload();
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    };
  }
}

// Pacientes

// Información de pacientes
document.addEventListener("DOMContentLoaded", function () {
  tblInfoPaci = $("#tblInfoPaci").DataTable({
    ajax: {
      url: base_url + "PerfilesPacientes/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "idInfoPaci",
      },
      {
        data: "nombreU",
      },
      {
        data: "apePat",
      },
      {
        data: "apeMat",
      },
      {
        data: "fechaNacimiento",
      },
      {
        data: "peso",
      },
      {
        data: "tipoSangre",
      },
      {
        data: "acciones",
      },
    ],
  });
});

// Ordenar los datos que ya se tienen
function btnEditarInfoPaci(id) {
  document.getElementById("title").innerHTML =
    "Actualizar Información del paciente";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = base_url + "PerfilesPacientes/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("idInfoPaci").value = res.idInfoPaci;
      document.getElementById("fechaNacimiento").value = res.fechaNacimiento;
      document.getElementById("peso").value = res.peso;
      document.getElementById("tipoSangre").value = res.tipoSangre;
      $("#info_paci").modal("show");
    }
  };
}

function actualizarDatosPaci(e) {
  e.preventDefault();
  const fechaNacimiento = document.getElementById("fechaNacimiento");
  const peso = document.getElementById("peso");
  const tipoSangre = document.getElementById("tipoSangre");
  if (
    fechaNacimiento.value == "" ||
    peso.value == "" ||
    tipoSangre.value == ""
  ) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Todos los datos son obligatorios",
    });
  } else {
    const url = base_url + "PerfilesPacientes/registrar";
    const frm = document.getElementById("frmInfoPaci");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "modificado") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Datos del paciente actualizados correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
          frm.reset();
          $("#info_paci").modal("hide");
          tblInfoPaci.ajax.reload();
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    };
  }
}

// Inicio cambio de contraseña

function changePass(e) {
  e.preventDefault();
  const passActual = document.getElementById("passActual");
  const nuevaPass = document.getElementById("nuevaPass");
  const confirmar = document.getElementById("confirmar");

  if (passActual.value == "") {
    nuevaPass.classList.remove("is-invalid");
    confirmar.classList.remove("is-invalid");
    passActual.classList.add("is-invalid");
    passActual.focus();
  } else if (nuevaPass.value == "") {
    passActual.classList.remove("is-invalid");
    confirmar.classList.remove("is-invalid");
    nuevaPass.classList.add("is-invalid");
    nuevaPass.focus();
  } else if (confirmar.value == "") {
    passActual.classList.remove("is-invalid");
    nuevaPass.classList.remove("is-invalid");
    confirmar.classList.add("is-invalid");
    confirmar.focus();
  } else {
    const url = base_url + "CambioPass/changePass";
    const frm = document.getElementById("frmPass");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "actualizada") {
          Swal.fire({
            title: "Cambio de contraseña exitoso!",
            text: "El sistema cerrará sesión para que ingrese con su nueva contraseña",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Ok!",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.replace(base_url + "Usuarios/salir");
            }
          });
        } else if (res == "error") {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "No se ha podido cambiar la contraseña.",
            showConfirmButton: false,
            timer: 2000,
          });
        } else if (res == "diferentes") {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "Las contraseñas no coinciden.",
            showConfirmButton: false,
            timer: 2000,
          });
        } else if (res == "no existe") {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "La contraseña no corresponde al usuario",
            showConfirmButton: false,
            timer: 2000,
          });
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    };
  }
}

// Inicio de Especialidades

document.addEventListener("DOMContentLoaded", function () {
  tblEspecialidades = $("#tblEspecialidades").DataTable({
    ajax: {
      url: base_url + "Especialidades/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "idEspecialidad",
      },
      {
        data: "nombreEspecialidad",
      },
      {
        data: "fechaAgregada",
      },
      {
        data: "acciones",
      },
    ],
  });
});

function frmEspecialidad() {
  document.getElementById("title").innerHTML = "Nueva Especialidad";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmEspecialidad").reset();
  $("#nueva_especialidad").modal("show");
  document.getElementById("id").value = "";
}

// Registrar especialidad
function registrarEspecialidad(e) {
  e.preventDefault();
  const especialidad = document.getElementById("especialidad");
  if (especialidad.value == "") {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Todos los datos son obligatorios",
    });
  } else {
    const url = base_url + "Especialidades/registrar";
    const frm = document.getElementById("frmEspecialidad");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "si") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Especialidad registrada con éxito",
            showConfirmButton: false,
            timer: 2000,
          });
          frm.reset();
          $("#nueva_especialidad").modal("hide");
          tblEspecialidades.ajax.reload();
        } else if (res == "modificado") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Especialidad modificada con éxito",
            showConfirmButton: false,
            timer: 2000,
          });
          $("#nueva_especialidad").modal("hide");
          tblEspecialidades.ajax.reload();
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    };
  }
}

function btnEditarEspecialidad(id) {
  document.getElementById("title").innerHTML = "Modificar especialidad";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = base_url + "Especialidades/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.idEspecialidad;
      document.getElementById("especialidad").value = res.nombreEspecialidad;
      $("#nueva_especialidad").modal("show");
    }
  };
}

// Inicio solicitud de consultas

document.addEventListener("DOMContentLoaded", function () {
  tblSolicitudConsultas = $("#tblSolicitudConsultas").DataTable({
    ajax: {
      url: base_url + "SolicitudConsulta/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "idSolicitudConsulta",
      },
      {
        data: "nombreU",
      },
      {
        data: "apePat",
      },
      {
        data: "apeMat",
      },
      {
        data: "fechaConsulta",
      },
      {
        data: "nombreEspecialidad",
      },
      {
        data: "estadoSolicitud",
      },
      {
        data: "acciones",
      },
    ],
  });
});

function frmSolicitudConsulta() {
  document.getElementById("title").innerHTML = "Nueva solicitud de consulta";
  document.getElementById("btnAccion").innerHTML = "Solicitar";
  document.getElementById("frmSolicitudConsulta").reset();
  $("#nueva_solicitud").modal("show");
  document.getElementById("id").value = "";
}

function registrarSolicitud(e) {
  e.preventDefault();
  const fechaSolicitud = document.getElementById("fechaSolicitud");
  const especialidad = document.getElementById("especialidad");
  if (fechaSolicitud.value == "" || especialidad.value == "") {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Todos los datos son obligatorios",
    });
  } else {
    const url = base_url + "SolicitudConsulta/registrar";
    const frm = document.getElementById("frmSolicitudConsulta");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "si") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Especialidad registrada con éxito",
            showConfirmButton: false,
            timer: 2000,
          });
          frm.reset();
          $("#nueva_solicitud").modal("hide");
          tblSolicitudConsultas.ajax.reload();
        } else {
          Swal.fire({
            position: "center",
            icon: "error",
            title: res,
            showConfirmButton: false,
            timer: 2000,
          });
        }
      }
    }
  }
}