let tblUsuarios;
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
