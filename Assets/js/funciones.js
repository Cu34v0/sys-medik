let tblUsuarios, tblInfoAdmin, tblInfoPaci;

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
    http.onreadystatechange = function(){
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
    }
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
        data: "especialidad",
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
  document.getElementById("title").innerHTML = "Actualizar Información del Doctor";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = base_url + "PerfilesMedicos/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("idInfoDoc").value = res.idInfoDoc;
      document.getElementById("especialidad").value = res.especialidad;
      document.getElementById("cedulaProfesional").value = res.cedulaProfesional;
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
  if (especialidad.value == "" || cedulaProfesional == "" || turno == "") {
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
    http.onreadystatechange = function(){
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
    }
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
  document.getElementById("title").innerHTML = "Actualizar Información del paciente";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = base_url + "PerfilesPacientes/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("idInfoPaci").value = res.idInfoPaci;
      document.getElementById("fechaNacimiento").value = res.fechaNacimiento;
      document.getElementById("peso").value = res.peso;
      document.getElementById("tipoSangre").value = res.tipoSangre;
      $("#info_paci").modal("show");
    }
  }
}

function actualizarDatosPaci(e) {
  e.preventDefault();
  const fechaNacimiento = document.getElementById("fechaNacimiento");
  const peso = document.getElementById("peso");
  const tipoSangre = document.getElementById("tipoSangre");
  if (fechaNacimiento.value == "" || peso.value == "" || tipoSangre.value == "") {
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
    }
  }
}