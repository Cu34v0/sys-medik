function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const pass = document.getElementById("pass");
    if (usuario.value == "") {
        pass.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else if (pass.value == "") {
        usuario.classList.remove("is-invalid");
        pass.classList.add("is-invalid");
        pass.focus();
    } else {
        usuario.classList.remove("is-invalid");
        pass.classList.remove("is-invalid");
        // Envío los datos a mi backend
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    window.location = base_url + "Usuarios";
                } else {
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }
    }
}