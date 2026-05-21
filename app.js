// RELOJ DIGITAL
function actualizarReloj() {
    const reloj = document.getElementById("reloj");

    if (!reloj) return;

    const ahora = new Date();
    const hora = ahora.toLocaleTimeString();

    reloj.innerHTML = "Hora actual: " + hora;
}

setInterval(actualizarReloj, 1000);


// CAPTURAR FORMULARIO DE CONSULTA
document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    if (!form) return;

    form.addEventListener("submit", function(e){
        e.preventDefault();

        const datos = new FormData(form);

        fetch("consulta.php", {
            method: "POST",
            body: datos
        })
        .then(response => response.text())
        .then(data => {

            let resultado = document.getElementById("resultado");

            if(!resultado){
                resultado = document.createElement("div");
                resultado.id = "resultado";
                form.appendChild(resultado);
            }

            resultado.innerHTML = data;

        });

    });

});