document.addEventListener("DOMContentLoaded", function () {
    listarMenus();
    listaRedesSociales();
});



function fechas(fechaInicio, fechaFin) {
    const inicio = new Date(fechaInicio).toLocaleDateString('es-ES', { year: 'numeric', month: 'long' });
    const fin = fechaFin ? new Date(fechaFin).toLocaleDateString('es-ES', { year: 'numeric', month: 'long' }) : "Actualidad";
    return `${inicio} - ${fin}`;
}


function listarMenus() {
    fetch('/PaginaWiliam/controller/menu.php?op=listar')
        .then((response) => response.json())
        .then((menus) => {
            const navbar = document.querySelector(".navbar");
            navbar.innerHTML = menus.map(menu => `<a href="${menu.url}">${menu.opcion}</a>`).join('');
        })
        .catch((error) => console.error("Error cargando los menús:", error));
}

function listaRedesSociales() {
    fetch('/PaginaWiliam/controller/social_media.php?op=listar')
        .then((response) => response.json())
        .then((redes) => {
            const icons = document.querySelector(".icons");
            icons.innerHTML = redes.map(red => 
                `<a href="${red.socmed_url}" target="_blank" class="bx ${red.socmed_icono}"></a>`
            ).join('');
        })
        .catch((error) => console.error("Error cargando redes sociales:", error));
}
